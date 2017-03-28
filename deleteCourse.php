<?php
/**
 * Carrie Mao
 * Michael Blackley
 * Group9_HW04
 * Homework 4
 */
require_once('database.php');

$deleteCourse = filter_input(INPUT_POST,'deleteCourse');

$sql = "DELETE FROM course WHERE crs_code='$deleteCourse'";
$stmt = $conn->prepare($sql);
$stmt->execute();



header('Location: manager_home.php');

?>