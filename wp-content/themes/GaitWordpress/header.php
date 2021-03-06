<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bulmapress
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="is-fullheight">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<?php bulmapress_skip_link_screen_reader_text(); ?>
		<header id="header">
			<nav id="site-navigation" class="navbar" role="navigation">
				<div class="navbar-brand">
					<img style="margin-left:0.25rem;" src="<?php echo get_template_directory_uri() . '/dist/gait_logo.svg' ?>"/>


                    <?php bulmapress_home_link('navbar-item'); ?>
					<?php bulmapress_menu_toggle(); ?>
				</div>
				<div class="navbar-menu">
					<div class="navbar-start"></div>
					<?php bulmapress_navigation(); ?>
				</div>
			</nav>
		</header>

		<div id="content" class="site-content">


