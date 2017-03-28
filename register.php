<?php
/**
 * Michael Blackley
 * Group9_HW05
 * Homework 5
 * Purpose: This part of the project was never fully completed, the purpose of this file is to show the specific user what classes
 * they are able to register for depending on their department (Engineering, Mathematics, etc). The user clicks register and should only
 * be able to click this button once. From there, the program will add the registered classes information to the database.
 */
require_once('database.php');
$crs_code = $_POST['course_id'];
$departmentID = $_POST['dep_id'];

echo $crs_code;
//echo $departmentID;

$queryCourses = 'SELECT * FROM course WHERE crs_code = :crs_code ORDER BY crs_code';
$statement1 = $conn->prepare($queryCourses);
$statement1->bindValue(':crs_code', $crs_code);
$statement1->execute();
$run = $statement1->fetch();
$statement1->closeCursor();

$queryRegCourses = 'SELECT * FROM reg_courses';
$stmt = $conn->prepare($queryCourses);
$stmt->execute();
$course = $stmt->fetch();
$stmt->closeCursor();

foreach($course as $courses) {
    echo $courses['crs_ID'];
}

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
    <b><hr></b>
    <section>
        <!-- display a table of products -->
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
                                       value="<?php echo $course['crs_ID']; ?>">
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
    </section>
</main>
<footer></footer>

</body>
</html>
