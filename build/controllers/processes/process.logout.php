<?php
    session_destroy();
    session_unset();
    unset($_SESSION);
    $_SESSION = array();

    header('location:'.ICE_URL.'login');
    exit();