<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require dirname(__FILE__).'/../unsecure/retrieval_functions.php';
require dirname(__FILE__)."/../classes/User.php";

$username = '';
$password = '';
$correctPass = '';

if (isset($_POST['submit'])) {
    $username = $_POST['uname'];
    $password = $_POST['pwd'];

    $user_record = selectUser('admin');
    
    echo $user_record['pwd'];
    /*foreach ($result as $value) {
        echo '**  '.$value['username'];
    }*/

    if (!$user_record) {
        //username does not exist
        echo "Username: $username does not exist";
    } else {
        
        
        $correctPass = $user_record['pwd'];
        echo $user_record['pwd'];
        //once username exists, authenticate login details
        if (authenticate($password, $correctPass)) {
            echo 'login successful';

            //create a user object to use as a session variable
            //use password that the user typed, not the one from the database 
            $user = new User($user_record['username'], $user_record['fname'], $user_record['lname'], $password, $user_record['email'], $user_record['gender'], $user_record['major_id'], $user_record['per_id']);
            
            //$user->display();
            
            
            
            //start session
            session_start();
            $ser = $user->serialize();
            echo $ser;
            
            $_SESSION['suser'] = $ser; 
            header('Location: ../index.php');
        } else {
            echo "Password incorrect. Please enter the correct password for $username";
        }
    }
}


//echo password_hash('an0;n!M#2', PASSWORD_DEFAULT);