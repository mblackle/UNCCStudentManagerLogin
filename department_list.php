<?php
/**
 * Carrie Mao
 * Michael Blackley
 * Group9_HW04
 * Homework 4
 */

require_once('database.php');




// Get name for selected department
//$queryCategory = 'SELECT * FROM department WHERE departmentID = :departmentID';
//$statement1 = $conn->prepare($queryCategory);
//$statement1->bindValue(':departmentID', $departmentID);
//$statement1->execute();
//$department = $statement1->fetch();
//$departmentName = $department['departmentName'];
//$statement1->closeCursor();

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
    <h1 style="color:black; border-bottom: 5px solid black">Courses Manager </h1>

    <aside>
        <section>
        <h2>Department List</h2>

            <table>
                <tr>
                    <th> Name </th>
                    <th></th>
                    <!-- <th class="right">Price</th> -->
                </tr>

                <?php foreach ($departments as $department) : ?>
                    <tr>
                        <td><a href="?departmentID=<?php echo $department['departmentID']; ?>">
                            <?php echo $department['departmentName']; ?> </a> </td>

                        <form action="Delete.php" method="post">
                            <td> <button type="submit" name="delete" value="<?php echo $department['departmentID']; ?>">Delete</button>
                        </form>
                        </td>


                        <form action="department_update_from.php" method="post">
                            <td><button type="submit" name="update" value="<?php echo $department['departmentID']; ?>">Update</button> </td>
                        </form>

                    </td>
                <?php endforeach; ?>
            </table>
        </section>
        <section>

        <h2>Add Department</h2>
        <form action="add_deparment.php" method="post">
            Name: <input type="text" name="DepName"> <button type="submit" value="Submit";>Add</button>
        </form>

            <br>
            <a href="manager_home.php">List Courses</a>

            <h1 style="color:black; border-bottom: 2px solid black"></h1>

        </section>
    </aside>
</main>
<footer></footer>
</body>
</html>



