<!DOCTYPE html>
<html lang="<?php echo LANG ?>">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?php echo $meta['description'] ?>">
	<meta name="robots" content="<?php echo $meta['robots'] ?>">
	<meta name="keywords" content="<?php echo $meta['keywords'] ?>">
    <meta http-equiv="expires" content="<?php echo $meta['expires'] ?>"/>
    <title><?php echo $meta['title'] ?></title>
    <?php echo $this->load_page_media('favicon'); ?>

    <!-- styles and scripts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <?php 
        $pages->load_styles(
            [
                [''.ICE_THEMES_URL.THEME.'/styles/css/app.css', 'css', 'all'],
                [''.ICE_THEMES_URL.THEME.'/styles/css/custom.css', 'css', 'all']
            ]
        ); 
    ?>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<?php if(isset($_SESSION['ice_error'])){?>
    <div class="alert alert-danger"><?php echo $_SESSION['ice_error']; unset($_SESSION['ice_error']); ?></div>
<?php } else if(isset($_SESSION['ice_success'])){?>
    <div class="alert alert-success"><?php echo $_SESSION['ice_success']; unset($_SESSION['ice_success']); ?></div>
<?php } ?>