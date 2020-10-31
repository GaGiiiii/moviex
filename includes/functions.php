<?php 

  require_once 'classes/Database.php';

  function clean($input){
    // $input = mysqli_real_escape_string(Database::getInstance()->getConnection(), $input);
    $input = trim($input);
    $input = str_replace('"', "", $input);
    $input = str_replace("'", "", $input);
    $input = htmlspecialchars($input); // Mora ispod str_replace jer htmlspecialchars pretvara " u &nesto; i onda ga str_replace ne nadje

    return $input;
  }

  function printFlashMessage($sessionName){
    if(isset($_SESSION[$sessionName])){
      echo "<div class='container-fluid text-uppercase success-message-custom'>
              <div class='row'>
                  <div class='col-md-10 col-sm-10 offset-sm-1 offset-md-1 p-0 mt-5'>
                      <div class='alert alert-dismissible alert-success'>
                          <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          <strong>" . $_SESSION[$sessionName] . " <i class='fas fa-check'></i></strong>
                      </div>
                  </div>
              </div>
            </div>";
        unset($_SESSION[$sessionName]);
    }
  }

  function printFlashMessageFail($sessionName){
    if(isset($_SESSION[$sessionName])){
      echo "<div class='container text-uppercase success-message-custom'>
              <div class='row'>
                  <div class='col-md-12 col-sm-12 p-0 mt-5'>
                      <div class='alert alert-dismissible alert-danger'>
                          <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          <strong>" . $_SESSION[$sessionName] . " <i class='fas fa-times'></i></strong>
                      </div>
                  </div>
              </div>
            </div>";
        unset($_SESSION[$sessionName]);
    }
  }