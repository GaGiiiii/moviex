<?php

require_once 'classes/Movie.php';
require_once 'classes/User.php';
require_once 'classes/Rating.php';

if (isset($_POST['sortType'])) {
  $movies = Movie::sort($_POST['sortType']);

  $response = "";

  foreach ($movies as $movie) :

    $response .= '<div class="col-md-4">
    <div class="item text-center border p-3">';

    $response .= '<img src="' . $movie['img'] . '" alt="Banner1" data-toggle="modal" data-target="#movie-modal' . $movie['id'] . '">';
    $response .= '<h3 class="text-center movie-title mt-3">' . $movie['title'] . '</h3>';

    $rating = Movie::getRating($movie['id']);

    if (!User::isLoggedIn()) {
      $whole = floor($rating);      // 1
      $fraction = $rating - $whole; // .25
      $used = false;

      for ($i = 0; $i < $whole; $i++) :
        $response .= '<i class="fas fa-star"></i>';
      endfor;
      for ($i = 0; $i < 5 - $whole; $i++) :
        if ($fraction < 0.75 && !$used && $fraction != 0) {
          $response .= '<i class="fas fa-star-half-alt"></i>';
          $used = true;
        } else {
          $response .= '<i class="far fa-star"></i>';
        }
      endfor;
      $response .= '<span class="user-rating" data-movie-id="' . $movie['id'] . '">';
      if (isset($rating)) $response .= "($rating)";
      $response .= "</span>";

    } else {
      $rating2 = Rating::get($_SESSION['user']['id'], $movie['id']);

      $response .= 'AVG. Rating: <i class="fas fa-star"></i>  <span class="movie-rating" data-movie-id="' . $movie['id'] . '">(' . Movie::getRating($movie['id']) . ')</span>';
      $response .= '<br>
        Your Rating: <br>';

      for ($i = 0; $i < $rating2; $i++) :

        $response .= '<i class="star fas fa-star star-icon-hover text-warning voted" data-user-id="' . $_SESSION['user']['id'] . '"';
        $response .= ' data-movie-id="' . $movie['id'] . '"';
        $response .= ' data-rating="' . ($i + 1) . '"' . '></i>';

      endfor;
      for ($i = $rating2; $i < 5; $i++) :
        $response .= '<i class="star fas fa-star star-icon-hover" data-user-id="' . $_SESSION['user']['id'] . '" data-movie-id="' . $movie['id'] . '" data-rating="' . ($i + 1) . '"></i>';
      endfor;
    }
    $response .= '
      <span class="user-rating" data-movie-id="' . $movie['id'] . '">';
    if (isset($rating2)) $response .= "($rating2)";
    $response .= "</span>
      
    </div>
  </div>";

  endforeach;

  echo $response;
}
