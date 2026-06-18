<section class="home-hero home-hero--split">
    <div class="hero-row container">
        <div class="hero-inner">
            <h1 class="hero-title"><?php the_title(); ?></h1>
            <div class="hero-excerpt"><?php the_excerpt(); ?></div>
            <div class="hero-cta">
                <a class="btn btn-primary" href="<?php echo esc_url( home_url( '/donate' ) ); ?>">Donate</a>
                <a class="btn btn-secondary" href="<?php echo esc_url( home_url( '/get-involved' ) ); ?>">Learn More</a>
            </div>
            <?php //edit_post_link( __( 'Edit', 'ghh' ), '<p class="edit-link">', '</p>' ); ?>
        </div>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="hero-image">
                <?php the_post_thumbnail( 'full' ); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
