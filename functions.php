<?php

add_action( 'wp_enqueue_scripts',  'university_files' );

add_action( 'after_setup_theme', 'uninversity_features' );

add_action('init', 'university_post_type');

function pageBanner($args = NULL) {

    $default_image = get_theme_file_uri('images/ocean.jpg');
    $banner_image = get_field('page_banner_image');
    $pageBannerSubtitle = get_field('page_banner_subtitle');

    if( !isset($args['title']) ) {
        $args['title'] = get_the_title();
    };
    
    if( !isset($args['subtitle']) ) {
        $args['subtitle'] = $pageBannerSubtitle;
    };
    ?>
        <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo ( ! empty($banner_image['sizes']['pageBanner']) ? $banner_image['sizes']['pageBanner'] : $default_image); ?>">
        </div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
        <div class="page-banner__intro">
          <p><?php echo $args['subtitle']; ?></p>
        </div>
      </div>
    </div>
<?php }

function university_files() {
    wp_enqueue_script('googlMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyBjatI4HHdd4AyGYDkaGx2U4tcpuslggTg&loading=async', NULL, '1.0', true);
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));

    // Эта функция регистрирует данные для указанного скрипта, затем перед выводом (подключением) самого скрипта указанные в этой функции данные выводятся в теге <script> в виде JS объекта.
    // Добавляем функцию адреса сайта для основного JS скрипта
    wp_localize_script('main-university-js', 'universityData', array(
        'root_url' => get_site_url()
    ));

}

function uninversity_features() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);

    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerMenuLocationOne', 'Footer Menu Location');
    register_nav_menu('footerMenuLocationTwo', 'Footer Menu Location Two');
}

add_action('pre_get_posts', 'university_ajust_queries');

function university_ajust_queries($query) {

    if( !is_admin() && is_post_type_archive('event') && $query->is_main_query()){
        $query->set('meta_key', 'event_month');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'DESC',);
    };

    if( !is_admin() && is_post_type_archive('program') && $query->is_main_query()){
        $query->set('orderby', 'title',);
        $query->set('order', 'ASC',);
        $query->set('post_per_page', '-1',);
    }

    if( !is_admin() && is_post_type_archive('campus') && $query->is_main_query()){
        $query->set('post_per_page', '-1',);
    };

}

function universityMapKey() {
    $api['key'] = 'AIzaSyBjatI4HHdd4AyGYDkaGx2U4tcpuslggTg';
    return $api;
}

add_filter('acf/fields/google_map/api', 'universityMapKey');