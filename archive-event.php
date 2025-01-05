<?php get_header();

  pageBanner(array(
    'title'    => 'All Event',
    'subtitle' => 'we are Events'
  ));
?>

  <div class="container container--narrow page-section">
    <?php
      while(have_posts()) {
        the_post();?>
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

      echo paginate_links();
    ?>

        <p>Looking for a recap of past events? <a href="<?php echo site_url('/past-events'); ?>">Check out our past events archive.</a></p>

  </div>

<?php get_footer(); ?>