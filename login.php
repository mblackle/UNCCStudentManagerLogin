<?php
/**
 * Carrie Mao
 * Michael Blackley
 * Group9_HW06
 * Homework 6
 */
require_once('database.php');

session_start();

$userName = $_POST['userName'];

$password = $_POST['password'];

if( isset($_SESSION['ERRMSG'])) {
    echo '<p style="padding:0; color:red;">';
    echo $_SESSION['ERRMSG'];
    echo '</p>';
    unset($_SESSION['ERRMSG']);
}

if(isset($_POST['userName'])){
    if(!isset($_COOKIE['userName']))
        setcookie('userName', $_POST['userName'] , time()+120000, '/');
}

$queryUser = 'SELECT * FROM users
                      WHERE userName = :userName AND password = :password';
$statement1 = $conn->prepare($queryUser);
$statement1->bindValue(':userName', $userName);
$statement1->bindValue(':password', $password);
$statement1->execute();
$category = $statement1->fetch();
//$category_name = $category['categoryName'];


if($category > 0) {
    $_SESSION['firstName'] = $category['firstName'];
    $_SESSION['userName'] = $category['userName'] ;
    $_SESSION['uDept'] = $category['uDept'];
    $_SESSION['role'] = $category['role'];
    $_SESSION['password'] = $category['password'];

    if($category['role'] == 'manager')
        header("location: manager_home.php");
    elseif ($category[6] == 'student')
        header("location: student_home.php");
    else
        header("location: index.php");
}
else{
    $errmsg = '';
}
if(isset($errmsg)) {
    $_SESSION['ERRMSG'] = $errmsg;
    session_write_close();
    header("location: index.php");
    exit();
}


?>
