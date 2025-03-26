<?php

add_action('rest_api_init', 'universityRegisterySearch');

function universityRegisterySearch() {
    register_rest_route('university/v1', 'search', array(
        'methods'  => WP_REST_SERVER:: READABLE, //- safe version of this - "GET"
        'callback' => 'universitySearchResults'
    ));
}

function universitySearchResults($data) {
    $mainQuery = new WP_Query(array(
        'post_type' => array('post', 'page', 'professor', 'program', 'campus', 'event'),
        // поиск по части фразы
        's' => sanitize_text_field( $data['term'] ) //Очищает переданную строку оставляя чистый текст: без HTML тегов, переносов строк и т.д
    ));

    $results = array(
        'generalInfo' => array(),
        'professors' => array(),
        'programs' => array(),
        'events' => array(),
        'campuses' => array(),
    );

    while($mainQuery->have_posts()) {
        $mainQuery->the_post();
        if (get_post_type() == 'post' || get_post_type() == 'page') {
            array_push($results['generalInfo'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'post_type' => get_post_type(),
                'authorName' => get_the_author(),
            ));
        }
        if (get_post_type() == 'professor') {
            array_push($results['professors'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'post_type' => get_post_type(),
                'authorName' => get_the_author(),
                'thumbnail' => get_the_post_thumbnail_url(0, 'professorLandscape'),
            ));
        }
        if (get_post_type() == 'program' ) {
            array_push($results['programs'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'post_type' => get_post_type(),
                'authorName' => get_the_author(),
            ));
        }
        if (get_post_type() == 'event') {
            $event_date = get_field('event_month');
            $date = new DateTime($event_date);

            array_push($results['events'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'post_type' => get_post_type(),
                'authorName' => get_the_author(),
                'month' => $date->format('M'),
                'day' => $date->format('d'),
                'content' => wp_trim_words(get_the_content(), 5), // можно ещё использовать функцию get_excerpt()
            ));
        }
        if (get_post_type() == 'campus') {
            array_push($results['campuses'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'post_type' => get_post_type(),
                'authorName' => get_the_author(),
            ));
        }
    }

    return $results;
}