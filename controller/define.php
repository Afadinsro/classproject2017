<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * User class
 */
define('DEFAULT_STATUS', 'ACTIVE');
define('NEW_USER', 1);
define('DUPLICATE_USER', 0);
define('STUDENT_PERMISSION', 2);
define('FACULTY_PERMISSION', 3);
define('ADMIN_PERMISSION', 1);
define('DEFAULT_PASSWORD', 'mydefault');
define('DEFAULT_NAME', 'default');
define('DEFAULT_EMAIL', 'default@email.com');
define('DEFAULT_GENDER', 'M');
define('DEFAULT_MAJOR', 1);


/*
 * Regular Expressions
 */
define("PWD_REGEX", "/([a-zA-Z0-9@*#!;]{5,15})$/");
define("EMAIL_REGEX", "/^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$/");

/*
 * Menu navigation
 */
define("BASE_URL", "http://" . $_SERVER['SERVER_NAME'] . "/classproject2017"); 