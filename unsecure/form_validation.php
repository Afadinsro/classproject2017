<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//require_once '../database/init.php';

define("PWD_REGEX", "/^([a-zA-Z0-9@*#]{8,15})$/");
define("EMAIL_REGEX", "/^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$/");

/**
 * 
 * @param string $email
 * @return boolean
 */
function validateEmail(string $email) {
    $correct = FALSE;
    if(preg_match(EMAIL_REGEX, $email) === 1){
        $correct = TRUE;
    }
    return $correct;
}

/**
 * 
 * @param string $passwd
 * @return boolean
 */
function validatePassword(string $passwd) {
    $correct = FALSE;
    if(preg_match(PWD_REGEX, $passwd) === 1){
        $correct = TRUE;
    }
    return $correct;
}