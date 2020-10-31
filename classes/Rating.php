<?php

require_once 'Database.php'; // Pozivanje fajla gde je Database

class Rating {

  public static function add($userID, $movieID, $rating) {
    try {
      $query = Database::getInstance()->getConnection()->prepare("DELETE FROM rating WHERE user_id = :userID AND movie_id = :movieID");
      $result = $query->execute(array(':userID' => $userID, ':movieID' => $movieID));

      $query = Database::getInstance()->getConnection()->prepare("INSERT INTO rating (user_id, movie_id, rating) VALUES (?, ?, ?)");
      $result = $query->execute([
        $userID,
        $movieID,
        $rating
      ]);

      return $result;
    } catch (PDOException $e) {
      echo "<p class='alert mb-0 alert-danger'>PDO EXCEPTION: " . $e->getMessage() . "</p>";

      return false;
    }
  }

  public static function get($userID, $movieID) {
    try {
      $query = Database::getInstance()->getConnection()->prepare("SELECT rating FROM rating WHERE user_id = :userID AND movie_id = :movieID");
      $query->execute(array(
        'userID' => $userID,
        ':movieID' => $movieID,
      ));
      $rating = $query->fetch();      

      if ($rating) {
        $rating = $rating['rating'];

        return $rating;
      }

      return 0;
    } catch (PDOException $e) {
      echo "<p class='alert mb-0 alert-danger'>PDO EXCEPTION: " . $e->getMessage() . "</p>";

      return 0;
    }
  }
}
