<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require dirname(__FILE__).'/../unsecure/retrieval_functions.php';
require dirname(__FILE__)."/../classes/User.php";

$username = 'derick';
$password = 'derickomari';

$user_record = selectUser($username);
$correctPass = $user_record['pwd'];

if (authenticate($password, $correctPass)) {
    echo 'correct password';
    echo "<br>";
    
    /*echo $user_record['username'];
    echo "<br>";
    echo $user_record['fname'];
    
    echo "<br>";
    echo $user_record['lname'];
    echo "<br>";
    echo $password;
    echo "<br>";
    echo $user_record['email'];
    echo "<br>";
    echo $user_record['gender'];
    echo "<br>";
    echo $user_record['major_id'];
    echo "<br>";
    echo $user_record['per_id'];
    echo "<br>";*/
    
    if(validatePassword($password)){
        echo 'matches regex'.'<br>';
    }
    
    $valid = User::is_valid($user_record['username'], $user_record['fname'], $user_record['lname'], $password, $user_record['email'], $user_record['gender'], $user_record['major_id'], $user_record['per_id']);
    
    if($valid){
        echo 'correct details';
    } else {
        echo 'wrong details';
    }
    
    $user = new User($user_record['username'], $user_record['fname'], $user_record['lname'], $password, $user_record['email'], $user_record['gender'], $user_record['major_id'], $user_record['per_id']);
    
    $user->display();
}


$n = User::getDefault();
$n->display();
$n->test($username,$user_record['email']);