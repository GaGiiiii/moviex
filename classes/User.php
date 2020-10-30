<?php 

  require_once 'Database.php'; // Pozivanje fajla gde je Database

  class User{

      public static function register($data){
          $data = (object) $data;
          $data->password = md5(md5($data->password)); // Hashovanje sifre sa md5
          $query = "INSERT INTO user (email, password, username) VALUES ('$data->email', '$data->password', '$data->username')";
          $result = mysqli_query(Database::getInstance()->getConnection(), $query) or die(mysqli_error(Database::getInstance()->getConnection()));

          $data->id = mysqli_insert_id(Database::getInstance()->getConnection());
          
          if($result){ // Ukoliko je query uspesan pravimo sesiju i vracamo true
              self::createSession($data);

              return true;
          }

          return false;
      }

      public static function takenEmail($email){
          $query = "SELECT email FROM user WHERE email = '$email'";
          $result = mysqli_query(Database::getInstance()->getConnection(), $query);
          $korisnik = mysqli_fetch_array($result);

          if($korisnik){
              return true;
          }

          return false;
      }

      public static function takenUsername($username){
          $query = "SELECT username FROM user WHERE username = '$username'";
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
          $query = "SELECT id, email, username, is_admin FROM user WHERE username = '$data->username' AND password = '$data->password'";
          $result = mysqli_query(Database::getInstance()->getConnection(), $query);

          $user = mysqli_fetch_array($result); // We can't cast here, because next if will always be true !!!!!!!!!!!!!!!!!!!

          if($user){
              $user = (object) $user;
              self::createSession($user);

              return true;
          }

          return false;
      }

      public static function createSession($user){
          $_SESSION['user'] = [
              'id' => $user->id,
              'email' => $user->email,
              'username' => $user->username,
              'is_admin' => $user->is_admin,
          ];
      }

      public static function logout(){
          // Gasimo i unistavamo sesiju nakon logout
        //   session_unset();
        //   session_destroy();
        unset($_SESSION['user']);
      }

      public static function isLoggedIn(){
          // Ako je sesija aktivna znaci da je korisnik ulogovan i dalje.
          if(isset($_SESSION['user'])){
              return true;
          }

          return false;
      }

  }