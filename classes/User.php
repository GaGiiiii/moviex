<?php 

  require_once 'Database.php'; // Pozivanje fajla gde je Database

  class User{

      public static function register($data){
          $data = (object) $data;
          $data->password = md5(md5($data->password)); // Hashovanje sifre sa md5
          $query = "INSERT INTO user (email, password, username) VALUES ('$data->email', '$data->password', '$data->username')";
          $result = mysqli_query(Database::getInstance()->getConnection(), $query) or die(mysqli_error(Database::getInstance()->getConnection()));

          
          if($result){ // Ukoliko je query uspesan pravimo sesiju i vracamo true
              self::createSession(mysqli_insert_id(Database::getInstance()->getConnection()), $data->email, $data->password);

              return true;
          }

          return false;
      }

      public static function zauzetEmail($email){
          $query = "SELECT email FROM Korisnik WHERE email = '$email'";
          $result = mysqli_query(Database::getInstance()->getConnection(), $query);
          $korisnik = mysqli_fetch_array($result);

          if($korisnik){
              return true;
          }

          return false;
      }

      public static function zauzetoIme($ime){
          $query = "SELECT ime FROM Korisnik WHERE ime = '$ime'";
          $result = mysqli_query(Database::getInstance()->getConnection(), $query);
          $korisnik = mysqli_fetch_array($result);

          if($korisnik){
              return true;
          }

          return false;
      }

      public static function login($data){
          $data = (object) $data;
          $data->password = md5(md5($data->password));
          $query = "SELECT id, email, username FROM user WHERE username = '$data->username' AND password = '$data->password'";
          $result = mysqli_query(Database::getInstance()->getConnection(), $query);

          $user = mysqli_fetch_array($result);

          if($user){
              self::createSession($user['id'], $user['email'], $user['username']);

              return true;
          }

          return false;
      }

      public static function createSession($id, $email, $username){
          $_SESSION['user'] = [
              'id' => $id,
              'email' => $email,
              'username' => $username,
          ];
      }

      public static function logout(){
          // Gasimo i unistavamo sesiju nakon logout
          session_unset();
          session_destroy();
      }

      public static function isLoggedIn(){
          // Ako je sesija aktivna znaci da je korisnik ulogovan i dalje.
          if(isset($_SESSION['user'])){
              return true;
          }

          return false;
      }

  }