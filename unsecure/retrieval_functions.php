<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../database/init.php';


/**
 * 
 * @return result
 */
function getEmails() {
    $result = NULL;
    $dbCon = connectToDB('cproject');

    if (!connected($dbCon)) {
        die();
    }
    $prepStatement = mysqli_prepare($dbCon, "SELECT email FROM useraccount");

    //execute prepared statement
    if ($prepStatement) {
        mysqli_stmt_execute($prepStatement);
        $result = mysqli_stmt_get_result($prepStatement);
    }

    return $result;
}


/**
 * 
 * @return result
 */
function getUsernames() {
    $result = NULL;
    $dbCon = connectToDB('cproject');

    if (!connected($dbCon)) {
        die();
    }
    $prepStatement = mysqli_prepare($dbCon, "SELECT username FROM useraccount");

    //execute prepared statement
    if ($prepStatement) {
        mysqli_stmt_execute($prepStatement);
        $result = mysqli_stmt_get_result($prepStatement);
    }

    return $result;
}


/**
 * 
 * @return result
 */
function fetchMajors() {
    $result = NULL;
    $dbCon = connectToDB('cproject');

    if (!connected($dbCon)) {
        die();
    }
    $prepStatement = mysqli_prepare($dbCon, "SELECT majorname FROM allmajor WHERE majorid != 99");

    //execute prepared statement
    if ($prepStatement) {
        mysqli_stmt_execute($prepStatement);
        $result = mysqli_stmt_get_result($prepStatement);
    }

    return $result;
}

/**
 * 
 * @return result
 */
function getMajors() {
    $result = NULL;
    $dbCon = connectToDB('cproject');

    if (!connected($dbCon)) {
        die();
    }
    $prepStatement = mysqli_prepare($dbCon, "SELECT majorid FROM allmajor WHERE majorid != 99");

    //execute prepared statement
    if ($prepStatement) {
        mysqli_stmt_execute($prepStatement);
        $result = mysqli_stmt_get_result($prepStatement);
    }

    return $result;
}

/**
 * 
 * @return result
 */
function getPermissions() {
    $result = NULL;
    $dbCon = connectToDB('cproject');

    if (!connected($dbCon)) {
        die();
    }
    $prepStatement = mysqli_prepare($dbCon, "SELECT perid FROM allpermission");

    //execute prepared statement
    if ($prepStatement) {
        mysqli_stmt_execute($prepStatement);
        $result = mysqli_stmt_get_result($prepStatement);
    }

    return $result;
}