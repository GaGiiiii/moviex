<?php

require_once 'Database.php'; // Pozivanje fajla gde je Database

class Movie {

  public static function add($data) {
    $data = (object) $data;
    $query = "INSERT INTO movie (title, img, genre, price, length, trailer, director, actors, publish_date, description) VALUES ('$data->movie_title_add', '$data->movie_img_add', '$data->movie_genre_add', '$data->movie_price_add', '$data->movie_length_add', '$data->movie_trailer_add', '$data->movie_director_add', '$data->movie_actors_add', '$data->movie_date_add', '$data->movie_description_add')";
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

  public static function sortByDate() {
    $query = "SELECT * FROM movie ORDER BY publish_date DESC";
    $result = mysqli_query(Database::getInstance()->getConnection(), $query);
    $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $movies;
  }

  public static function sortByRating() {
    $query = "SELECT m.*, AVG(r.rating) AS rating FROM movie m
    JOIN rating r ON m.id = r.movie_id
    GROUP BY r.movie_id
    ORDER BY rating DESC";
    $result = mysqli_query(Database::getInstance()->getConnection(), $query);
    $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $movies;
  }

  public static function update($movieID, $data) {
    $data = (object) $data;
    $query = "UPDATE movie SET title = '$data->movie_title_update', genre = '$data->movie_genre_update', price = '$data->movie_price_update', director = '$data->movie_director_update', actors = '$data->movie_actors_update', length = '$data->movie_length_update', img = '$data->movie_img_update', trailer = '$data->movie_trailer_update', description = '$data->movie_description_update', publish_date = '$data->movie_date_update' WHERE id = $movieID LIMIT 1";
    $result = mysqli_query(Database::getInstance()->getConnection(), $query) or die(mysqli_error(Database::getInstance()->getConnection()));

    return $result;
  }

  public static function delete($movieID) {
    $query = "DELETE FROM movie WHERE id = $movieID LIMIT 1";
    $result = mysqli_query(Database::getInstance()->getConnection(), $query);

    return $result;
  }

  public static function sort($sortType){
    $query = "SELECT * FROM movie ORDER BY $sortType DESC";
    $result = mysqli_query(Database::getInstance()->getConnection(), $query);
    $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $movies;
  }

  public static function search($searchText){
    $query = "SELECT * FROM movie WHERE title LIKE '%" . $searchText . "%'";
    $result = mysqli_query(Database::getInstance()->getConnection(), $query);
    $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $movies;
  }

  public static function getRating($movieID){
    $query = "SELECT rating FROM rating WHERE movie_id = $movieID";
    $result = mysqli_query(Database::getInstance()->getConnection(), $query);
    $ratings = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $ratingR = 0.0;

    foreach($ratings as $rating){
      $ratingR += $rating['rating'];
    }

    return sizeof($ratings) == 0 ? 0.0 : $ratingR / sizeof($ratings);
  }
}
