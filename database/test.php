<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'Connection.php';

$con = new Connection();

$query = "INSERT INTO allcourses (coursecode, coursename, courseyear) VALUES ('%s', '%s', '%d')";
$con->real_escape_query($query, "CS101", "Testcourse", 2017);
//$con->query($query, "","");

