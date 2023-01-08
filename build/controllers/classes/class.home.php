<?php
    class home {

        public function meta() {
            $meta['title'] = "Dashbpard | ".SITE_TITLE;
            $meta['description'] = "";
            $meta['keywords'] = "";
            $meta['robots'] = "index, follow";
            $meta['expires'] = "43200";

            return $meta;
        }

        public function userinfo(){
            global $db;

            $db->where('id', $_SESSION['user_id']);
            return $db->getOne('users', ['fullname', 'level']);
        }

    }

    global $meta, $uinfo;

    $home = new home();
    $meta = $home->meta();
    $uinfo = $home->userinfo();