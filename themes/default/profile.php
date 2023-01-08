<?php 
    $pages->protected(true);
    $pages->load_theme_file(array('file'=>'head', 'folder' => 'global'));
    $pages->load_theme_file(array('file'=>'sidebar', 'folder' => 'global'));
    $pages->load_theme_file(array('file'=>'header', 'folder' => 'global'));
?>
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit My Profile</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Change Email Address</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo ICE_ACTIONS_URL .'users' ?>" method="POST">
                            <input type="hidden" name="ice_op" value="<?php echo $converter->encrypt('changeEmail') ?>">
                            <input type="hidden" name="ice_nonce" value="<?php echo $ice->nonce()?>">
                            <input type="hidden" name="userid"
                                value="<?php echo base64_encode($_SESSION['user_id']) ?>">
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" class="form-control" name="email"
                                    value="<?php echo $uinfo['email'] ?>" required>
                                <small class="form-text text-muted">We'll never share your email with
                                    anyone else.</small>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">Change Email</button>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo ICE_ACTIONS_URL .'users' ?>" method="POST">
                            <input type="hidden" name="ice_op" value="<?php echo $converter->encrypt('changeProfile') ?>">
                            <input type="hidden" name="ice_nonce" value="<?php echo $ice->nonce()?>">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="fname"
                                    value="<?php echo $uinfo['fullname'] ?>" required>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">Change Name</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
<?php $pages->load_theme_file(array('file'=>'footer', 'folder' => 'global'));?>