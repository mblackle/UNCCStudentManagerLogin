<?php
/**
 * Michael Blackley
 * Group9_HW05
 * Homework 5
 * Purpose: The purpose of this file is to end the session after the user has decided to logout, and then direct the user back to the index page.
 */

session_start();
setcookie('userName', '', time()-10, '/htdocs/CarrieHW5/student_home.php');
session_destroy();
session_unset();
header("Location: index.php")
?>