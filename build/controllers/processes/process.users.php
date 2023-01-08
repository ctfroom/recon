<?php
    global $db;
    //instantiate class.forms.php
    $form = new forms();

    if($form->_forbid_direct_access()){
        forbidden_page();
    }

    //set return uri
    $return_uri = $_SERVER['HTTP_REFERER'];

    if($form->_is_demo()){
        $_SESSION['ice_error'] = 'The site is in Demo Mode. No actions will be executed!';
		header('location:'.$return_uri.'');
		exit();
    }

    //check and verify the nonce
    if(!$form->_nonce_passed($_POST)){
        forbidden_page();
    }

    //check if the request is valid
    $op = $form->valid_request($_POST);

    //instantiate the validation class
    use Respect\Validation\Validator as v;


    if($op === null){
        forbidden_page();
    }

    if($op === 'new'){

        $name = clean_post('name');
        $email = clean_post('email');
        $pwd = clean_post('password');

        if(!v::alnum(' ')->validate($name)){
            $_SESSION['ice_error'] = 'The name provided is invalid';
            header('location:'.$return_uri.'');
            exit();
        }

        if(!v::email()->validate($email)){
            $_SESSION['ice_error'] = 'The email provided is invalid';
            header('location:'.$return_uri.'');
            exit();
        }

        if(!v::stringType()->notEmpty()->validate($pwd)){
            $_SESSION['ice_error'] = 'Please enter password';
            header('location:'.$return_uri.'');
            exit();
        }

        //check if a user with the same email exists
        $db->where('email', $email);
        $db->getOne('users', 'id');

        if($db->count > 0){
            $_SESSION['ice_error'] = 'A user with the same email address exists in our database.';
            header('location:'.$return_uri.'');
            exit();
        }

        $hash = password_hash($pwd, PASSWORD_DEFAULT);

        $newUser = [
            'email' => $email,
            'password' => $hash,
            'fullname' => $name
        ];

        $db->insert('users', $newUser);

        $_SESSION['ice_success'] = 'Your account has been created. You can now log in.';
        header('location:'.ICE_URL.'login');
        exit();

    }

    if($op === 'login'){

        $email = clean_post('email');
        $pwd = clean_post('password');

        if(!isset($_SESSION['fails'])){
            $_SESSION['fails'] = 0;
        }

        if($_SESSION['fails'] > 3){
            $_SESSION['ice_error'] = 'You have 3 failed attempts and therefore have been temporarily banned.';
            header('location:'.$return_uri.'');
            exit();
        }

        if(!v::email()->validate($email)){
            $_SESSION['ice_error'] = 'The email provided is invalid';
            header('location:'.$return_uri.'');
            exit();
        }

        if(!v::stringType()->notEmpty()->validate($pwd)){
            $_SESSION['ice_error'] = 'Please enter password';
            header('location:'.$return_uri.'');
            exit();
        }

        //check if a user with the same email exists
        $db->where('email', $email);
        $user = $db->getOne('users', ['id','password']);

        if($db->count < 1){
            //capture this failed attempt
            $_SESSION['fails'] = $_SESSION['fails'] + 1;
            $_SESSION['ice_error'] = 'Email/password is invalid.';
            header('location:'.$return_uri.'');
            exit();
        }

        //verify password
        if(!password_verify($pwd,$user['password'])){
            $_SESSION['fails'] = $_SESSION['fails'] + 1;
            $_SESSION['ice_error'] = 'Email/password is invalid.';
            header('location:'.$return_uri.'');
            exit();
        }

        //save the session
        $_SESSION['user_id'] = $user['id'];
        unset($_SESSION['fails']);

        $_SESSION['ice_success'] = 'You have logged in successfully.';
        header('location:'.ICE_URL.'home');
        exit();

    }

    if($op === 'changeEmail'){

        $userid = clean_post('userid');
        $email = clean_post('email');

        if(!v::stringType()->notEmpty()->validate($userid)){
            $_SESSION['ice_error'] = 'Please enter password';
            header('location:'.$return_uri.'');
            exit();
        }

        //decode the userid
        $userid = base64_decode($userid);

        if(!is_numeric($userid)){
            $_SESSION['ice_error'] = 'The userid supplied is invalid.';
            header('location:'.$return_uri.'');
            exit();
        }

        if(!v::email()->validate($email)){
            $_SESSION['ice_error'] = 'The email provided is invalid';
            header('location:'.$return_uri.'');
            exit();
        }

        //check if a user with the same email exists
        $db->where('email', $email);
        $user = $db->getOne('users', ['id']);

        if($db->count > 0){
            //capture this failed attempt
            $_SESSION['ice_error'] = 'Another user with this email already exists in our system.';
            header('location:'.$return_uri.'');
            exit();
        }

        //check if a user with this id exists
        $db->where('id', $userid);
        $db->getOne('users', ['id']);

        if($db->count < 1){
            //capture this failed attempt
            $_SESSION['ice_error'] = 'No such user exists in our system.';
            header('location:'.$return_uri.'');
            exit();
        }

        $emailUpd = ['email' => $email];
        $db->where('id', $userid);
        $db->update('users', $emailUpd);

        $_SESSION['ice_success'] = 'Your email has been changed successfully.';
        header('location:'.$return_uri.'');
        exit();

    }

    if($op === 'changeProfile'){

        $name = clean_post('fname');

        if(!v::alnum(' ')->validate($name)){
            $_SESSION['ice_error'] = 'The name provided is invalid';
            header('location:'.$return_uri.'');
            exit();
        }

        $nameUpd = ['fullname' => $name];
        $db->where('id', $_SESSION['user_id']);
        $db->update('users', $nameUpd);

        $_SESSION['ice_success'] = 'Your name has been changed successfully.';
        header('location:'.$return_uri.'');
        exit();

    }

    if($op === 'forgot'){

        $email = clean_post('email');
        if(!v::email()->validate($email)){
            $_SESSION['ice_error'] = 'The email provided is invalid';
            header('location:'.$return_uri.'');
            exit();
        }

        //check if a user with this email exists
        $db->where('email', $email);
        $user = $db->getOne('users', ['id']);

        if($db->count < 1){
            $_SESSION['ice_error'] = 'No such user was found in our database.';
            header('location:'.$return_uri.'');
            exit();
        }

        //generate reset link
        $hash = md5(microtime());

        //save
        $newReset = ['userid' => $user['id'], 'hash' => $hash];
        $db->insert('password_resets', $newReset);

        //build the email
        $link = SITE_URL .'reset/'.$hash;

        $_SESSION['ice_success'] = "Here's your password reset link in case you do not receive an email: $link";
        header('location:'.$return_uri.'');
    }

    if($op === 'reset'){
        $pwd = clean_post('pwd');     
        $rpwd = clean_post('rpwd');

        if(!v::stringType()->notEmpty()->validate($pwd)){
            $_SESSION['ice_error'] = 'Please enter password';
            header('location:'.$return_uri.'');
            exit();
        }

        //check if the passwords match
        if($pwd !== $pwd){
            $_SESSION['ice_error'] = 'The passwords do not match.';
            header('location:'.$return_uri.'');
            exit();
        }

        //create a hash
        $hash = password_hash($pwd, PASSWORD_DEFAULT);

        //update
        $newPwd = ['password' => $hash];
        $db->where('id', $_SESSION['user_id_reset']);
        $db->update('users', $newPwd);

        //delete the password reset request
        $db->where('id', $_SESSION['user_id_reset']);
        $db->delete('password_resets');

        unset($_SESSION['user_id_reset']);

        $_SESSION['ice_success'] = 'The password has been changed successfully.';
        header('location:'.ICE_URL.'login');
        exit();

    }
