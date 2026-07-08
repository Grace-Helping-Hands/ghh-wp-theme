<?php
get_header();
?>
<main id="site-content" class="">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/content/content', get_post_type() );
        endwhile;
        the_posts_navigation();
    else :
        get_template_part( 'template-parts/content/content', 'none' );
    endif;
    ?>
</main>
<?php
get_sidebar();
get_footer();
