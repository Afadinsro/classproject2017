<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require dirname(__FILE__) . '/../database/init.php';
require dirname(__FILE__) . '/../unsecure/retrieval_functions.php';
require dirname(__FILE__) . "/../classes/User.php";

$correctPass = $pwdMessage = $username = $password = $unameMessage = '';
//$GLOBALS['pwdMessage'] = $GLOBALS['uMessage'] = $GLOBALS['username'] = '';


if (isset($_POST['submit'])) {
    $username = empty($_POST['uname']) ? '' : clean_input($_POST['uname']);
    $GLOBALS['uMessage'] = empty($username) ? 'Enter your username to login' : '';
    $unameMessage = empty($username) ? 'Enter your username to login' : '';
    $password = $_POST['pwd'];
    $GLOBALS['pwdMessage'] = empty($password) ? 'Enter your password to login' : '';
    $pwdMessage = empty($password) ? 'Enter your password to login' : '';
    $user_record = selectUser($username);

    //echo $user_record['pwd'];

    if (!$user_record) {
        $GLOBALS['uMessage'] = "Username does not exist";
        $unameMessage = "Username does not exist";
    }

    if (empty($GLOBALS['uMessage']) && empty($GLOBALS['pwdMessage']) && $user_record) {


        $correctPass = $user_record['pwd'];
        //echo $user_record['pwd'];
        //once username exists, authenticate login details
        if (authenticate($password, $correctPass)) {

            //create a user object to use as a session variable
            //use password that the user typed, not the one from the database 
            $user = new User(0, $user_record['username'], $user_record['fname'], $user_record['lname'], $password, $user_record['email'], $user_record['gender'], $user_record['major_id'], $user_record['per_id']);
            
            session_start();

            $ser = $user->serialize();

            $_SESSION['suser'] = $ser;
            header('Location: ../index.php');
        } else {

            $GLOBALS['pwdMessage'] = "Password incorrect. Please enter the correct password for $username";
            $pwdMessage = "Password incorrect. Please enter the correct password for $username";
        }
    }
    if (!empty($GLOBALS['pwdMessage']) && !empty($GLOBALS['uMessage'])) {
        $GLOBALS['username'] = $username;
        header('Location: index.php');
    }
    if (!empty($GLOBALS['uMessage'])) {
        header('Location: index.php');
    }
    if (!empty($GLOBALS['pwdMessage'])) {
        $GLOBALS['username'] = $username;
        header('Location: index.php');
    }



    //there was an error
    /* if(!empty($pwdMessage) && !empty($pwdMessage)){
      session_start();
      $_SESSION['pmessage'] = $pwdMessage;
      $_SESSION['umessage'] = $unameMessage;
      $_SESSION['username'] = $username;
      header('Location: index.php');
      }
      if (!empty($unameMessage)) {
      session_start();
      $_SESSION['umessage'] = $unameMessage;
      header('Location: index.php');
      }
      if(!empty($pwdMessage)){
      session_start();
      $_SESSION['pmessage'] = $pwdMessage;
      $_SESSION['username'] = $username;
      header('Location: index.php');
      } */
}

function displayPwdError($err_message) {
    echo "$err_message";
}

function displayUnameError($err_message) {
    echo "$err_message";
}