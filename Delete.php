<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 10/6/2016
 * Time: 12:13 PM
 */
require_once('database.php');

$deleteIndex = filter_input(INPUT_POST,'delete');

$sql = "DELETE FROM department WHERE departmentID='$deleteIndex'";
$stmt = $conn->prepare($sql);
$stmt->execute();



header('Location: manager_home.php');
?>

