<?php

require_once 'Database.php'; // Pozivanje fajla gde je Database

class Rating {

  public static function add($userID, $movieID, $rating) {
    $query = "DELETE FROM rating WHERE user_id = $userID AND movie_id = $movieID";
    $result = mysqli_query(Database::getInstance()->getConnection(), $query) or die(mysqli_error(Database::getInstance()->getConnection()));

    $query = "INSERT INTO rating (user_id, movie_id, rating) VALUES ('$userID', '$movieID', '$rating')";
    $result = mysqli_query(Database::getInstance()->getConnection(), $query) or die(mysqli_error(Database::getInstance()->getConnection()));

    if ($result) { // Ukoliko je query uspesan pravimo sesiju i vracamo true
      return true;
    }

    return false;
  }

  public static function getAll() {
    $query = "SELECT * FROM movie";
    $result = mysqli_query(Database::getInstance()->getConnection(), $query);
    $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $movies;
  }

  public static function get($userID, $movieID){
    $query = "SELECT rating FROM rating WHERE user_id = $userID AND movie_id = $movieID";
    $result = mysqli_query(Database::getInstance()->getConnection(), $query);
    $rating = mysqli_fetch_array($result);

    if($rating){
      $rating = $rating['rating'];
    }

    return $rating;
  }

}
