<?php

include 'includes/functions.php';
include 'classes/Movie.php';
include 'classes/User.php';

$movies = Movie::getAll();
shuffle($movies);

if(User::isLoggedIn() && !$_SESSION['user']['is_admin']){
  header("Location: index");
}


if(isset($_POST['add_movie'])){  
  $movieTitleAdd = clean($_POST['movie_title_add']);
  $movieImgAdd = clean($_POST['movie_img_add']);
  $movieGenreAdd = clean($_POST['movie_genre_add']);
  $moviePriceAdd = $_POST['movie_price_add'];
  $movieLengthAdd = $_POST['movie_length_add'];
  $movieTrailerAdd = clean($_POST['movie_trailer_add']);
  $movieDirectorAdd = clean($_POST['movie_director_add']);
  $movieActorsAdd = clean($_POST['movie_actors_add']);
  $movieDescriptionAdd = clean($_POST['movie_description_add']);

  $errors = array();
  $fail = false;

  if(empty($movieTitleAdd)){
    $errors['movie_title_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please enter title.</label></p>';
    $fail = true;
  }

  if(empty($movieImgAdd)){
    $errors['movie_img_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter image URL.</label></p>';
    $fail = true;
  }

  if(empty($movieGenreAdd)){
    $errors['movie_genre_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter genre.</label></p>';
    $fail = true;
  }

  if(empty($moviePriceAdd)){
    $errors['movie_price_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter price.</label></p>';
    $fail = true;
  }

  if(empty($movieLengthAdd)){
    $errors['movie_length_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter length.</label></p>';
    $fail = true;
  }

  if(empty($movieTrailerAdd)){
    $errors['movie_trailer_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter trailer.</label></p>';
    $fail = true;
  }

  if(empty($movieDirectorAdd)){
    $errors['movie_director_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter director.</label></p>';
    $fail = true;
  }

  if(empty($movieActorsAdd)){
    $errors['movie_actors_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter actors.</label></p>';
    $fail = true;
  }

  if(empty($movieDescriptionAdd)){
    $errors['movie_description_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter description.</label></p>';
    $fail = true;
  }

  if($fail){
    $_SESSION['movie_add_fail'] = "Error while adding movie";
  }

  if(count($errors) == 0){
    $data = array(
      "movie_title_add" => $movieTitleAdd,
      "movie_img_add" => $movieImgAdd,
      "movie_genre_add" => $movieGenreAdd,
      "movie_price_add" => $moviePriceAdd,
      "movie_length_add" => $movieLengthAdd,
      "movie_trailer_add" => $movieTrailerAdd,
      "movie_director_add" => $movieDirectorAdd,
      "movie_actors_add" => $movieActorsAdd,
      "movie_description_add" => $movieDescriptionAdd,
    );

    if(Movie::add($data)){
      $_SESSION['movie_add_success'] = "Movie added Successfully";
      header("Location: admin");

      exit;
    }

  } // COUNT errors CLOSE
} // POST REQ CLOSE
?>

<?php include 'includes/header.php'; ?>

<?php printFlashMessage("movie_add_success"); ?>
<?php if(isset($fail) && $fail) printFlashMessageFail("movie_add_fail"); ?>

<div class="container-fluid mt-5">
        <div class="row">

        <?php foreach($movies as $key => $movie): ?>
            
            <div class="col-md-4 col-sm-6">
              <div class="card-admin" data-index="<?php echo $key; ?>">
                <a href="#" class="hhover-link" data-target="#updMo<?php echo $movie['id']; ?>" data-toggle="modal">
                    <div class="invisible-custom invis ">
                        <h1>UPDATE</h1>
                    </div>
                    <img src="<?php echo $movie['img'] ?? ""; ?>" alt="Banner1">
                    <h1><?php echo $movie['title']; ?></h1>
                </a>
              </div> 
            </div>
            
            <div class="modal modal-update-color" id="updMo<?php echo $movie['id']; ?>">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ažuriraj "<?php echo $movie['title']; ?>"</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="poruci-form">
                                <fieldset>
                                <div class="form-group">
                                    <input type="text" name="movie_title_add" class="form-control" value="<?php echo $movie['title'] ?? ""; ?>" placeholder="Enter movie title">
                                    <?php echo $errors['movie_title_add'] ?? ""; ?>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="movie_img_add" class="form-control" value="<?php echo $movie['img'] ?? ""; ?>" placeholder="Enter img URL">
                                    <?php echo $errors['movie_img_add'] ?? ""; ?>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="movie_genre_add" class="form-control" value="<?php echo $movie['genre'] ?? ""; ?>" placeholder="Enter movie genre">
                                    <?php echo $errors['movie_genre_add'] ?? ""; ?>
                                </div>

                                <div class="form-group">
                                    <input type="number" name="movie_price_add" class="form-control" value="<?php echo $movie['price'] ?? ""; ?>" placeholder="Enter movie price">
                                    <?php echo $errors['movie_price_add'] ?? ""; ?>
                                </div>

                                <div class="form-group">
                                    <input type="number" name="movie_length_add" class="form-control" value="<?php echo $movie['length'] ?? ""; ?>" placeholder="Enter movie length">
                                    <?php echo $errors['movie_length_add'] ?? ""; ?>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="movie_trailer_add" class="form-control" value="<?php echo $movie['trailer'] ?? ""; ?>" placeholder="Enter trailer URL">
                                    <?php echo $errors['movie_trailer_add'] ?? ""; ?>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="movie_director_add" class="form-control" value="<?php echo $movie['director'] ?? ""; ?>" placeholder="Enter movie director">
                                    <?php echo $errors['movie_director_add'] ?? ""; ?>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="movie_actors_add" class="form-control" value="<?php echo $movie['actors'] ?? ""; ?>" placeholder="Enter movie actors">
                                    <?php echo $errors['movie_actors_add'] ?? ""; ?>
                                </div>
                            

                                <div class="form-group">
                                    <textarea class="form-control" rows="3" name="movie_description_add" placeholder="Enter movie description"><?php echo $movie['description'] ?? ""; ?></textarea>
                                    <?php echo $errors['movie_description_add'] ?? ""; ?>
                                </div>

                                    <div class="text-center">
                                        <input type="hidden" name="filmID" value="<?php echo $movie['id']; ?>">
                                        <button type="submit" name="izmeni_film" class="azuriraj-btn-modal btn btn-outline-primary">UPDATE</button>
                                        <button type="submit" name="izbrisi_film" class="azuriraj-btn-modal btn btn-outline-danger">DELETE</button>
                                        <button type="button" class="azuriraj-btn-modal btn btn-outline-secondary" data-dismiss="modal">CANCEL</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
   

        </div>
    </div>

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

  <?php include 'includes/footer.php'; ?>
