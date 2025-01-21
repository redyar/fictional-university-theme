<?php get_header();

  pageBanner(array(
    'title'    => 'All Campuses',
    'subtitle' => 'Campuses For Evereyone'
  ));
?>

<!-- 
<script>

update = function(el) {
  el.parentElement.setAttribute('data-value', el.value)
}

</script>
<?

// $username= 'casdaczxc';
// $usernamelength= strlen($username);
// if ($usernamelength > 1){
//   $username = strtoupper(mb_substr($username, 0, 1)) . '.';
// }else {
//   $username = strtoupper ($username);
// };

// $usernamelength > 1 ? $username = strtoupper(mb_substr($username, 0, 1)) . '.' : $username = strtoupper ($username);
// echo $username;
?>
<style>
  span[data-value] {
    position: relative;
    text-transform: uppercase;
  }
  span[data-value]:after {
    content: attr(data-value) ".";
    position: absolute;
    top: 2px; /* Borders */
    left: 2px; /* Borders */
  }
  span[data-value] input {
    color: #FFF; /* Optional bug avoid visual bugs */
  }
 
</style>

<span data-value="">
  <input type="text" class="normal igogo" name="Name" size="20" maxlength="1" style="text-transform:uppercase" oninput="update(this)"/> 
</span> -->


<!-- <div data-value="">
  <input maxlength="1"   oninput="update(this)"/>
</div> -->





  <div class="container container--narrow page-section">
    <div class="acf-map">
        <?php
        while(have_posts()) {
            the_post();
            
            $mapLocation = get_field('map_location');
            ?>
                <div class='marker' data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng'] ?>">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php echo $mapLocation['address'] ?>
                </div>

        <?php } ?>
    </div>
  </div>

<?php get_footer(); ?>