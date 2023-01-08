<?php
    class index {

        public function meta() {
            $meta['title'] = "Create your account ".SITE_TITLE;
            $meta['description'] = "";
            $meta['keywords'] = "";
            $meta['robots'] = "index, follow";
            $meta['expires'] = "43200";

            return $meta;
        }
    }

    global $meta;

    $index = new index();
    $meta = $index->meta();