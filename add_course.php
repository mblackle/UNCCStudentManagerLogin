<?php
/**
 * Carrie Mao
 * Michael Blackley
 * Group9_HW04
 * Homework 04
 */

require_once('database.php');

$departmentID = filter_input(INPUT_GET, 'departmentID', FILTER_VALIDATE_INT);
if ($departmentID == NULL || $departmentID == FALSE) {
    $departmentID = 1;
}
$add = $_GET['name'];
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
    <h2>Add Course</h2>
    <aside>
        <!-- display a list of categories -->

        <nav>
            <section>
                <!-- display a table of products -->
                <form action="addCourseToDB.php" method="post">
                    Department: <select name="names" value="<?php echo $selectOption = $_POST['names']; ?>"><?php foreach($departments as $department){ ?><option selected="<?php echo $add;?>"><?php echo($department['departmentName']); }?></option></select><br>
                    Code: <input type="text" name="crsCode"> <br>
                    Title: <input type="text" name="crsTitle"> <br>
                    Credits: <input type="text" name="crsCredits"> <br>
                    <br>
                    Description: <textarea name="crsDescription" rows="7" cols="40">Add description here.</textarea> <br> <br>
                    <button type="submit" value="Submit">Add Course</button>
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
