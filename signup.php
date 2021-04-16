<?php
include_once 'resource/utilities.php';

//process form
if (isset($_POST[signupBtn])){
    //initialize an array to store any error message from the form
    $form_errors = array();

    $required_fields = array('email', 'username', 'password');

    //call function to check empty field and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    //Fields that requires checking for minimum length
    $fields_to_check_length = array('username' => 4, 'password' => 6);

    //call the function to check minimum required length and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    //email validation / merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_email($_POST));

    //collect form data and store in variables
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];



    //check if error array is empty, then proceed to insert record to file
    if (empty($form_errors)) {
       //hashing password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try {
            //check if user exist
           $file = fopen("records.txt","r");
           $findUser = false;
           while (!feof($file)) {
               $line = fgets($file);
               $array = explode(",",$line);
               if (trim($array[0]) == $username) {
                   $findUser = true;
                   break;
               }
           }
           fclose($file);

           //register user or pop up message
            if ($findUser) {
                $result = flashMessage($username. " already exist!");

            } else {
                $file = fopen("records.txt", "a");
                fputs($file,$username . "," . $email . ",". $hashed_password. "\r\n");
                fclose($file);
                $result = flashMessage($username. " Registration successful");
                redirectTo('homepage');
            }
        } catch (Exception $exception) {
        $result = flashMessage("An error has occurred ".$exception->getMessage());
        }
    }
    else{
        if(count($form_errors) == 1){
            $result = flashMessage("There was 1 error in the form <br>");
        }else{
            $result = flashMessage("There were " .count($form_errors). " errors in the form <br>");
        }
    }
    }

?>



<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Register Page</title>
</head>
<body>
<h2>User Authentication System </h2><hr>

<h3>Registration Form</h3>

<?php if(isset($result)) echo $result; ?>
<?php if(!empty($form_errors)) echo show_errors($form_errors); ?>

<form method="post" action="">
    <table>
        <tr><td>Email:</td> <td><input type="text" value="" name="email"></td></tr>
        <tr><td>Username:</td> <td><input type="text" value="" name="username"></td></tr>
        <tr><td>Password:</td> <td><input type="password" value="" name="password"></td></tr>
        <tr><td></td><td><input style="float: right;" type="submit" name="signupBtn" value="Signup"></td></tr>
    </table>