<div class="site-branding">
    <?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); } ?>
    <div class="site-title">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
        <p class="site-description"><?php bloginfo( 'description' ); ?></p>
    </div>
</div>
