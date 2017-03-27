<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../database/init.php';

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
        $username = $_POST['uname'];
        $password = $_POST['pword'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $major = $_POST['major'];
        
        echo '';
        
    }
}

