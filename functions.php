<?php

// Добавляем поля ИмяАвтора в запрос Rest Api
function university_custome_rest() {
    register_rest_field('post', 'authorName', array(
        'get_callback' => function() { return get_the_author(); }
    ));

    register_rest_field('post', 'perfectImage', array(
        'get_callback' => function() { return  get_the_post_thumbnail_url(); }
    ));
};

// Срабатывает в начале обработки REST API запроса
add_action('rest_api_init', 'university_custome_rest');

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

// add_filter( 'woocommerce_checkout_fields' , 'wpbl_show_fields' );
 
// function wpbl_show_fields( $array ) {
    
//     // Выводим список полей, но только если пользователь имеет права админа
//     if( current_user_can( 'manage_options' ) ){
    
//         echo '<pre>';
//         print_r( $array);
//         echo '</pre>';
//     }
    
//     return $array;
// }

// add_filter( 'woocommerce_checkout_fields', 'wpbl_remove_some_fields', 9999 );
 
// function wpbl_remove_some_fields( $array ) {
 
//     unset( $array['billing']['billing_first_name'] ); // Имя

//     return $array;
// }
// // Добавляем поля
// add_action( 'woocommerce_before_checkout_billing_form', 'wpbl_select_field' );
// add_action( 'woocommerce_after_order_notes', 'wpbl_checkbox_filed' );
 
// // Сохраняем поля
// add_action( 'woocommerce_checkout_update_order_meta', 'wpbl_save_fields' );
 
// // Поле select
// function wpbl_select_field( $checkout ){
 
//     // Описываем поле
//     woocommerce_form_field( 'nedron', array(
//         'type'          => 'text', // Тип поля. Можно любое - text, textarea, select, radio, checkbox, password. В нашем случае это select
//         'required'    => true, // этот параметр добавляет звездочку "*" к полю
//         'class'         => array('input-text', 'form-row-first '), // Массив CSS классов
//         'label'         => 'SUPPER NAME', // Заголовок поля
//         'label_class'   => 'input-text', // CSS класс заголовка
//         'maxlength'     => 1,
//         'custom_attributes' => array(
//             'some' => 'gaa'
//         )
//          ));
 
//     // Сюда так же можно добавить чуть-чуть HTML кода например <hr> и что-то ещё.
//     // В качестве примера мы добавляем стилевое оформление для выпадающего списка. Не далейте так. Все стили должны быть в CSS файле!
//     echo '<style>#na{padding:15px; background:#f1f1f1; border:none;}</style>';
 
// }

 
// // Поле checkbox
// function wpbl_checkbox_filed( $checkout ) {
 
//     woocommerce_form_field( 'subscribe', array(
//         'type'    => 'checkbox',
//         'class'    => array('wpbl-field form-row-wide'),
//         'label'    => ' Я хочу подписать на рассылку',
//         ), $checkout->get_value( 'subscribe' ) );
 
// }
 
// // Функция сохранения
// function wpbl_save_fields( $order_id ){
 
//     // Сохраняем select
//     if( !empty( $_POST['dron'] ) ){
//         update_post_meta( $order_id, 'dron', sanitize_text_field( $_POST['dron'] ) );
//     }
        
//     // Сохраняем checkbox
//     if( !empty( $_POST['subscribe'] ) && $_POST['subscribe'] == 1 ){
//         update_post_meta( $order_id, 'subscribe', 1 );
//     }
        
// }


add_filter( 'woocommerce_checkout_fields', 'checkout_fields_custom_attributes', 9999 );
 
function checkout_fields_custom_attributes( $fields ) {
   $fields['billing']['billing_first_name']['maxlength'] = 1;
   return $fields;
}

add_filter('woocommerce_checkout_posted_data', 'custom_woocommerce_checkout_posted_data');
function custom_woocommerce_checkout_posted_data($data){
    $username = $_POST['billing_first_name'];
    $usernamelength = strlen($username);
    $data['billing_first_name'] ? $data['billing_first_name'] = strtoupper(mb_substr($data['billing_first_name'], 0, 1)) . '.' : $data['billing_first_name'] = strtoupper($data['billing_first_name']) . '.';
    return $data;
}

