<?php

get_header();

while (have_posts()) {
  the_post(); 
  
  pageBanner();
  ?>

    <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
          <p>
            <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>">
              <i class="fa fa-home" aria-hidden="true"></i> All Programs
            </a>
            <span class="metabox__main"><?php the_title() ?></span>
          </p>
        </div>
      <div class="generic-content"><?php the_content(); ?></div>

      <?php

          $relatedProffesors = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type'      => 'professor',
            'orderby'        => 'title',
            'order'          => 'ASC',
            'meta_query'     => array(
              array(
                  'key'     => 'related_programs',
                  'compare' => 'LIKE', // содержит, т.е. если ключ содержит такую id то работаем
                  'value'   => '"' . get_the_ID() . '"',
              )
            )
          ));
          if($relatedProffesors->have_posts()) {
              echo '<hr class="section-break">';
              echo '<h2 class="headline headline--medium"> Professors: </h2>';
              echo '<ul class="professor-cards" >';
                while($relatedProffesors->have_posts()) {
                $relatedProffesors->the_post();?>
                <?php
                ?>
                    <li class="professor-card__list-item">
                      <a class="professor-card" href="<?php echo get_the_permalink(); ?>">
                        <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape'); ?>" alt="">
                        <span class="professor-card__name"><?php the_title(); ?></span>
                      </a>
                    </li>
                <?php }
                echo '</ul>';
              wp_reset_postdata();
          }




            $today = date('Ymd');
            $homepageEvents = new WP_Query(array(
              'posts_per_page' => 2,
              'post_type'      => 'event',
              'orderby'        => 'title',
              'order'          => 'ASC',
              'meta_query'     => array(
                array(
                  'key'     => 'event_month',
                  'compare' => '<=',
                  'value'   => $today,
                  'type'    => 'numeric'
                ),
                array(
                    'key'     => 'related_programs',
                    'compare' => 'LIKE', // содержит, т.е. если ключ содержит такую id то работаем
                    'value'   => '"' . get_the_ID() . '"',
                )
              )
            ));
              if($homepageEvents->have_posts()) {
                echo '<hr class="section-break">';
                echo '<h2 class="headline headline--medium"> Upcoming ' . get_the_title() . ' Events </h2>';
                while($homepageEvents->have_posts()) {
                $homepageEvents->the_post();
                get_template_part('template-parts/event', 'excerpt');
              }
            }
            wp_reset_postdata(); 


            $relatedCampus = get_field('related_campus');
           
            if($relatedCampus) {
              echo '<hr class="section-break">';
              echo '<h2 class="headline headline--medium">Available Campus(es)</h2>';
              echo '<ul class="min-list link-list">';
              foreach($relatedCampus as $campus) {?>
                <li><a href="<?php echo get_the_permalink($campus); ?>"><?php echo get_the_title($campus); ?></a></li>
              <?php }
              echo '</ul>';
            }
          ?>
    </div>
<?php }

get_footer();
?>