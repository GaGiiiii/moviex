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
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
              </div>
            </div>

          <?php endforeach; ?>

        </div>
      </div>

    </div>
  </div>
</secion>
<!-- SPECIAL PRICE -->