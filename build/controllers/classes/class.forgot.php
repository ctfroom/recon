<?php
    class forgot {

        public function meta() {
            $meta['title'] = "Forgot Password | ".SITE_TITLE;
            $meta['description'] = "";
            $meta['keywords'] = "";
            $meta['robots'] = "index, follow";
            $meta['expires'] = "43200";

            return $meta;
        }
    }

    global $meta;

    $forgot = new forgot();
    $meta = $forgot->meta();