<?php
    class login {

        public function meta() {
            $meta['title'] = "Login in to ".SITE_TITLE;
            $meta['description'] = "";
            $meta['keywords'] = "";
            $meta['robots'] = "index, follow";
            $meta['expires'] = "43200";

            return $meta;
        }
    }

    global $meta;

    $login = new login();
    $meta = $login->meta();