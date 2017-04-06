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
//start session
//session_start();

function getCurrentPage() {
    return basename($_SERVER['PHP_SELF']);
}

function getHeader($permission){
    
    switch ($permission) {
        case 1:
            require_once '../layout/admin_header.php';
            break;
        case 2:
            require_once '../layout/student_header.php';
            break;
        case 3:
            require_once '../layout/faculty_header.php';
            break;
    }
}

?>