<?php
    /****************************************************************************
     *   Copyright (C) 2022 https://isvipi.com

        This program is free software; you can redistribute it and/or modify
        it under the terms of the GNU General Public License as published by
        the Free Software Foundation Version 3 of the License, or
        (at your option) any later version.

        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.

        You should have received a copy of the GNU General Public License along
        with this program; if not, write to the Free Software Foundation, Inc.,
        51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
    *****************************************************************************/
    class pages {

        public function page_not_found($logged = false){
            global $ice, $converter;
            echo "Not Found"; exit();
        }
        
        public function load_page($page = []){
            global $ice, $pages, $converter, $tInfo, $PAGE, $member, $memberinfo;
            //automatically include a corresponding class file if found
            if(is_file(ICE_CONTROLLERS . 'classes/class.' . $page[0] . '.php')){
                require_once(ICE_CONTROLLERS . 'classes/class.' . $page[0] . '.php');
            }

            require_once(ICE_THEMES . THEME . '/' . $page[0] . '.php');
        }

        public function protected($logged = true, $admin = false){

            if($logged && !isset($_SESSION['user_id'])){
                session_destroy();
                session_start();
                $_SESSION['ice_error'] = 'You must be logged in to access this page.';
                header('location:'.ICE_URL.'login');
                exit();
            } else if($logged && $admin && isset($_SESSION['user_id']) && !is_admin($_SESSION['user_id'])){
                session_destroy();
                session_start();
                $_SESSION['ice_error'] = 'You must be logged in to access this page.';
                header('location:'.ICE_URL.'login');
                exit();
            }

        }

        public function load_theme_file($param = []){			
            global $meta, $ice, $pages, $converter, $tInfo, $PAGE, $memberinfo, $uinfo;

            if (is_file(ICE_THEMES . THEME . '/'.$param['folder'].'/' . $param['file'] . '.php')){
				require_once ICE_THEMES . THEME . '/'.$param['folder'].'/' . $param['file'] . '.php';
			}
		}

        public function load_page_media($media_type){
            if($media_type === "favicon"){
				if(is_file(ICE_UPLOADS . 'favicons/'.FAVICON)){
					return "<link rel='icon' href='".ICE_URL."build/uploads/favicons/".FAVICON."' type='image/x-icon' />";
				} else {
					return "<link rel='icon' href='".ICE_URL."build/media/favicon.ico' type='image/x-icon' />";
				}
			} else if($media_type === "logo"){
				if(is_file(ICE_UPLOADS . 'logos/'. LOGO)){
					return ICE_URL."build/uploads/logos/". LOGO;
				} else {
					return ICE_URL.'build/media/logo.png';
				}
			} else {
                if(is_file(ICE_UPLOADS . '/'. $media_type)){
                    return ICE_URL."build/uploads/". $media_type;
                }
            }
        }

        public function load_styles($styles){
            global $PAGE;

            foreach($styles as $style){
                if($style[1] === 'css'){
                    if($style[2] === 'all' || $style[2] === $PAGE[0] || in_array($PAGE[0], $style[2])){
                        echo "<link rel='stylesheet' href='".$style[0]."'> \n";
                    }
                } else if($style[1] === 'js'){
                    if($style[2] === 'all' || $style[2] === $PAGE[0] || in_array($PAGE[0], $style[2])){
                        echo "<script src='".$style[0]."'></script> \n";
                    }
                }
            }
		}
    }