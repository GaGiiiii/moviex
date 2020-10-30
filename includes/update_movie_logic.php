<?php 

if (isset($_POST['update_movie'])) {
  $movieTitleUpdate = clean($_POST['movie_title_update']);
  $movieImgUpdate = clean($_POST['movie_img_update']);
  $movieGenreUpdate = clean($_POST['movie_genre_update']);
  $moviePriceUpdate = $_POST['movie_price_update'];
  $movieLengthUpdate = $_POST['movie_length_update'];
  $movieTrailerUpdate = clean($_POST['movie_trailer_update']);
  $movieDirectorUpdate = clean($_POST['movie_director_update']);
  $movieActorsUpdate = clean($_POST['movie_actors_update']);
  $movieDateUpdate = clean($_POST['movie_date_update']);
  $movieDescriptionUpdate = clean($_POST['movie_description_update']);

  $errors = array();
  $fail = false;

  if (empty($movieTitleUpdate)) {
    $errors['movie_title_update'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please enter title.</label></p>';
    $fail = true;
  }

  if (empty($movieImgUpdate)) {
    $errors['movie_img_update'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter image URL.</label></p>';
    $fail = true;
  }

  if (empty($movieGenreUpdate)) {
    $errors['movie_genre_update'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter genre.</label></p>';
    $fail = true;
  }

  if (empty($moviePriceUpdate)) {
    $errors['movie_price_update'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter price.</label></p>';
    $fail = true;
  }

  if (empty($movieLengthUpdate)) {
    $errors['movie_length_update'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter length.</label></p>';
    $fail = true;
  }

  if (empty($movieTrailerUpdate)) {
    $errors['movie_trailer_update'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter trailer.</label></p>';
    $fail = true;
  }

  if (empty($movieDirectorUpdate)) {
    $errors['movie_director_update'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter director.</label></p>';
    $fail = true;
  }

  if (empty($movieActorsUpdate)) {
    $errors['movie_actors_update'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter actors.</label></p>';
    $fail = true;
  }

  if (empty($movieDateUpdate)) {
    $errors['movie_date_update'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please select publish date.</label></p>';
    $fail = true;
  }

  if (empty($movieDescriptionUpdate)) {
    $errors['movie_description_update'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter description.</label></p>';
    $fail = true;
  }

  if ($fail) {
    $_SESSION['movie_update_fail'] = "Error while updating movie";
  }

  if (count($errors) == 0) {
    $data = array(
      "movie_title_update" => $movieTitleUpdate,
      "movie_img_update" => $movieImgUpdate,
      "movie_genre_update" => $movieGenreUpdate,
      "movie_price_update" => $moviePriceUpdate,
      "movie_length_update" => $movieLengthUpdate,
      "movie_trailer_update" => $movieTrailerUpdate,
      "movie_director_update" => $movieDirectorUpdate,
      "movie_actors_update" => $movieActorsUpdate,
      "movie_date_update" => $movieDateUpdate,
      "movie_description_update" => $movieDescriptionUpdate,
    );

    if (Movie::update($_POST['movie_id_update'], $data)) {
      $_SESSION['movie_update_success'] = "Movie updateed Successfully";
      header("Location: admin");

      exit;
    }
  } // COUNT errors CLOSE
} // POST REQ CLOSE