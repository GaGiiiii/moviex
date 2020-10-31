<?php

require_once 'Database.php'; // Pozivanje fajla gde je Database

class User {

  public static function register($data) {
    try {
      $data = (object) $data;
      $data->password = md5(md5($data->password)); // Hashovanje sifre sa md5
      $query = Database::getInstance()->getConnection()->prepare("INSERT INTO user (email, password, username) VALUES (?, ?, ?)");
      $result = $query->execute([
        $data->email,
        $data->password,
        $data->username,
      ]);

      $data->id = Database::getInstance()->getConnection()->lastInsertId();

      if ($result) { // Ukoliko je query uspesan pravimo sesiju i vracamo true
        self::createSession($data);

        return true;
      }

      return false;
    } catch (PDOException $e) {
      echo "<p class='alert mb-0 alert-danger'>PDO EXCEPTION: " . $e->getMessage() . "</p>";

      return false;
    }
  }

  public static function takenEmail($email) {
    try {
      $query = Database::getInstance()->getConnection()->prepare("SELECT email FROM user WHERE email = :email");
      $query->execute(array(
        ':email' => $email,
      ));

      $user = $query->fetch();

      if ($user) {
        return true;
      }

      return false;
    } catch (PDOException $e) {
      echo "<p class='alert mb-0 alert-danger'>PDO EXCEPTION: " . $e->getMessage() . "</p>";

      return false;
    }
  }

  public static function takenUsername($username) {
    try {
      $query = Database::getInstance()->getConnection()->prepare("SELECT username FROM user WHERE username = :username");
      $query->execute(array(
        ':username' => $username,
      ));

      $user = $query->fetch();

      if ($user) {
        return true;
      }

      return false;
    } catch (PDOException $e) {
      echo "<p class='alert mb-0 alert-danger'>PDO EXCEPTION: " . $e->getMessage() . "</p>";

      return false;
    }
  }

  public static function login($data) {
    try {
      $data = (object) $data;
      $data->password = md5(md5($data->password));
      $query = Database::getInstance()->getConnection()->prepare("SELECT id, email, username, is_admin FROM user WHERE username = :username AND password = :password");
      $query->execute(array(
        ':username' => $data->username,
        ':password' => $data->password,
      ));

      $user = $query->fetch();

      if ($user) {
        $user = (object) $user;
        self::createSession($user);

        return true;
      }

      return false;
    } catch (PDOException $e) {
      echo "<p class='alert mb-0 alert-danger'>PDO EXCEPTION: " . $e->getMessage() . "</p>";

      return false;
    }
  }

  public static function createSession($user) {
    $_SESSION['user'] = [
      'id' => $user->id,
      'email' => $user->email,
      'username' => $user->username,
      'is_admin' => $user->is_admin,
    ];
  }

  public static function logout() {
    // Gasimo i unistavamo sesiju nakon logout
    //   session_unset();
    //   session_destroy();
    unset($_SESSION['user']);
  }

  public static function isLoggedIn() {
    // Ako je sesija aktivna znaci da je korisnik ulogovan i dalje.
    if (isset($_SESSION['user'])) {
      return true;
    }

    return false;
  }
}

// try{
  
// }catch (PDOException $e){
//   echo "<p class='alert mb-0 alert-danger'>PDO EXCEPTION: " . $e->getMessage() . "</p>";
// }
