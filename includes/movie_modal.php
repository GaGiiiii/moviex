<?php foreach ($movies as $movie) : ?>

<?php $trailer = str_replace("watch?v=", "embed/", $movie['trailer']); ?>

<!-- Modal -->
<div class="movie-modal">
  <div class="modal fade" id="movie-modal<?php echo $movie['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="container mt-5">

          <div class="row">
            <div class="col-md-12 bg-primary pb-5">
              <h1 class="text-white pt-4 pb-2"><?php echo $movie['title'] ?? "Unknown"; ?></h1>
              <iframe width="100%" height="80%" src="<?php echo $trailer ?? ""; ?>"></iframe>
            </div>
          </div>

          <div class="row mt-5 mb-5">
            <div class="col-md-12 p-0">
              <div class="movie-card py-3 px-1">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-3">
                      <img src="<?php echo $movie['img'] ?? ""; ?>" alt="Banner1">
                    </div>
                    <div class="col-md-9">
                      <p class="mb-0 text-left mb-0">Title: <?php echo $movie['title'] ?? ""; ?></p>
                      <p class="mb-0 mt-2 text-left">Length: <?php echo $movie['length'] ?? ""; ?> mins</p>
                      <p class="text-left mt-2 mb-0">Genre: <?php echo $movie['genre'] ?? ""; ?></p>
                      <p class="text-left mt-2 mb-0">Price: <?php echo $movie['price'] ?? ""; ?> RSD</p>
                      <p class="text-left mt-2 mb-0">Director: <?php echo $movie['director'] ?? ""; ?></p>
                      <p class="text-left mt-2 mb-0">Actors: <?php echo $movie['actors'] ?? ""; ?></p>
                    </div>
                    <div class="movie-description p-2 ml-3 border mt-3">
                      <?php echo $movie['description'] ?? ""; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<?php endforeach; ?>