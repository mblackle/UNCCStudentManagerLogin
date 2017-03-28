<?php
/**
 * Carrie Mao
 * Michael Blackley
 * Group9_HW04
 * Homework 4
 */
require_once('database.php');

$updateTable = $_POST['update'];



$sql = "SELECT departmentName, departmentID FROM department WHERE departmentID = $updateTable";
$result = $conn->query($sql);
while($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $placeHolder = $row["departmentName"];
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
    <h1 style="color:black; border-bottom: 5px solid black">University Courses Manager</h1>
    <aside>
        <section>





        </section>
        <section>

            <h2>Update Department</h2>
            <form action="updateName.php" method="post">
                Department Name: <input type="text" name="UpdateDep" value="<?php echo htmlspecialchars($placeHolder);?>"> <br> <br> <button type="submit" value="Submit";>Update Department</button>
                <input type="hidden" name="ID" value="<?php echo $updateTable; ?>">
            </form>

            <br>
            <a href="department_list.php">View Department List</a>

            <h1 style="color:black; border-bottom: 2px solid black"></h1>

        </section>
    </aside>
</main>
<footer></footer>
</body>
</html>




