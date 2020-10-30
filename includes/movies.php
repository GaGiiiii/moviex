<!-- SPECIAL PRICE -->
<secion id="movies">
  <div class="container mt-5 p-0">
    <h1 class="ml-2">MOVIES</h1>
    <hr>
    <div class="button-group text-right">
      <button class="btn sort-btn" data-sort-type="price">Price</button>
      <button class="btn sort-btn" data-sort-type="length">Length</button>
      <form class="form-inline my-2 my-lg-0 d-inline-block">
        <input class="form-control mr-sm-2 search-input" type="text" placeholder="Search">
      </form>
    </div>

    <div class="grid text-center">

      <div class="container-fluid">
        <div class="row movies-div">

          <?php foreach ($movies as $movie) : ?>

            <div class="col-md-4">
              <div class="item text-center border p-3">

                <img src="<?php echo $movie['img'] ?? ""; ?>" alt="Banner1" data-toggle="modal" data-target="#movie-modal<?php echo $movie['id']; ?>">
                <h3 class="text-center movie-title mt-3"><?php echo $movie['title'] ?? "Title not found"; ?></h3>
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
            </div>

          <?php endforeach; ?>

        </div>
      </div>

    </div>
  </div>
</secion>
<!-- SPECIAL PRICE -->