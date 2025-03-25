<?php

get_header();

while (have_posts()) {
  the_post();

  pageBanner();

  ?>



    <div class="container container--narrow page-section">
      <div class="generic-content">
        <div class="row group">
            <div class="one-third"><?php the_post_thumbnail('professorPortrait'); ?></div>
            <div class="two-third"><?php the_content(); ?></div>
            <img width="400" height="400" src="<?php get_field('image_mobile'); ?>" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="" srcset=" <?php get_field('image_mobile'); ?> 100w, <?php get_field('image_mobile_1'); ?> 400w," sizes="(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px">

            <?php $slides = get_field('mobile_and_desctop'); ?>


            <style>
        #output {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>



    <textarea id="myTextarea" placeholder="Введите текст здесь..."></textarea>
    <button onclick="insertText()">Вставить текст</button>

    <div id="output">Текст будет вставлен сюда</div>


    <div class="hello"> 
        <p>first</p> 
        <p>second</p>
    </div>

    
    <script>

        let inp = document.getElementById("myTextarea");
        inp = inp.getAttribute("placeholder");
        console.log(inp);

    // Находим элемент с классом hello
    const helloDiv = document.querySelector('.hello');

    // Находим все теги p внутри helloDiv
    const paragraphs = helloDiv.querySelectorAll('p');

    // Проверяем, что находимся как минимум во втором p
    if (paragraphs.length > 1) {
        // Создаем новый текстовый узел
        const newText = document.createElement('p');
        newText.textContent = inp;

        // Вставляем новый элемент после второго <p>
        helloDiv.insertBefore(newText, paragraphs[2]);
    }

        //alert(inp.getAttribute("placeholder"));


    </script>


<input type="text" id="search-box" name="sel"  placeholder='123' value=""/>
<button type="submit">Otpravit</button>

            <?php foreach ($slides as $slide) :
              ?>
                <?php if( wp_is_mobile() ) { ?>
                  <div class="mobile main-slider-slide" data-main-slider-slide style="background-image: url('<?php echo $slide['modile_img']; ?>');"> 
                <?php }else {?>
                  <div class="swiper-slide main-slider-slide" data-main-slider-slide style="background-image: url('<?php echo $slide['desctop_img']; ?>');" >
                <?php } ?>
                                asdasd
                                </br>
                                dsf</br>

                                sd</br>

                                fclosesdf</br>

                                shm_detachfs</br>
                                </br>
                                </br>
                                </br>

                    </div>
                    <?php 
                      // Определяем фон в зависимости от того, мобильное ли устройство
                        $adaptive_background_image = wp_is_mobile() ? $mobile_background_image : $background_image;

                        // Определяем дополнительные классы для слайда
                        $additionalClasses = !empty($slide['main-slider__slide_with_text']) ? 'main-slider-slide--content' : '';
                        ?>

                        <div
                            class="swiper-slide main-slider-slide <?php echo $additionalClasses; ?>"
                            data-main-slider-slide
                            style="background-image: url('<?php echo esc_url($adaptive_background_image); ?>');"
                        >
                        </div>


              <!-- <img
                src="изображение-маленькое.png"
                srcset="<?php echo $slide['desctop_img']; ?> 320w, <?php echo $slide['modile_img']; ?> 800w, <?php echo $slide['desctop_img']; ?> 1200w"
                alt="Описание изображения"
              />

              <picture>
                <source media="(orientation: landscape)" srcset="<?php echo $slide['desctop_img']; ?>">

                <source media="(orientation: portrait)" srcset="<?php echo $slide['modile_img']; ?>">

                <img src="testlandscape.png" width="100%" height="auto">
              </picture> -->
            <?php endforeach; ?>

        </div>
        <div class="helloo"> 
    <h3>first</h3> 
    <p>second</p>
</div>




<div class="container1">
  <div class="top">
    <input type="text">
  </div>
  <div class="btnn">
    <a href="#" class="btnn">Click me</a>
  </div>
</div>

<style>


.container1 {
  position: relative; /* Устанавливаем контейнер как относительный для позиционирования */
  width: 300px; /* Ширина контейнера */
}

.top input {
  width: 100%; /* Ширина поля ввода */
  padding-right: 40px; /* Отступ справа для кнопки */
}

.btnn {
  position: absolute; /* Абсолютное позиционирование */
  top: 50%; /* Позиционируем по вертикали */
  right: 10px; /* Позиционируем по горизонтали */
  transform: translateY(-50%); /* Смещаем на половину высоты для точного центрирования */
  text-decoration: none; /* Убираем подчеркивание у ссылки */
  color: #000; /* Цвет текста */
  background-color: #f0f0f0; /* Цвет фона */
  padding: 5px 10px; /* Отступы внутри кнопки */
  border-radius: 3px; /* Скругление углов */
}
</style>




<script>
    // Находим элемент с классом hello
    var div = document.querySelector('.helloo');
    
    // Находим первый элемент h3 внутри этого div
    var h3 = div.querySelector('h3');
    
    // Создаем новый элемент с текстом
    var newText = document.createElement('p'); // например, создадим новый параграф
    newText.textContent = 'Этот текст вставлен после первого h3.';
    
    // Вставляем новый элемент после h3
    h3.insertAdjacentElement('afterend', newText);



    let a = document.createElement('a');

    a.setAttribute('href', '#');
    a.textContent = 'foo';

    document.body.appendChild(a);
console.log(a);
</script>
      </div>

      <?php
        $relatedPrograms = get_field('related_programs');
        if($relatedPrograms) {
          echo '<hr class="section-break">';
          echo '<h2 class="headline headline--medium">Subject(s) Tought</h2>';
          echo '<ul class="link-list min-list">';
          foreach($relatedPrograms as $program) {?>
            <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>
          <?php }
          echo '</ul>';
        }
      ?>
    </div>
<?php }

get_footer();
?>