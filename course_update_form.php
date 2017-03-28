<?php
/**
 * Carrie Mao
 * Michael Blackley
 * Group9_HW04
 * Homework 4
 */

require_once('database.php');

$update = $_POST['updateCourse'];

$departmentID = filter_input(INPUT_GET, 'departmentID', FILTER_VALIDATE_INT);
if ($departmentID == NULL || $departmentID == FALSE) {
    $departmentID = 1;
}

// Get name for selected department
$queryCategory = 'SELECT * FROM department WHERE departmentID = :departmentID';
$statement1 = $conn->prepare($queryCategory);
$statement1->bindValue(':departmentID', $departmentID);
$statement1->execute();
$department = $statement1->fetch();
$departmentName = $department['departmentName'];
$statement1->closeCursor();

// Get all departments
$queryAllDepartments = 'SELECT * FROM department ORDER BY departmentID';
$statement2 = $conn->prepare($queryAllDepartments);
$statement2->execute();
$departments = $statement2->fetchAll();
$statement2->closeCursor();

$sql = "SELECT crs_ID, crs_code, crs_title, crs_credits, crs_description FROM course WHERE crs_code = $update";
$result = $conn->query($sql);
while($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $placeHolder = $row["crs_code"];
    $placeHolder1 = $row["crs_title"];
    $placeHolder2 = $row["crs_credits"];
    $placeHolder3 = $row["crs_description"];
    $placeHolder4 = $row["crs_ID"];
}

?>








<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>University Course Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<main>
    <h1 style="color:black; border-bottom: 5px solid black">University Course Manager</h1>
    <h2>Update Course</h2>
    <aside>
        <!-- display a list of categories -->

        <nav>
            <section>
                <!-- display a table of products -->
                <form action="insertCourse.php" method="post">
                    Department: <select name="names"><?php foreach($departments as $department){ ?><option selected="selected"><?php echo($department['departmentName']); }?></option></select><br>
                    Code: <input type="text" name="crsCode" value="<?php echo htmlspecialchars($placeHolder);?>"> <br>
                    Title: <input type="text" name="crsTitle" value="<?php echo htmlspecialchars($placeHolder1);?>"> <br>
                    Credits: <input type="text" name="crsCredits" value="<?php echo htmlspecialchars($placeHolder2);?>"> <br>
                    <input type="hidden" name="theID" value="<?php echo htmlspecialchars($departmentID);?>"> <br>
                    <input type="hidden" name="courseID" value="<?php echo htmlspecialchars($placeHolder4);?>"> <br>
                    <br>
                    Description: <textarea name="crsDescription" rows="7" cols="40" value="<?php echo htmlspecialchars($placeHolder3);?>">Add description here.</textarea> <br> <br>
                    <button type="submit" value= "submit">Update Course</button>
                </form>
                </tr>
                <br>

                <a href="manager_home.php">View Course List</a>

            </section>
        </nav>
    </aside>
</main>
<footer></footer>
</body>
</html>