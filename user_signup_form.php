<?php
/**
 * Michael Blackley
 * Group9_HW06
 * Homework 6
 * Purpose: The purpose of this file is to show the user the sign up form and for them to fill it out
 * to be later saved in the database as their user information. If the user does not meet the requirements
 * for each of the fields. These values entered into the fields are sent to the signupHandler.php file. If
 * the requirements are not met then the signupHandler.php file will send an error message back to this file
 * and display to the user errors of what went wrong during their sign up process. The user may also select
 * which department they are in to be saved into that specific department in the database.
 */

require_once('database.php');

$queryAllDepartments = 'SELECT * FROM department ORDER BY departmentID';
$statement2 = $conn->prepare($queryAllDepartments);
$statement2->execute();
$departments = $statement2->fetchAll();
$statement2->closeCursor();

$error = filter_input(INPUT_GET, 'error', FILTER_VALIDATE_INT);
if ($error == NULL || $error == FALSE) {
    $error = 0;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Registration</title>

    <!-- Framework CSS -->
    <link rel="stylesheet" href="screen.css" type="text/css" media="screen, projection">
    <link rel="stylesheet" href="print.css" type="text/css" media="print">
    <!--[if lt IE 8]><link rel="stylesheet" href="ie.css" type="text/css" media="screen, projection"><![endif]-->
  </head>
  <body>
    <div class="container">
      <h1>Registration Form </h1>
      <hr>
      <div class="span-3">
      	<br/>
      </div>
      <div class="span-18">
            <?php
           if($error == 1) {
                echo '<div class="error"> Username already used, please use another username.</div>';
            }

            elseif($error == 2) {
                echo '<div class="error"> Username should contain 4-10 alphanumeric characters.</div>';
            }

            elseif($error == 3)  {
               echo '<div class="error"> Password should be at least 8 charaters, 1 upper case letter [A-Z], one special character !,#,@.</div>';
            }

            elseif($error == 4) {
              echo '<div class="error"> Password and confirm password should match.</div>';
            }

             elseif($error == 10) {
                  echo '<div class="error"> Role was not selected.</div>';
              }

            elseif($error == 6) {
                echo '<div class="error"> Please select a gender.</div>';
            }

              elseif($error == 7) {
                echo '<div class="error"> Please enter the correct email format.</div>';
              }


            elseif($error == 11) {
            echo '<div class="error"> Please check the box to accept our terms.</div>';
            }

            elseif($error == 9) {
               echo '<div class="error"> Firstname and Lastname should only contain characters [A-Z] or [a-z].</div>';
           }

           else{
               echo '<div class="error" style="display:none"></div>';
           }

            ?>


        <form id="dummy" action="signupHandler.php" method="post" class="inline">
          <fieldset>
            <div class="span-9">

            <p>
              <label for="username">Username</label><br>
              <input type="text" class="text" id="username" name="username" value="" >
            </p>

            <p>
              <label for="password">Password</label><br>
              <input type="password" class="text" id="password" name="password" value="">
            </p>  
            
            <p>
              <label for="firstname">Firstname</label><br>
              <input type="text" class="text" id="firstname" name="firstname" value="">
            </p>

            </div>
            
            <div class="span-8 last">
            <p>
              <label for="email">Email</label><br>
              <input type="text" class="text" id="email" name="email" value="">
            </p>
            
			<p>
              <label for="confirmpassword">Confirm Password</label><br>
              <input type="password" class="text" id="confirmpassword" name="confirmpassword" value="">
            </p>


            <p>
              <label for="lastname">Lastname</label><br>
              <input type="text" class="text" id="lastname" name="lastname" value="">
            </p>

          	<p>
          		<label>Gender</label><br>
            	<input type="radio" name="gender" value="male"> Male
            	<input type="radio" name="gender" value="female"> Female<br>
          	</p>

                <p>
                    <label>Role</label><br>
                    <input type="radio" name="role" value="student"> Student
                    <input type="radio" name="role" value="manager"> Manager<br>
                </p>
          	<p>
          		<label for="dept">Department</label><br>
            	<select id="dept" name="dept" value="<?php echo $_POST['dept']; ?>">
                    <?php foreach($departments as $department){?>
                    <option><?php echo($department['departmentName']); }?></option></select><br>
			</p>

			<p>
				<input type="checkbox" name="accepted" id="accepted" value="accepted"> Please check this checkbox to accept our terms.
            </p>
          	
            <p>
              <input type="submit" value="Submit">
              <input type="reset" value="Reset">
            </p>            	
            	
            </div>

          </fieldset>
        </form>
      </div>
      <div class="span-3 last">
      	<br/>
      </div>
    </div>
  </body>
</html>
