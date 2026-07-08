<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-single' ); ?>>
    <div class="post-single__body">
        <div class="post-single__inner container">
            <header class="post-single__header">
                <?php the_title( '<h1 class="post-single__title">', '</h1>' ); ?>
                <p class="post-single__meta">
                    <?php echo esc_html( get_the_date() ); ?>
                    &nbsp;&middot;&nbsp;
                    <?php echo esc_html( ghh_get_reading_time() ); ?>
                </p>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-single__thumbnail">
                    <?php the_post_thumbnail( 'large' ); ?>
                </div>
            <?php endif; ?>

            <div class="post-single__content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</article>
