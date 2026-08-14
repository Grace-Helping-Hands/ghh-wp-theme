<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="site-announcement" data-announcement-id="kendra-gives-back-2026-08-29-v2">
    <div class="site-announcement__inner">
        <span class="site-announcement__icon" aria-hidden="true">✦</span>
        <p class="site-announcement__message">Shine Bright, Do Good! Join us for a Kendra Gives Back Event on Saturday, August 29 from 1–3pm at The Mall in Columbia. 20% of sales support Grace Helping Hands.</p>
        <a class="site-announcement__link" href="<?php echo esc_url( home_url( '/kendra-gives-back-event/' ) ); ?>">Learn More</a>
        <button class="site-announcement__close" type="button" aria-label="Dismiss announcement">×</button>
    </div>
</div>
<header id="site-header" class="container">
    <?php //get_template_part( 'template-parts/header/branding' ); ?>
    <?php get_template_part( 'template-parts/header/navigation' ); ?>
</header>
