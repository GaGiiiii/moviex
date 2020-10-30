<?php

require_once 'classes/Rating.php';
require_once 'classes/Movie.php';

if(isset($_POST['movieID']) && isset($_POST['userID'])){
  Rating::add($_POST['userID'], $_POST['movieID'], $_POST['rating']);
  echo Movie::getRating($_POST['movieID']);
}