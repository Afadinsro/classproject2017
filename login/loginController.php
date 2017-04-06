<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require dirname(__FILE__).'/../database/init.php';
require dirname(__FILE__).'/../unsecure/retrieval_functions.php';
require dirname(__FILE__)."/../classes/User.php";

$correctPass = $pwdMessage = $username = $password = $unameMessage = '';
 

if (isset($_POST['submit'])) {
    $username = empty($_POST['uname']) ? '': clean_input($_POST['uname']); 
    $unameMessage = empty($_POST['uname']) ? 'Enter your username to login': '';
    
    $password = $_POST['pwd'];
    $pwdMessage = empty($_POST['pwd']) ? 'Enter your password to login': '';
    
    $user_record = selectUser($username);
    
    //echo $user_record['pwd'];
    
    if(!$user_record){
        $unameMessage = "Username does not exist";
    }

    if (empty($unameMessage) && empty($unameMessage) && $user_record) {
        
        
        $correctPass = $user_record['pwd'];
        //echo $user_record['pwd'];
        //once username exists, authenticate login details
        if (authenticate($password, $correctPass)) {

            //create a user object to use as a session variable
            //use password that the user typed, not the one from the database 
            $user = new User(1, $user_record['username'], $user_record['fname'], $user_record['lname'], $password, $user_record['email'], $user_record['gender'], $user_record['major_id'], $user_record['per_id']);
            
            //$user->display();
            
            session_start();
            if(isset($_SESSION['umessage']) || isset($_SESSION['pmessage'])){
                unset($_SESSION['umessage']);
                unset($_SESSION['pmessage']);
                echo 'error messages unset';
            }
            
            $ser = $user->serialize();
            //echo $ser;
            
            $_SESSION['suser'] = $ser; 
            if(isset($_SESSION['suser'])){
                echo 'session '.$_SESSION['suser'].' has been set';
            }
            //header('Location: ../index.php');
        } else {
            
            $pwdMessage = "Password incorrect. Please enter the correct password for $username"; 
        }
    }
    
    
    
    //there was an error
    /*if (isset($pwdMessage) || isset($unameMessage)) {
        session_start();
        $_SESSION['umessage'] = $unameMessage;
        $_SERVER['pmessage'] = $pwdMessage;
        
        header('Location: index.php');
    }*/
    
}