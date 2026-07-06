<?php
get_header();
?>
<main id="site-content" class="py-md">
    <section class="container">
        <header class="page-header pb-md">
            <h1 class="page-title"><?php single_post_title( 'Blogs' ); ?></h1>
            <p class="page-excerpt"><?php echo esc_html( get_the_excerpt( get_queried_object_id() ) ); ?></p>
        </header>

        <?php if ( have_posts() ) : ?>
            <div class="blog-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
                        <a class="post-card__link" href="<?php the_permalink(); ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium_large', array( 'class' => 'post-card__media' ) ); ?>
                            <?php else : ?>
                                <div class="post-card__media" aria-hidden="true"></div>
                            <?php endif; ?>
                            <div class="post-card__body">
                                <span class="post-card__meta"><?php echo esc_html( get_the_date() ); ?></span>
                                <h2 class="post-card__title"><?php the_title(); ?></h2>
                                <?php
                                $post_excerpt = get_the_excerpt();
                                if ( empty( $post_excerpt ) ) {
                                    $post_excerpt = wp_strip_all_tags( wp_trim_words( strip_shortcodes( get_the_content( '' ) ), 30, '…' ) );
                                }
                                ?>
                                <p class="post-card__excerpt"><?php echo esc_html( $post_excerpt ); ?></p>
                                <span class="post-card__readmore"><?php esc_html_e( 'Read article', 'ghh' ); ?></span>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="pagination-wrap">
                <?php
                the_posts_pagination(
                    array(
                        'mid_size'  => 2,
                        'prev_text' => esc_html__( 'Previous', 'ghh' ),
                        'next_text' => esc_html__( 'Next', 'ghh' ),
                    )
                );
                ?>
            </div>
        <?php else : ?>
            <?php get_template_part( 'template-parts/content/content', 'none' ); ?>
        <?php endif; ?>
    </section>
</main>
<?php
get_footer();
