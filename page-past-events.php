<?php get_header(); 

pageBanner(array(
  'title'    => 'Past Events',
  'subtitle' => 'All our Past Events!'
));
?>

  <div class="container container--narrow page-section">
    <?php
    $today = date('Ymd');
    $pastEvent = new WP_Query(array(
        'paged'          => get_query_var('paged', 1), //for pagination
        'posts_per_page' => -1,
        'post_type'      => 'event',
        'meta_key'       => 'event_month',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
        'meta_query'     => array(
          array(
            'key'     => 'event_month',
            'compare' => '<',
            'value'   => $today,
            'type'    => 'numeric'
          )
        )
      ));

      while($pastEvent->have_posts()) {
        $pastEvent->the_post();?>
            <?php
            $event_date = get_field('event_month');
            $date = new DateTime($event_date);
            get_template_part('template-parts/event', 'excerpt'); 
          }

      echo paginate_links(array(
        'total' => $pastEvent->max_num_pages,
      ));
    ?>
  </div>

<?php get_footer(); ?>