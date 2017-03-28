<?php
/**
 * Created by PhpStorm.
 * User: Michael Blackley
 * Date: 10/6/2016
 * Time: 11:21 AM
 */
require_once('database.php');
try{
    $departmentName = filter_input(INPUT_POST,'DepName');
    $stmt = $conn->prepare("INSERT INTO department (departmentName) VALUES (:DepName)");
    $stmt->bindParam(':DepName', $departmentName);
    $stmt->execute();
    $result= "value inserted succecsfully!";
}catch(PDOException $e)
{
    $result= "Error: " . $e->getMessage();
}

header('Location: department_list.php');
?>
<html>
<head>

    <form></form>
    <title>Adding New Category</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<h1><?php echo $result ?></h1>
</body>
</html>
