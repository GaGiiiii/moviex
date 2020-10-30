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
           <i class="fas fa-star"></i>
           <i class="fas fa-star"></i>
           <i class="fas fa-star"></i>
           <i class="fas fa-star"></i>
           <i class="far fa-star"></i>
           <!-- <p class="mb-0 mt-3 text-left">Length: </p>
                    <p class="text-left mb-0">Genre: </p>
                    <p class="text-left mb-0">Director: </p>
                    <p class="text-left mb-0">Actors: </p> -->
         </div>
       <?php endforeach; ?>
     </div>
   </div>
 </section>
 <!-- OWL CAROSEL -->