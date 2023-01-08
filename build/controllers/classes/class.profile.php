<?php
    class profile {

        public function meta() {
            $meta['title'] = "Edit My Profile | ".SITE_TITLE;
            $meta['description'] = "";
            $meta['keywords'] = "";
            $meta['robots'] = "index, follow";
            $meta['expires'] = "43200";

            return $meta;
        }

        public function userinfo(){
            global $db;

            $db->where('id', $_SESSION['user_id']);
            return $db->getOne('users', ['email', 'fullname', 'level']);
        }

    }

    global $meta, $uinfo;

    $profile = new profile();
    $meta = $profile->meta();
    $uinfo = $profile->userinfo();