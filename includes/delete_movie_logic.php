<?php

if (isset($_POST['delete_movie'])) {
  if (Movie::delete($_POST['movie_id_update'])) {
    $_SESSION['movie_delete_success'] = "Movie \"" . $_POST['movie_title_update'] . "\" deleted Successfully";
    header('Location: admin');

    exit;
  }
}
