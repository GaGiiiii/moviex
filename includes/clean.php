<?php 

  require_once 'classes/Database.php';

  function clean($input){
    $input = mysqli_real_escape_string(Database::getInstance()->getConnection(), $input);
    $input = trim($input);
    $input = str_replace('"', "", $input);
    $input = str_replace("'", "", $input);
    $input = htmlspecialchars($input); // Mora ispod str_replace jer htmlspecialchars pretvara " u &nesto; i onda ga str_replace ne nadje

    return $input;
  }