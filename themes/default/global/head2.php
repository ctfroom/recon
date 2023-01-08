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
	<!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <?php 
        $pages->load_styles(
            [
                [''.ICE_VENDOR_URL.'bootstrap/css/bootstrap.min.css', 'css', 'all'],
                [''.ICE_VENDOR_URL.'bootstrap-icons/bootstrap-icons.css', 'css', 'all'],
                [''.ICE_VENDOR_URL.'aos/aos.css', 'css', 'all'],
                [''.ICE_VENDOR_URL.'glightbox/css/glightbox.min.css', 'css', 'all'],
                [''.ICE_VENDOR_URL.'swiper/swiper-bundle.min.css', 'css', 'all'],
                [''.ICE_THEMES_URL.THEME.'/assets/css/variables.css', 'css', 'all'],           
                [''.ICE_THEMES_URL.THEME.'/assets/css/main.css', 'css', 'all']
            ]
        ); 
    ?>
</head>
<?php if(isset($_SESSION['ice_error'])){?>
    <div class="alert alert-danger"><?php echo $_SESSION['ice_error']; unset($_SESSION['ice_error']); ?></div>
<?php } else if(isset($_SESSION['ice_success'])){?>
    <div class="alert alert-success"><?php echo $_SESSION['ice_success']; unset($_SESSION['ice_success']); ?></div>
<?php } ?>