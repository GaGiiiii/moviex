<?php 

  if(isset($_SESSION['register_success_message'])){
      echo $_SESSION['register_success_message'];
      unset($_SESSION['register_success_message']);
  }

  if(isset($_SESSION['login_success_message'])){
    echo $_SESSION['login_success_message'];
    unset($_SESSION['login_success_message']);
  }
  
?>