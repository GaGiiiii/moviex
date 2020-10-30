<?php 

if (isset($_POST['add_movie'])) {
  $movieTitleAdd = clean($_POST['movie_title_add']);
  $movieImgAdd = clean($_POST['movie_img_add']);
  $movieGenreAdd = clean($_POST['movie_genre_add']);
  $moviePriceAdd = $_POST['movie_price_add'];
  $movieLengthAdd = $_POST['movie_length_add'];
  $movieTrailerAdd = clean($_POST['movie_trailer_add']);
  $movieDirectorAdd = clean($_POST['movie_director_add']);
  $movieActorsAdd = clean($_POST['movie_actors_add']);
  $movieDateAdd = clean($_POST['movie_date_add']);
  $movieDescriptionAdd = clean($_POST['movie_description_add']);

  $errors = array();
  $fail = false;

  if (empty($movieTitleAdd)) {
    $errors['movie_title_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please enter title.</label></p>';
    $fail = true;
  }

  if (empty($movieImgAdd)) {
    $errors['movie_img_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter image URL.</label></p>';
    $fail = true;
  }

  if (empty($movieGenreAdd)) {
    $errors['movie_genre_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter genre.</label></p>';
    $fail = true;
  }

  if (empty($moviePriceAdd)) {
    $errors['movie_price_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter price.</label></p>';
    $fail = true;
  }

  if (empty($movieLengthAdd)) {
    $errors['movie_length_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter length.</label></p>';
    $fail = true;
  }

  if (empty($movieTrailerAdd)) {
    $errors['movie_trailer_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter trailer.</label></p>';
    $fail = true;
  }

  if (empty($movieDirectorAdd)) {
    $errors['movie_director_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter director.</label></p>';
    $fail = true;
  }

  if (empty($movieActorsAdd)) {
    $errors['movie_actors_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter actors.</label></p>';
    $fail = true;
  }

  if (empty($movieDateAdd)) {
    $errors['movie_date_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please select publish date.</label></p>';
    $fail = true;
  }

  if (empty($movieDescriptionAdd)) {
    $errors['movie_description_add'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter description.</label></p>';
    $fail = true;
  }

  if ($fail) {
    $_SESSION['movie_add_fail'] = "Error while adding movie";
  }

  if (count($errors) == 0) {
    $data = array(
      "movie_title_add" => $movieTitleAdd,
      "movie_img_add" => $movieImgAdd,
      "movie_genre_add" => $movieGenreAdd,
      "movie_price_add" => $moviePriceAdd,
      "movie_length_add" => $movieLengthAdd,
      "movie_trailer_add" => $movieTrailerAdd,
      "movie_director_add" => $movieDirectorAdd,
      "movie_actors_add" => $movieActorsAdd,
      "movie_date_add" => $movieDateAdd,
      "movie_description_add" => $movieDescriptionAdd,
    );

    if (Movie::add($data)) {
      $_SESSION['movie_add_success'] = "Movie added Successfully";
      header("Location: admin");

      exit;
    }
  } // COUNT errors CLOSE
} // POST REQ CLOSE