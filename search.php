<?php

  require_once 'classes/Movie.php';

  if(isset($_POST['searchText'])){
    $movies = Movie::search($_POST['searchText']);

    echo json_encode($movies);
  }