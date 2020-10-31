<?php

require_once 'Database.php'; // Pozivanje fajla gde je Database

class Movie {

  public static function add($data) {
    try {
      $data = (object) $data;
      $query = Database::getInstance()->getConnection()->prepare("INSERT INTO movie (title, img, genre, price, length, trailer, director, actors, publish_date, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $result = $query->execute([
        $data->movie_title_update,
        $data->movie_genre_update,
        $data->movie_price_update,
        $data->movie_director_update,
        $data->movie_length_update,
        $data->movie_img_update,
        $data->movie_trailer_update,
        $data->movie_description_update,
        $data->movie_date_update,
      ]);

      return $result;
    } catch (PDOException $e) {
      echo "<p class='alert mb-0 alert-danger'>PDO EXCEPTION: " . $e->getMessage() . "</p>";

      return false;
    }
  }

  public static function getAll() {
    try {
      $query = Database::getInstance()->getConnection()->prepare("SELECT * FROM movie");
      $query->execute();
      $movies = $query->fetchAll();

      return $movies;
    } catch (PDOException $e) {
      echo "<p class='alert mb-0 alert-danger'>PDO EXCEPTION: " . $e->getMessage() . "</p>";

      return [];
    }
  }

  public static function sortByDate() {
    try {
      $query = Database::getInstance()->getConnection()->prepare("SELECT * FROM movie ORDER BY publish_date DESC");
      $query->execute();
      $movies = $query->fetchAll();

      return $movies;
    } catch (PDOException $e) {
      echo "<p class='alert mb-0 alert-danger'>PDO EXCEPTION: " . $e->getMessage() . "</p>";

      return [];
    }
  }

  public static function sortByRating() {
    try {
      $query = Database::getInstance()->getConnection()->prepare("SELECT m.*, AVG(r.rating) AS rating FROM movie m
      JOIN rating r ON m.id = r.movie_id
      GROUP BY r.movie_id
      ORDER BY rating DESC");
      $query->execute();
      $movies = $query->fetchAll();

      return $movies;
    } catch (PDOException $e) {
      echo "<p class='alert mb-0 alert-danger'>PDO EXCEPTION: " . $e->getMessage() . "</p>";

      return [];
    }
  }

  public static function update($movieID, $data) {
    try {
      $data = (object) $data;
      $query = Database::getInstance()->getConnection()->prepare("UPDATE movie SET title = :title, genre = :genre, price = :price, director = :director, actors = :actors, length = :length, img = :img, trailer = :trailer, description = :description, publish_date = :date WHERE id = :id LIMIT 1");

      $result = $query->execute(array(
        ':title' => $data->movie_title_update,
        ':genre' => $data->movie_genre_update,
        ':price' => $data->movie_price_update,
        ':director' => $data->movie_director_update,
        ':length' => $data->movie_length_update,
        ':img' => $data->movie_img_update,
        ':trailer' => $data->movie_trailer_update,
        ':description' => $data->movie_description_update,
        ':date' => $data->movie_date_update,
        ':id' => $movieID,
      ));

      return $result;
    } catch (PDOException $e) {
      echo "<p class='alert mb-0 alert-danger'>PDO EXCEPTION: " . $e->getMessage() . "</p>";

      return false;
    }
  }

  public static function delete($movieID) {
    try {
      $query = Database::getInstance()->getConnection()->prepare("DELETE FROM movie WHERE id = :id LIMIT 1");
      $result = $query->execute(array(':id' => $movieID));

      return $result;
    } catch (PDOException $e) {
      echo "<p class='alert mb-0 alert-danger'>PDO EXCEPTION: " . $e->getMessage() . "</p>";

      return false;
    }
  }

  public static function sort($sortType) {
    try {
      $query = Database::getInstance()->getConnection()->prepare("SELECT * FROM movie ORDER BY $sortType DESC");
      $query->execute();
      $movies = $query->fetchAll();

      return $movies;
    } catch (PDOException $e) {
      echo "<p class='alert mb-0 alert-danger'>PDO EXCEPTION: " . $e->getMessage() . "</p>";

      return [];
    }
  }

  public static function search($searchText) {
    try {
      $query = Database::getInstance()->getConnection()->prepare("SELECT * FROM movie WHERE title LIKE '%" . $searchText . "%'");
      $query->execute();
      $movies = $query->fetchAll();

      return $movies;
    } catch (PDOException $e) {
      echo "<p class='alert mb-0 alert-danger'>PDO EXCEPTION: " . $e->getMessage() . "</p>";

      return [];
    }
  }

  public static function getRating($movieID) {
    try {
      $query = Database::getInstance()->getConnection()->prepare("SELECT rating FROM rating WHERE movie_id = :movieID");
      $query->execute(array(
        ':movieID' => $movieID,
      ));
      $ratings = $query->fetchAll();

      $ratingR = 0.0;

      foreach ($ratings as $rating) {
        $ratingR += $rating['rating'];
      }

      return sizeof($ratings) == 0 ? 0.0 : round($ratingR / sizeof($ratings), 2);
    } catch (PDOException $e) {
      echo "<p class='alert mb-0 alert-danger'>PDO EXCEPTION: " . $e->getMessage() . "</p>";

      return 0.0;
    }
  }
}
