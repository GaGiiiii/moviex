 <!-- OWL CAROSEL -->
 <section id="banner-area">
      <div class="owl-carousel owl-theme">
            <?php foreach($movies as $movie): ?>
              <div class="item">
                  <img src="<?php echo $movie['img'] ?? ""; ?>" alt="Banner1">
              </div>
            <?php endforeach; ?>
      </div>
  </section>
  <!-- OWL CAROSEL -->