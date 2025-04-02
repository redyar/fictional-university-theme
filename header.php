<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php
   function theme_custom_styles() {
    if(empty($theme_color)) $theme_color = 'default_value';



    
    $theme_color = get_field('theme_color', 'option');
    $text_color = get_field('text_color', 'option');
    $theme_font = get_field('theme_font', 'option');
    ?>
    <style>
        :root {
            --theme-color: <?php echo esc_attr($theme_color); ?>;
            --text_color: <?php echo esc_attr($text_color); ?>;
            --theme-font: <?php echo esc_attr($theme_font); ?>;
        }

        body {
          color: var(--text_color) !important;
          font-family: var(--theme-font) !important;
        }

        .headline--large {
            color: var(--text_color) !important;
            font-family: var(--theme-font) !important;
        }

        .full-width-split__one {
            background-color: var(--theme-color) !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'theme_custom_styles');
?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>

    
</head>
<!-- <style>
:root {
    --background-color: <?php the_field('background_color', 'option'); ?>;
    --text-color: <?php the_field('text_color', 'option'); ?>;
    --font-family: <?php the_field('font', 'option'); ?>;
}

body {
    background-color: var(--background-color);
    color: var(--text-color);
    font-family: var(--font-family);
}

#theme-toggle {
    padding: 10px 20px;
    background-color: var(--text-color);
    color: var(--background-color);
    border: none;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
}

#theme-toggle:hover {
    background-color: var(--background-color);
    color: var(--text-color);
}
</style> -->



<body <?php body_class(); ?>>
    <header class="site-header">
      <div class="container">
        <h1 class="school-logo-text float-left">
          <a href="<?php echo site_url('/'); ?>"><strong>Fictional</strong> University</a>
        </h1>
        <a href="<?php echo esc_url( site_url('/search') ); ?>" class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
        <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
        <div class="site-header__menu group">
          <nav class="main-navigation">
            <?php wp_nav_menu(array(
              'theme_location' => 'headerMenuLocation')
              ); ?>
          </nav>
          <div class="site-header__util">
              <?php if(is_user_logged_in()) {?>
                <a href="<?php echo wp_logout_url(); ?>" class="btn--with-photo btn btn--small btn--dark-orange float-left">
                <span class="site-header__avatar" ><?php echo get_avatar(get_current_user_id(), 60); ?></span>
                <span class="btn__text" >Log Out</span>
                </a>
              <?php
            }else{ ?>
                <a href="<?php echo wp_login_url(); ?>" class="btn btn--small btn--orange float-left push-right">Login</a>
                <a href="<?php echo wp_registration_url(); ?>" class="btn btn--small btn--dark-orange float-left">Sign Up</a>
            <?php } ?>

            <a href="<?php echo esc_url( site_url('/search') ); ?>" class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
    </header>
    <!-- <script>
document.getElementById('theme-toggle').addEventListener('click', function() {
    const root = document.documentElement;
    const currentBackground = getComputedStyle(root).getPropertyValue('--background-color').trim();
    const currentTextColor = getComputedStyle(root).getPropertyValue('--text-color').trim();

    // Пример переключения
    if (currentBackground === 'white') {
        root.style.setProperty('--background-color', 'black');
        root.style.setProperty('--text-color', 'white');
    } else {
        root.style.setProperty('--background-color', 'white');
        root.style.setProperty('--text-color', 'black');
    }
});
</script> -->
