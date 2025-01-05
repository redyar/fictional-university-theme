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
            ?>
            <div class="event-summary">
            <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
            <span class="event-summary__month"><?php echo $date->format('M'); ?></span>
            <span class="event-summary__day"><?php echo $date->format('j'); ?></span>
            </a>
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
              <p><?php echo wp_trim_words(get_the_content(), 18); ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
            </div>
          </div>

      <?php }

      echo paginate_links(array(
        'total' => $pastEvent->max_num_pages,
      ));
    ?>
  </div>

<?php get_footer(); ?>