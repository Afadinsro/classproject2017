<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__) . "/../database/init.php";

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

/**
 * 
 * @param string $username
 * @return array An assoc array with the selected record
 */
function selectUser(string $username) {
    $result = NULL;
    $assoc_array = NULL;
    $dbCon = connectToDB('cproject');

    if (!connected($dbCon)) {
        die();
    }
    //prepare statement
    $prepStatement = mysqli_prepare($dbCon, "SELECT username, pwd, fname, lname, email, gender, major_id, per_id FROM useraccount WHERE username = ?");

    if ($prepStatement) {
        //bind parameters
        mysqli_stmt_bind_param($prepStatement, 's', $username);
        //execute prepared statement
        mysqli_stmt_execute($prepStatement);
        $result = mysqli_stmt_get_result($prepStatement);
        //fetch assoc array
        $assoc_array = mysqli_fetch_assoc($result);
    }
    //close resources
    mysqli_stmt_close($prepStatement);
    mysqli_close($dbCon);
    //return assoc array
    return $assoc_array;
}
