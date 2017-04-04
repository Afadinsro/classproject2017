<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require dirname(__FILE__).'/../database/init.php';
require dirname(__FILE__).'/../unsecure/form_validation.php';

//connect to database
$db = 'cproject';
$connection = connectToDB($db);

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
if (connected($connection)) {
    //get variables
    if(isset($_POST['submit'])) {
        $username = strlen($_POST['uname']) > 0 ? $_POST['uname']: '';
        $password = $_POST['pword'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $major = $_POST['major'];
        
        
        
    }
}

/**
 * Registers a new user of the system
 * @global User $user
 * @param User $user A user object to add
 * @return boolean True upon successful registration and false if otherwise
 */
function register($user) {
    $success = FALSE;
    $con = connectToDB('cproject');
    $array = $user->toArray();
    $types = getTypes($array);
    
    if(connected($con)){
        global $user;
        //prepare an sql statement
        //because double quotes are used, the values of variables are used. No concatenation needed.
        $prepStatement = mysqli_prepare($con, "INSERT INTO useraccount(username, pwd, fname, lname, email, gender, major_id, userstatus, per_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        //check if prepared statement was successful
        if ($prepStatement) {
            //bind parameters
            mysqli_stmt_bind_param($prepStatement, $types, $user->username, $user->getPassword(), $user->fname, $user->lname, $user->getEmail(), $user->gender, $user->major_id, $user->status, $user->per_id);
            //execute prepared statement
            $success = mysqli_stmt_execute($prepStatement);
        }
        //close prepared statement
        mysqli_stmt_close($prepStatement);
    }
    return $success;
}
