<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'Connection.php';

$con = new Connection();

$query = "INSERT INTO users (name, gender, color) VALUES ('%s', '%s', '%s')";
$con->real_escape_query($query, $con);

