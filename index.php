<?php
/**
 * Michael Blackley
 * Group9_HW06
 * Homework 6
 * Purpose: The purpose of this page is to setup the session for the specific user
 * that has signed in. This part of my code was never finalized due to errors I kept constantly
 * receiving. The idea was for the program to remember the user that logged into the server
 * until the user clicked log out. This step was imperative to the register file that is shown later
 * in the project. There is also a form at the bottom that takes the user's username and password and
 * sends that information to the login.php page. There is also a href link that will send the user to
 * a sign up form in case they are not already a saved user in the database.
 */

require_once('database.php');
session_start();

if( isset($_SESSION['ERRMSG'])) {
    echo '<p style="padding:0; color:red;">';
    echo $_SESSION['ERRMSG'];
    echo '</p>';
    unset($_SESSION['ERRMSG']);
}

function loggedin(){
    if(isset($_SESSION['login']) || isset($_COOKIE['userLogin'])){
        $loggedin=TRUE;
        return $loggedin;
    }
}
/*
if(isset($_POST['login'])){
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $remember_me = $_POST['remember_me'];

    if($userName && $password){
        $login=("SELECT * FROM users WHERE userName='$userName'");
        while($row=($login)){
            $db_userName=$row['userName'];
            $db_password=$row['password'];
            $db_firstname=$row['firstname'];
            $db_lastname=$row['lastname'];

            if($password==$db_password){$log=TRUE;}
            else{$log=FALSE;}
        }
        if($log==TRUE){
            if($remember_me=="on"){
                setcookie("userName", $userName, time()+7200);
                setcookie("password", $password, time()+7200);
                setcookie("remember_me", $remember_me, time()+7200);
            }
            else if($remember_me=="off"){
                die;
            }
        }
        else{die("Wrong email or password");}
    }
}
*/
if(!empty($_POST["login"])) {
    $conn = mysqli_connect("localhost", "root", "", "university_schema");
    $sql = "Select * from users where userName = '" . $_POST["userName"] . "' and password = '" . md5($_POST["password"]) . "'";
    $result = mysqli_query($conn,$sql);
    $user = mysqli_fetch_array($result);
    if($user) {
        $_SESSION["userID"]		   = $user["userID"];

        if(!empty($_POST["remember"])) {
            setcookie ("userLogin",$_POST["userName"],time()+ (10 * 365 * 24 * 60 * 60));
            setcookie ("password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
        } else {
            if(isset($_COOKIE["userLogin"])) {
                setcookie ("userLogin","");
            }
            if(isset($_COOKIE["password"])) {
                setcookie ("password","");
            }
        }
    } else {
        $message = "Invalid Login";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <meta charset="UTF-8">
</head>
<body>
<?php
/*
if(isset($_COOKIE['userName']))
    echo "<h1> Welcome back ".$_COOKIE['userName']."</h1>";
*/
?>


<form action="login.php" method="post" id="Login">
    <center><img src="charlotteLogo.jpg" alt="banner" style="width:400px;height:200px;"></center>
    <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>
    <br>
    <br>
    <br>
    <form action="login.php" method="POST">
        <label><b>Username</b></label>
        <br>
        <input type="text" name="userName" value="<?php if(isset($_COOKIE["userName"])) { echo $_COOKIE["userName"]; } ?>"
               style="background-color: #F2F5A9; width: 100%">


        <br>
        <span></span>
        <br>
        <label><b>Password</b></label>
        <br>
        <input type="password" name="password" value= "<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>"
               style="background-color: #F2F5A9; width:100%">
        <br>
        <br>

        <input class="button" type="submit" name ="submit" value='Login' style="background-color: #04B431; color: #ffffff; width:100%">
        <br>
        <br>
        <input type="checkbox" name="remember_me" id="remember_me " value=" <?php if(isset($_COOKIE["userLogin"])) { ?> checked <?php } ?> /> "
        > Remember Me<br>
        <br>

        <input class="button" type="reset" value='Cancel' style="background-color: #FF0000; color: #ffffff">

        <p><a href='user_signup_form.php'>New User?</a></p>


    </form>

</body>
</html>
