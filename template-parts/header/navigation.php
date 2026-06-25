<nav id="site-navigation" class="main-navigation" aria-label="Main Menu">
    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
        <span class="burger-bun"></span>
        <span class="burger-meat"></span>
        <span class="burger-bun"></span>
        <span class="screen-reader-text">Menu</span>
    </button>

    <?php
    // Render a left nav logo using the `menu-nav-icon` class. If you prefer to manage
    // the logo via Appearance → Menus, remove this block and add a menu item with
    // the `menu-nav-icon` class instead.
    $logo_src = get_template_directory_uri() . '/assets/images/ghh-logo-no-bg.png';
    ?>
    <a class="menu-nav-icon" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <img src="<?php echo esc_url( $logo_src ); ?>" alt="<?php bloginfo( 'name' ); ?>">
    </a>

    <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
</nav>
