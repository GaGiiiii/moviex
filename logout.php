<?php

require_once 'classes/User.php';

if(!User::isLoggedIn()){
    header("Location: index");
    exit;
}

User::logout();
$_SESSION['logout_success_message'] = "Logged out Successfully";
header("Location: index");
exit;
