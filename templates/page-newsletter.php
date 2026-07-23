<?php
/*
Template Name: Newsletter
*/

get_header();
?>

<main id="site-content" class="newsletter-page">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <section class="newsletter-hero">
            <div class="newsletter-container">
                <?php the_title( '<h1 class="newsletter-page__title">', '</h1>' ); ?>
                <div class="newsletter-page__body">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>
        <?php
    endwhile;

    $newsletters = new WP_Query(
        array(
            'post_type'      => 'newsletter',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        )
    );
    ?>

    <section class="newsletter-list-section" aria-label="<?php esc_attr_e( 'Newsletters', 'ghh' ); ?>">
        <div class="newsletter-container">
            <?php if ( $newsletters->have_posts() ) : ?>
                <div class="newsletter-list">
                    <?php
                    while ( $newsletters->have_posts() ) :
                        $newsletters->the_post();
                        $newsletter_url    = ghh_newsletter_get_destination_url( get_the_ID() );
                        $newsletter_target = ghh_newsletter_link_target( $newsletter_url );
                        ?>
                        <article <?php post_class( 'newsletter-card' ); ?>>
                            <?php if ( $newsletter_url ) : ?>
                                <a
                                    class="newsletter-card__media"
                                    href="<?php echo esc_url( $newsletter_url ); ?>"
                                    <?php echo $newsletter_target ? 'target="' . esc_attr( $newsletter_target ) . '" rel="noopener"' : ''; ?>
                                    aria-label="<?php echo esc_attr( sprintf( __( 'Read %s', 'ghh' ), get_the_title() ) ); ?>"
                                >
                            <?php else : ?>
                                <div class="newsletter-card__media">
                            <?php endif; ?>
                                <?php $newsletter_image = ghh_newsletter_get_card_image_html( get_the_ID() ); ?>
                                <?php if ( $newsletter_image ) : ?>
                                    <?php echo wp_kses_post( $newsletter_image ); ?>
                                <?php else : ?>
                                    <span class="newsletter-card__placeholder"><?php esc_html_e( 'Newsletter', 'ghh' ); ?></span>
                                <?php endif; ?>
                            <?php if ( $newsletter_url ) : ?>
                                </a>
                            <?php else : ?>
                                </div>
                            <?php endif; ?>

                            <div class="newsletter-card__content">
                                <time class="newsletter-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                    <?php echo esc_html( strtoupper( get_the_date( 'F Y' ) ) ); ?>
                                </time>
                                <?php the_title( '<h2 class="newsletter-card__title">', '</h2>' ); ?>
                                <div class="newsletter-card__summary">
                                    <p><?php echo esc_html( ghh_newsletter_get_card_summary( get_the_ID() ) ); ?></p>
                                </div>
                            </div>

                            <?php if ( $newsletter_url ) : ?>
                                <a
                                    class="newsletter-card__button"
                                    href="<?php echo esc_url( $newsletter_url ); ?>"
                                    <?php echo $newsletter_target ? 'target="' . esc_attr( $newsletter_target ) . '" rel="noopener"' : ''; ?>
                                >
                                    <span><?php esc_html_e( 'Read Newsletter', 'ghh' ); ?></span>
                                    <span class="newsletter-card__arrow" aria-hidden="true">&rarr;</span>
                                </a>
                            <?php endif; ?>
                        </article>
                    <?php endwhile; ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p class="newsletter-empty"><?php esc_html_e( 'No newsletters have been published yet.', 'ghh' ); ?></p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
