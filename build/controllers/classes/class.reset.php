<?php
    class reset {

        public function meta() {
            $meta['title'] = "Reset Password | ".SITE_TITLE;
            $meta['description'] = "";
            $meta['keywords'] = "";
            $meta['robots'] = "index, follow";
            $meta['expires'] = "43200";

            return $meta;
        }
    }

    global $meta, $db;

    if(!isset($PAGE[1])){
        forbidden_page();
    }

    $token = $PAGE[1];

    $db->where('hash', $token);
    $res = $db->getOne('password_resets', 'userid');

    if($db->count < 1){
        forbidden_page();
    }

    $_SESSION['user_id_reset'] = $res['userid'];

    $reset = new reset();
    $meta = $reset->meta();