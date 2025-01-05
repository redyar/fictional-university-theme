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
            get_template_part('template-parts/event', 'excerpt');
          }

      echo paginate_links();
    ?>

        <p>Looking for a recap of past events? <a href="<?php echo site_url('/past-events'); ?>">Check out our past events archive.</a></p>

  </div>

<?php get_footer(); ?>