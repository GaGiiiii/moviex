<?php

  require_once 'classes/Movie.php';

  if(isset($_POST['sortType'])){
    $movies = Movie::sort($_POST['sortType']);

    echo json_encode($movies);
  }