<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../database/init.php';
require '../classes/User.php';

$username = '';
$password = '';
$email = '';
$fname = '';
$lname = '';

$correctPass = '';

if (isset($_POST['submit'])) {
    $username = $_POST['uname'];
    $password = $_POST['pwd'];

    //connect to database
    $con = connectToDB("cproject");
    if (!connected($con)) {
        echo 'Not connected to database';
    } elseif (connected($con)) {

        $valueArray = array($username);
        //check if username exists in database
        //NB: select function returns an array.
        $table = 'useraccount';
        $columns = array('pwd','username');
        $passArray = select($username, $table, $columns, getTypes($valueArray), $con);
        if (!$passArray) {
            //username does not exist
            echo "Username: $username does not exist";
        } else{
            //echo $passArray[0];
            $correctPass = $passArray[0];
            //once username exists, authenticate login details
            if (authenticate($password, $correctPass)) {
                echo 'login successful';

                //start session
                session_start();

                global $username;
                $_SESSION['user'] = $username;
                header('Location: ../index.php');
            } else {
                echo "Password incorrect. Please enter the correct password for $username";
            }
        }
    }
}

//echo password_hash('an0;n!M#2', PASSWORD_DEFAULT);