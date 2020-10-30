<?php

include 'includes/functions.php';
include 'classes/Movie.php';
include 'classes/User.php';

$movies = Movie::getAll();
shuffle($movies);

if (User::isLoggedIn() && !$_SESSION['user']['is_admin']) {
  header("Location: index");
}

include_once 'includes/add_movie_logic.php';
include_once 'includes/update_movie_logic.php';
include_once 'includes/delete_movie_logic.php';

?>

<?php include 'includes/header.php'; ?>

<?php printFlashMessage("movie_add_success"); ?>
<?php if (isset($fail) && $fail) printFlashMessageFail("movie_add_fail"); ?>

<?php printFlashMessage("movie_update_success"); ?>
<?php if (isset($fail) && $fail) printFlashMessageFail("movie_update_fail"); ?>

<?php printFlashMessage("movie_delete_success"); ?>
<?php if (isset($fail) && $fail) printFlashMessage("movie_delete_success"); ?>

<div class="container-fluid mt-5">
  <div class="row">

    <?php foreach ($movies as $key => $movie) : ?>

      <!-- UPDATE MOVIE -->
      <div class="col-md-4 col-sm-6">
        <div class="card-admin" data-index="<?php echo $key; ?>">
          <a href="#" class="hhover-link" data-target="#updMo<?php echo $movie['id']; ?>" data-toggle="modal">
            <div class="invisible-custom invis ">
              <h1>UPDATE</h1>
            </div>
            <img src="<?php echo $movie['img'] ?? ""; ?>" alt="Banner1">
            <h1 class="text-break"><?php echo $movie['title']; ?></h1>
          </a>
        </div>
      </div>

      <div class="modal modal-update-color" id="updMo<?php echo $movie['id']; ?>" data-target="targetupdMo<?php echo $movie['id']; ?>">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">UPDATE "<?php echo $movie['title']; ?>"</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                <fieldset>
                  <div class="form-group">
                    <input type="text" name="movie_title_update" class="form-control" value="<?php echo $movie['title'] ?? ""; ?>" placeholder="Enter movie title">
                    <?php echo $errors['movie_title_update'] ?? ""; ?>
                  </div>

                  <div class="form-group">
                    <input type="text" name="movie_img_update" class="form-control" value="<?php echo $movie['img'] ?? ""; ?>" placeholder="Enter img URL">
                    <?php echo $errors['movie_img_update'] ?? ""; ?>
                  </div>

                  <div class="form-group">
                    <input type="text" name="movie_genre_update" class="form-control" value="<?php echo $movie['genre'] ?? ""; ?>" placeholder="Enter movie genre">
                    <?php echo $errors['movie_genre_update'] ?? ""; ?>
                  </div>

                  <div class="form-group">
                    <input type="number" name="movie_price_update" class="form-control" value="<?php echo $movie['price'] ?? ""; ?>" placeholder="Enter movie price">
                    <?php echo $errors['movie_price_update'] ?? ""; ?>
                  </div>

                  <div class="form-group">
                    <input type="number" name="movie_length_update" class="form-control" value="<?php echo $movie['length'] ?? ""; ?>" placeholder="Enter movie length">
                    <?php echo $errors['movie_length_update'] ?? ""; ?>
                  </div>

                  <div class="form-group">
                    <input type="text" name="movie_trailer_update" class="form-control" value="<?php echo $movie['trailer'] ?? ""; ?>" placeholder="Enter trailer URL">
                    <?php echo $errors['movie_trailer_update'] ?? ""; ?>
                  </div>

                  <div class="form-group">
                    <input type="text" name="movie_director_update" class="form-control" value="<?php echo $movie['director'] ?? ""; ?>" placeholder="Enter movie director">
                    <?php echo $errors['movie_director_update'] ?? ""; ?>
                  </div>

                  <div class="form-group">
                    <input type="text" name="movie_actors_update" class="form-control" value="<?php echo $movie['actors'] ?? ""; ?>" placeholder="Enter movie actors">
                    <?php echo $errors['movie_actors_update'] ?? ""; ?>
                  </div>

                  <div class="form-group">
                    <input type="date" name="movie_date_update" class="form-control" value="<?php echo $movie['publish_date'] ?? ""; ?>">
                    <?php echo $errors['movie_date_update'] ?? ""; ?>
                  </div>

                  <div class="form-group">
                    <textarea class="form-control" rows="3" name="movie_description_update" placeholder="Enter movie description"><?php echo $movie['description'] ?? ""; ?></textarea>
                    <?php echo $errors['movie_description_update'] ?? ""; ?>
                  </div>

                  <div class="text-center">
                    <input type="hidden" name="movie_id_update" value="<?php echo $movie['id']; ?>">
                    <button type="submit" name="update_movie" class="btn btn-outline-primary">UPDATE</button>
                    <a data-toggle="modal" data-target="#delete-are-you-sure<?php echo $movie['id']; ?>" class="btn btn-outline-danger">DELETE</a>
                    <!-- DELETE MODAL -->
                    <div class="modal" id="delete-are-you-sure<?php echo $movie['id']; ?>" data-backdrop="static">
                      <div class="modal-dialog delete-movie-modal">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">ARE YOU SURE YOU WANT TO DELETE "<?php echo $movie['title'] ?? "Unknown title"; ?>"</h4>
                            <button type="button" class="close" data-toggle="modal" data-target="#updMo<?php echo $movie['id']; ?>" data-dismiss="modal" aria-hidden="true">×</button>
                          </div>
                          <div class="container"></div>
                          <div class="modal-footer">
                            <button type="submit" name="delete_movie" class="btn btn-outline-danger">YES</button>
                            <button href="updMo<?php echo $movie['id']; ?>" data-toggle="modal" data-target="#updMo<?php echo $movie['id']; ?>" data-dismiss="modal" class="btn btn-outline-secondary">CANCEL</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- DELETE MODAL -->
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">CANCEL</button>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- UPDATE MOVIE -->

    <?php endforeach; ?>


  </div>
</div>

<!-- ADD MOVIE -->
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12" style="text-align:center;">
      <button style="text-align: center;" type="submit" class="add-movie-btn btn btn-xs btn-primary" data-target="#addMo" data-toggle="modal">ADD MOVIE &nbsp; <i class="fas fa-plus"></i></button>
    </div>
  </div>
</div>

<div class="modal" id="addMo">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add movie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
          <fieldset>
            <div class="form-group">
              <input type="text" name="movie_title_add" class="form-control" value="<?php echo $movieTitleAdd ?? ""; ?>" placeholder="Enter movie title">
              <?php echo $errors['movie_title_add'] ?? ""; ?>
            </div>

            <div class="form-group">
              <input type="text" name="movie_img_add" class="form-control" value="<?php echo $movieImgAdd ?? ""; ?>" placeholder="Enter img URL">
              <?php echo $errors['movie_img_add'] ?? ""; ?>
            </div>

            <div class="form-group">
              <input type="text" name="movie_genre_add" class="form-control" value="<?php echo $movieGenreAdd ?? ""; ?>" placeholder="Enter movie genre">
              <?php echo $errors['movie_genre_add'] ?? ""; ?>
            </div>

            <div class="form-group">
              <input type="number" name="movie_price_add" class="form-control" value="<?php echo $moviePriceAdd ?? ""; ?>" placeholder="Enter movie price">
              <?php echo $errors['movie_price_add'] ?? ""; ?>
            </div>

            <div class="form-group">
              <input type="number" name="movie_length_add" class="form-control" value="<?php echo $movieLengthAdd ?? ""; ?>" placeholder="Enter movie length">
              <?php echo $errors['movie_length_add'] ?? ""; ?>
            </div>

            <div class="form-group">
              <input type="text" name="movie_trailer_add" class="form-control" value="<?php echo $movieTrailerAdd ?? ""; ?>" placeholder="Enter trailer URL">
              <?php echo $errors['movie_trailer_add'] ?? ""; ?>
            </div>

            <div class="form-group">
              <input type="text" name="movie_director_add" class="form-control" value="<?php echo $movieDirectorAdd ?? ""; ?>" placeholder="Enter movie director">
              <?php echo $errors['movie_director_add'] ?? ""; ?>
            </div>

            <div class="form-group">
              <input type="text" name="movie_actors_add" class="form-control" value="<?php echo $movieActorsAdd ?? ""; ?>" placeholder="Enter movie actors">
              <?php echo $errors['movie_actors_add'] ?? ""; ?>
            </div>

            <div class="form-group">
              <input type="date" name="movie_date_add" value="<?php echo $movieDateAdd ?? ""; ?>" class="form-control">
              <?php echo $errors['movie_date_add'] ?? ""; ?>
            </div>

            <div class="form-group">
              <textarea class="form-control" rows="3" name="movie_description_add" placeholder="Enter movie description"><?php echo $movieDescriptionAdd ?? ""; ?></textarea>
              <?php echo $errors['movie_description_add'] ?? ""; ?>
            </div>

            <div class="text-center">
              <button type="submit" name="add_movie" class="btn btn-outline-primary">ADD</button>
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">CANCEL</button>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ADD MOVIE -->

<?php include 'includes/footer.php'; ?>