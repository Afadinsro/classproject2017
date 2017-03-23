<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../database/init.php';

$db = 'cproject';
$connection = connectToDB($db);

if(connected($connection)){
    echo 'connected';
}

