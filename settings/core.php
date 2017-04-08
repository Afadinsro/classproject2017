<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

function verify_login() {
    if (!isset($_SESSION['suser']) || empty($_SESSION['suser'])) {
        header('Location: login/index.php');
    }
}

function getCurrentPage() {
    return basename($_SERVER['PHP_SELF']);
}

function getHeader($permission) {

    switch ($permission) {
        case 1:
            require_once $_SERVER['DOCUMENT_ROOT'] . 'classproject2017/layout/admin_header.php';
            break;
        case 2:
            require_once $_SERVER['DOCUMENT_ROOT'] . 'classproject2017/layout/student_header.php';
            break;
        case 3:
            require_once $_SERVER['DOCUMENT_ROOT'] . 'classproject2017/layout/faculty_header.php';
            break;
    }
}

function unserializeUser($session) {
    $user = NULL;

    if (isset($session)) {
        $temp = User::getDefault();
        //unserialise user data
        $unseri = $temp->unserialize($session);
        //replicate user
        $user = User::init($unseri);
    }
    return $user;
}

?>