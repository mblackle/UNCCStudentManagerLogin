<?php
/**
 * Michael Blackley
 * Group9_HW05
 * Homework 5
 * Purpose: If the user that has logged in is given the role of 'manager', this is the page that the user is sent to. This page gives the user
 * the ability to navigate in between departments and add, delete or update a specific course. They also have the ability to add a whole new
 * department if they choose to do so.
 */
require_once('database.php');

session_start();

if(isset($_POST['userName'])){
    if(!isset($_COOKIE['userName']))
        setcookie('userName', $_POST['userName'] , time()+120000, '/');
}
if(!isset($_SESSION['role']))
{
    header("Location: index.php");
}


$userName = $_SESSION['userName'];
$password = $_SESSION['password'];
$departmentID = filter_input(INPUT_GET, 'departmentID', FILTER_VALIDATE_INT);
if ($departmentID == NULL || $departmentID == FALSE) {
    $departmentID = 1;
}

$queryUser = 'SELECT * FROM users
                      WHERE userName = :userName AND password = :password';
$statement1 = $conn->prepare($queryUser);
$statement1->bindValue(':userName', $userName);
$statement1->bindValue(':password', $password);
$statement1->execute();
$category = $statement1->fetch();

$firstName = $category['firstName'];
$departID = $category['deptID'];  //** use this variable */

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

$dep_id = $category['deptID'];

// Get course for selected category
//$queryCourses = 'SELECT * FROM course WHERE dep_id = :dep_id ORDER BY crs_code';
//$statement3 = $conn->prepare($queryCourses);
//$statement3->bindValue(':dep_id', $dep_id);
//$statement3->execute();
//$courses = $statement3->fetchAll();
//$statement3->closeCursor();

$queryCourses = 'SELECT * FROM course WHERE dep_ID = :dep ORDER BY crs_code';
$statement3 = $conn->prepare($queryCourses);
$statement3->bindValue(':dep', $departmentID);
$statement3->execute();
$courses = $statement3->fetchAll();
$statement3->closeCursor();

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
    <h1 class="black">Welcome Back <?php echo $_SESSION['firstName'];?>!</h1>
    <aside>
        <!-- display a list of categories -->
        <h2>Departments</h2>
        <nav>
            <ul>
                <?php foreach ($departments as $department) : ?>
                    <li>
                        <a href="?departmentID=<?php echo $department['departmentID']; ?>">
                            <?php echo $department['departmentName']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </aside>

    <section>
        <!-- display a table of products -->
        <h2><?php echo $departmentName; ?></h2>
        <table>
            <tr>
                <th> Code </th>
                <th> Title </th>
                <th> Credits </th>
                <th> Description </th>
                <!-- <th class="right">Price</th> -->
            </tr>

            <?php foreach ($courses as $course) : ?>
                <tr>
                    <td><?php echo $course['crs_code']; ?></td>
                    <td><?php echo $course['crs_title']; ?></td>
                    <td><?php echo $course['crs_credits']; ?></td>
                    <td><?php echo $course['crs_description']; ?></td>

                    <form action="deleteCourse.php" method="post">
                        <input type="hidden"name="crsID">
                        <td> <button type="submit" name="deleteCourse" value="<?php echo $course['crs_code']; ?>">Delete</button> </td>
                    </form>
                    <form action="course_update_form.php" method="post">
                        <input type="hidden"name="crsTitle">
                        <td> <button type="submit" name="updateCourse" value="<?php echo $course['crs_code']; ?>">Update</button> </td>
                    </form>
                    <form action="add_course.php" method="post">
                        <input type="hidden" name="theName" value="<?php echo $departmentName; ?>">
                    </form>

                </tr>
            <?php endforeach; ?>


        </table>
        <br>
        <a href="add_course.php?name=<?php echo $departmentName; ?>">Add Course</a>
        <br>
        <a href="department_list.php">Department List</a>
        <h4><a href="logout.php">Logout!</a> </h4>

    </section>

</main>
<footer></footer>
</body>
</html>
