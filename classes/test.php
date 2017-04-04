<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'User.php';

/*
$username = 'dxd';
$fname = 'Derrick';
$lname = 'Dowuona';
$password = 'enigmadxd';
$email = 'derrick.dowuona@ashesi.edu.gh';
$gender = 'M';
$major_id = 1;
$per_id = 2;

$user = new user($username, $fname, $lname, $password, $email, $gender, $major_id, $per_id);

$user->display();

$ser = $user->serialize();
//echo "$ser";

$unser = $user->unserialize($ser);

//print_r($unser);

$new_user = $user->init($unser);

//echo "$new_user->fname";
$new_user->display();

//echo "$unser";
//print_r ($user->unserialize($ser));
//echo "$user->lname";
//echo basename($_SERVER['PHP_SELF']);
 
 */

$def= User::getDefault();
$def->display();