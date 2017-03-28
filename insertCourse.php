<?php
/**
 * Carrie Mao
 * Michael Blackley
 * Group9_HW04
 * Homework 4
 */
require_once('database.php');
$departmentName = filter_input(INPUT_POST,'DepName');

$name = filter_input(INPUT_POST,'names');
$crsCode = filter_input(INPUT_POST,'crsCode');
$crsTitle = filter_input(INPUT_POST,'crsTitle');
$crsCredits = filter_input(INPUT_POST,'crsCredits');
$crsDescription = filter_input(INPUT_POST,'crsDescription');
$ID = filter_input(INPUT_POST, 'theID');
$courseID = filter_input(INPUT_POST, 'courseID');

$stmt = $conn->prepare("UPDATE course SET crs_code = :crsCode, crs_title = :crsTitle, crs_credits = :crsCredits, dep_id = :ID, crs_description = :crsDescription WHERE crs_ID = :courseID");
$stmt->bindParam(':crsCode', $crsCode);
$stmt->bindParam(':crsTitle', $crsTitle);
$stmt->bindParam(':crsCredits', $crsCredits);
$stmt->bindParam(':ID', $ID);
$stmt->bindParam(':crsDescription', $crsDescription);
$stmt->bindParam(':courseID', $courseID);
$stmt->execute();


header('Location: manager_home.php');

?>