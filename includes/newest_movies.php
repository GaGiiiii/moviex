 <!-- OWL CAROSEL -->
 <section id="top-rated-movies" class="mt-5">
   <div class="container">
     <h1>Newest movies</h1>
     <hr>
     <div class="owl-carousel owl-theme mt-5">

       <?php foreach ($moviesSortedByDate as $movie) : ?>
         <div class="item mr-4 text-center">
           <img src="<?php echo $movie['img'] ?? ""; ?>" alt="Banner1" data-toggle="modal" data-target="#movie-modal<?php echo $movie['id']; ?>">
           <h3 class="text-center movie-title mt-3"><?php echo $movie['title'] ?? "Unknown title"; ?></h3>
           <?php $rating = Movie::getRating($movie['id']); ?>
           <?php if (!User::isLoggedIn()) { ?>
             <?php
              $whole = floor($rating);      // 1
              $fraction = $rating - $whole; // .25
              $used = false;
              ?>

             <?php for ($i = 0; $i < $whole; $i++) : ?>
               <i class="fas fa-star"></i>
             <?php endfor; ?>
             <?php for ($i = 0; $i < 5 - $whole; $i++) : ?>
               <?php if ($fraction < 0.75 && !$used && $fraction != 0) { ?>
                 <i class="fas fa-star-half-alt"></i>
                 <?php $used = true; ?>
               <?php } else { ?>
                 <i class="far fa-star"></i>
               <?php } ?>
             <?php endfor; ?>
           <?php } else { ?>
             <!-- AKO JE ULOGOVAN -->
             AVG. Rating: <i class="fas fa-star"></i> <span class="movie-rating" data-movie-id="<?php echo $movie['id']; ?>">(<?php echo Movie::getRating($movie['id']); ?>)</span>
             <br>
             Your Rating: <br>
             <?php
              for ($i = 0; $i < $rating; $i++) :
              ?>
               <i class="star fas fa-star star-icon-hover text-warning voted" data-user-id="<?php echo $_SESSION['user']['id'] ?? "-1"; ?>" data-movie-id="<?php echo $movie['id']; ?>" data-rating="<?php echo $i + 1; ?>"></i>
             <?php endfor; ?>
             <?php for ($i = $rating; $i < 5; $i++) : ?>
               <i class="star fas fa-star star-icon-hover" data-user-id="<?php echo $_SESSION['user']['id'] ?? "-1"; ?>" data-movie-id="<?php echo $movie['id']; ?>" data-rating="<?php echo $i + 1; ?>"></i>
             <?php endfor; ?>
           <?php } ?>
           <span class="user-rating" data-movie-id="<?php echo $movie['id']; ?>"><?php if (isset($rating)) echo "($rating)"; ?></span>

         </div>
       <?php endforeach; ?>
     </div>
   </div>
 </section>
 <!-- OWL CAROSEL -->