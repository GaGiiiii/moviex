<?php

require_once 'classes/User.php';

if(!User::isLoggedIn()){
    header("Location: index");
}

User::logout();
header("Location: index");