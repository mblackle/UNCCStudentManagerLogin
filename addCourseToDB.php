<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 11/8/2016
 * Time: 3:58 PM
 */
require_once('database.php');
$departmentName = filter_input(INPUT_POST,'DepName');

$nameOne = filter_input(INPUT_POST, 'names');
$crsCode = filter_input(INPUT_POST,'crsCode');
$crsTitle = filter_input(INPUT_POST,'crsTitle');
$crsCredits = filter_input(INPUT_POST,'crsCredits');
$crsDescription = filter_input(INPUT_POST,'crsDescription');
$ID = filter_input(INPUT_POST, 'theID');
$courseID = filter_input(INPUT_POST, 'courseID');

$queryCategory = 'SELECT * FROM department WHERE departmentName = :nameOne';
$statement1 = $conn->prepare($queryCategory);
$statement1->bindValue(':nameOne', $nameOne);
$statement1->execute();
$department = $statement1->fetch();
$departmentIdentity = $department['departmentID'];
$statement1->closeCursor();

echo $nameOne;
echo $departmentIdentity;

$stmt = $conn->prepare("INSERT INTO course (crs_code, crs_title, crs_credits, dep_id, crs_description) VALUES (:crsCode, :crsTitle, :crsCredits, :departmentIdentity, :crsDescription) ");
$stmt->bindParam(':crsCode', $crsCode);
$stmt->bindParam(':crsTitle', $crsTitle);
$stmt->bindParam(':crsCredits', $crsCredits);
$stmt->bindParam(':departmentIdentity', $departmentIdentity);
$stmt->bindParam(':crsDescription', $crsDescription);
$stmt->execute();




header('Location: manager_home.php');


?>