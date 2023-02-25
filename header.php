<!DOCTYPE html>
<!--[if IE 9 ]> <html <?php language_attributes(); ?> class="ie9 <?php flatsome_html_classes(); ?>"> <![endif]-->
<!--[if IE 8 ]> <html <?php language_attributes(); ?> class="ie8 <?php flatsome_html_classes(); ?>"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="<?php flatsome_html_classes(); ?>"> <!--<![endif]-->

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php do_action('flatsome_after_body_open'); ?>
	<?php wp_body_open(); ?>

	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'flatsome'); ?></a>

	<div id="wrapper">

		<?php do_action('flatsome_before_header'); ?>

		<header id="header" class="header <?php flatsome_header_classes(); ?>">
			<div class="header-wrapper">
				<?php get_template_part('template-parts/header/header', 'wrapper'); ?>
			</div>
		</header>

		<?php do_action('flatsome_after_header'); ?>

		<main id="main" class="<?php flatsome_main_classes(); ?>">
			<?php
			$obj = get_queried_object();
			if ($obj->taxonomy !== 'product_cat' && $obj->post_type !== 'product' && $obj->post_name !== 'home') {
			?>

				<div class="row yoast_breadcrumb_child">
					<div class="col small-12">
						<?php
						if (function_exists('yoast_breadcrumb')) {
							yoast_breadcrumb('
							<div class="page-title-inner flex-row  medium-flex-wrap container">
	  <div class="flex-col flex-grow medium-text-center">
	  	<div class="is-large">
							<nav id="breadcrumbs" class="woocommerce-breadcrumb breadcrumbs uppercase">', '</nav></div>
							</div></div>		
						');
						}
						?>
					</div>
				</div>
			<?php
			}
			?>