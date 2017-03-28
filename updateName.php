<?php
/**
 * Michael Blackley
 * Group9_HW04
 * Homework 4
 * Purpose: The purpose of this file is to update the database depending on where the departmentID equals the nameID
 */
require_once('database.php');

$nameID = $_POST['ID'];
$updateName = $_POST['UpdateDep'];

$sql = "UPDATE department SET departmentName='$updateName' WHERE departmentID = $nameID";
$stmt = $conn->prepare($sql);
$stmt->execute();
header('Location: department_list.php');
?>