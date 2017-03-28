<?php
/**
 * Michael Blackley
 * Group9_HW05
 * Homework 5
 * Purpose: The purpose of this file is to display to the user all the courses that are available for them to register depending on
 * what department they are in. The database checks to see what department they are in depending on what their username is. From there
 * the program fetches all the user's information and displays the correct courses for them to choose to register for. If this program worked
 * 100% the user would be able to click 'See Registered Courses' and it would display the courses the user choose to register for.
 *
 */
require_once('database.php');
session_start();
//$name = $_POST['nameOne'];
//$uDept = $_SESSION['uDept'];
//echo $_POST['userName'];



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
$queryUser = 'SELECT * FROM users
                      WHERE userName = :userName AND password = :password';
$statement1 = $conn->prepare($queryUser);
$statement1->bindValue(':userName', $userName);
$statement1->bindValue(':password', $password);
$statement1->execute();
$category = $statement1->fetch();

$firstName = $category['firstName'];
$departmentID = $category['deptID'];



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
$queryCourses = 'SELECT * FROM course WHERE dep_id = :dep_id ORDER BY crs_code';
$statement3 = $conn->prepare($queryCourses);
$statement3->bindValue(':dep_id', $dep_id);
$statement3->execute();
$courses = $statement3->fetchAll();
$statement3->closeCursor();

?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>University Courses Management</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<main>
    <h1 class="black">Welcome Back <?php echo $_SESSION['firstName'];?>!</h1>
    <b><hr></b>
    <section>
        <!-- display a table of products -->
        <h2><?php echo $departmentName; ?></h2>
        <table>
            <tr>
                <th>Code</th>
                <th class="right">Title</th>
                <th>Credits</th>
                <th>Description</th>
                <th> </th>
            </tr>


            <?php foreach ($courses as $course) : ?>
                <form action="register.php" method="post">
                    <tr>
                        <td><?php echo $course['crs_code']; ?></td>
                        <td><?php echo $course['crs_title']; ?></td>
                        <td><?php echo $course['crs_credits']; ?></td>
                        <td><?php echo $course['crs_description']; ?></td>
                        <td><form action="register_course_form.php" method="post">
                                <input type="hidden" name="course_id"
                                       value="<?php echo $course['crs_code']; ?>">
                                <input type="hidden" name="dep_id"
                                       value="<?php echo $course['dep_id']; ?>">
                                <input type="submit" name="register" value="Register" <?php if ($courses == $course) echo 'disabled="disabled"' ?> >
                            </form>
                        </td>
                    </tr>
                </form>
            <?php endforeach; ?>
        </table>
        <h4><a href="registered_Courses.php">See Registered Courses</a> </h4>
        <h4><a href="logout.php">Logout!</a> </h4>
    </section>
</main>
<footer></footer>

</body>
</html>