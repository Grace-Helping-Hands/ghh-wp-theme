<?php
/*
Template Name: Full Width
*/
get_header();
?>
<main class="full-width">
    <?php
    while ( have_posts() ) : the_post();
        get_template_part( 'template-parts/content/content', 'page' );
    endwhile;
    ?>
</main>
<?php get_footer();
