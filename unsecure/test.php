<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'retrieval_functions.php';

$array = selectUser('admin');
echo $array['pwd'];

/*foreach ($array as $value) {
    echo $value['fname'];
}*/