<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title><?php wp_title( ' | ', true, 'right' ); ?></title>

<link rel="shortcut icon" href="<?php echo get_template_directory_uri().'/images/omg.gif'; ?>">
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri().'/images/omg.gif'; ?>">

<?php wp_head(); ?>

<link href="https://fonts.googleapis.com/css2?family=Bitter:ital,wght@0,400;0,700;1,400&family=Gochi+Hand&display=swap" rel="stylesheet">

</head>

<body <?php body_class(); ?>>

<div id="wrapper" style="display:none">

<div id="wrapper_inner">

<header id="header" class="textCenter animate">
	<div class="container">

		<h1 class="wow bounceInDown"><?php bloginfo('name'); ?></h1>

		<div id="nav" class="absolute leftRight wow bounceInLeft">
			<ul>
				<?php
				$args = array(
					'theme_location' => 'main-nav',
					'items_wrap' => '%3$s',
					'container' => ''
				);
				wp_nav_menu($args); ?>
			</ul>
		</div>

	</div>
</header>
	