<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="site-header" class="site-header container">
    <?php //get_template_part( 'template-parts/header/branding' ); ?>
    <?php get_template_part( 'template-parts/header/navigation' ); ?>
</header>
