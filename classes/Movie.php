<?php 

  require_once 'Database.php'; // Pozivanje fajla gde je Database

  class Movie{

      public static function add($data){
          $data = (object) $data;
          $query = "INSERT INTO movie (title, img, genre, price, length, trailer, director, actors, description) VALUES ('$data->movie_title_add', '$data->movie_img_add', '$data->movie_genre_add', '$data->movie_price_add', '$data->movie_length_add', '$data->movie_trailer_add', '$data->movie_director_add', '$data->movie_actors_add', '$data->movie_description_add')";
          $result = mysqli_query(Database::getInstance()->getConnection(), $query) or die(mysqli_error(Database::getInstance()->getConnection()));
          
          if($result){ // Ukoliko je query uspesan pravimo sesiju i vracamo true
              return true;
          }

          return false;
      }

        public static function getAll(){
            $query = "SELECT * FROM movie";
            $result = mysqli_query(Database::getInstance()->getConnection(), $query);
            $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            return $movies;
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

          $user = (object) mysqli_fetch_array($result);

          if($user){
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