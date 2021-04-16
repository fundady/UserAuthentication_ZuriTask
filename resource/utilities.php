<?php

/**
 * @param $required_fields_array, an array containing the list of all required fields
 * @return array, containing all errors
 */
function check_empty_fields($required_fields_array) {
    //initialize an array to store error messages
    $form_errors = array();

    //loop through the required fields array and populate the form error array
    foreach ($required_fields_array as $name_of_field){
        if (!isset($_POST[$name_of_field]) || $_POST[$name_of_field]==null) {
            $form_errors[] = $name_of_field . " is a required field";
        }
    }

    return $form_errors;
}

/**
 * @param $fields_to_check_length an array containing the name of fields
 * for which we want to check min required length e.g array('username' => 4, 'email' => 12)
 * @return array containing all errors
 */


function check_min_length($fields_to_check_length){
    //initialize an array to store error messages
    $form_errors = array();

    foreach ($fields_to_check_length as $name_of_field => $minimum_length_required){
        if (strlen(trim($_POST[$name_of_field])) < $minimum_length_required) {
            $form_errors[] = $name_of_field . " is too short, must be {$minimum_length_required} characters long";
        }
    }
    return $form_errors;
}

/**
 * @param $data  store a key/value pair array where key is the name of the form control
 * in this case 'email' and value is the input entered by the user
 * @return array, containing email error
 */

function check_email($data){
    //initialize an array to store error messages
    $form_errors = array();
    $key = 'email';

    //check if the key email exist in data array
    if (array_key_exists($key, $data)) {

        //check if the email field has a value
        if ($_POST[$key] != null) {

            //remove all illegal character from email
            $key = filter_var($key, FILTER_SANITIZE_EMAIL);

            //check if input is a valid email address
            if (filter_var($_POST[$key], FILTER_VALIDATE_EMAIL) == false) {
                $form_errors[] = $key . " is not a valid email address";
            }
        }
    }

    return $form_errors;
}