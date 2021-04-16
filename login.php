<?php

include_once 'resource/session.php';
include_once 'resource/utilities.php';

/**
if (isset($_SESSION['use']))  //check whether session is already there
{
    redirectTo('homepage');
} else {
    include 'login.php';
}
 **/


if (isset($_POST['loginBtn'])){


    //array to hold errors

    $form_errors = array();

//validate
    $required_fields = array('username', 'password');

    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    if (empty($form_errors)) {
        //collect data from form
        $user = $_POST['username'];
        $password = $_POST['password'];

        $file = fopen('records.txt', 'r');
        $good = false;
        while (!feof($file)){
            $line = fgets($file);
            $array = explode(",",$line);



            if (trim($array[0])==$_POST[$user] && password_verify($password,trim($array[3]) )) {
                $good = true;
                break;
                } else{
                $result = flashMessage("Invalid Username or Password");
            }
        }
      if ($good) {
          $_SESSION['use'] = $user;
          echo '<script type="text/javascript">window.open("homepage.php","_self");</script>';

      } else{
          echo "invalid username or password";
      }
      fclose($file);


    } else{
        if (count($form_errors) == 1) {
            $result = flashMessage("There was one error in the form");

        } else {
            $result = flashMessage("There was" .count($form_errors)." error in the form");
        }
    }


}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
</head>
<body>
<h2>User Authentication System</h2><hr>

<h3>Login Form</h3>

<form action="" method="post">

    <table>
        <tr><td>Username:</td> <td><input type="text" value="" name="username"></td></tr>
        <tr><td>Password:</td> <td><input type="password" value="" name="password"></td></tr>
        <tr><td><a href="forget_password.php">Forgot Password?</a></td><td><input style="float: right;" type="submit" name="loginBtn" value="Signin">
                <input type="submit" name="SignUp" value="Signup"></td></tr>

    </table>


</form>
