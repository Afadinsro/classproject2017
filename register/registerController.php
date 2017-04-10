<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require dirname(__FILE__) . '/../database/init.php';
require dirname(__FILE__) . '/../unsecure/form_validation.php';
require dirname(__FILE__) . '/../classes/User.php';



//form
//username text length
//fullname text length
//password text password
//email text email 
//tel text length
//gender radio
//major dropdown - BA, MIS, CS, ENG
//Course dropdown - Based on top selection AJAX
//List about 5 courses, select 3
//permission - hidden field
//status - active / inactive
//submit
//validation - javascript & php
//insert to database
//get variables
if (isset($_POST['submit'])) {
    $username = strlen($_POST['uname']) > 0 ? clean_input($_POST['uname']) : '';
    $password = clean_input($_POST['pword']);
    $fname = clean_input($_POST['fname']);
    $lname = clean_input($_POST['lname']);
    $email = clean_input($_POST['email']);
    $gender = clean_input($_POST['gender']);
    $major = clean_input($_POST['major']);

    $major_id = getMajorId($major);

    $user = new User(1, $username, $fname, $lname, $password, $email, $gender, $major_id, 2);
    $success = register($user);
    if ($success) {
        header("Location: ../login/");
    } else {
        echo 'unsuccessful';
    }
}

/**
 * Registers a new user of the system
 * @global User $user
 * @param User $user A user object to add
 * @return boolean True upon successful registration and false if otherwise
 */
function register(User $user) {
    $success = FALSE;
    $con = connectToDB('cproject');
    $array = $user->toArray();
    $types = getTypes($array);

    if (connected($con)) {
        global $user;
        //prepare an sql statement
        //because double quotes are used, the values of variables are used. No concatenation needed.
        $prepStatement = mysqli_prepare($con, "INSERT INTO useraccount(username, pwd, fname, lname, email, gender, major_id, userstatus, per_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        //check if prepared statement was successful
        if ($prepStatement) {
            //bind parameters
            $hash_pwd = password_hash($user->getPassword(), PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($prepStatement, $types, $user->username, $hash_pwd, $user->fname, $user->lname, $user->getEmail(), $user->gender, $user->major_id, $user->status, $user->per_id);
            //execute prepared statement
            $success = mysqli_stmt_execute($prepStatement);
        }
        //close prepared statement
        mysqli_stmt_close($prepStatement);
    }
    return $success;
}

/**
 * 
 * @param string $major
 * @return int
 */
function getMajorId(string $major) {
    $major_id = -1;
    $result = NULL;
    $con = connectToDB('cproject');
    if (connected($con)) {
        //prepare an sql statement
        $prepStatement = mysqli_prepare($con, "SELECT majorid FROM allmajor WHERE majorname = ?");
        //check if prepared statement was successful
        if ($prepStatement) {
            //bind parameters
            mysqli_stmt_bind_param($prepStatement, 'i', $major);
            //execute prepared statement
            mysqli_stmt_execute($prepStatement);
            $result = mysqli_stmt_get_result($prepStatement);
        }
        $assoc_array = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $major_id = $assoc_array['majorid'];
        //close prepared statement
        mysqli_stmt_close($prepStatement);
        mysqli_close($con);
    }
    return $major_id;
}
