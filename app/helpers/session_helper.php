<?php
session_start();

// Flash message helper
function userIsLoggedIn(){
  if(isset($_SESSION['username'])){
    return true;
  } else {
    return false;
  }
}