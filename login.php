<?php

include_once 'resource/session.php';
include_once 'resource/utilities.php';


if (isset($_POST['loginBtn']))


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
        <tr><td><a href="forget_password.php">Forgot Password?</a></td><td><input style="float: right;" type="submit" name="loginBtn" value="Signin"></td></tr>

    </table>


</form>
