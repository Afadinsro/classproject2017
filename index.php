<?php
session_start();
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('Location: login/index.php');
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/header_style.css">
    </head>
    <body>
        <?php
        include 'layout/header.php';
        
        $user = $_SESSION['user'];
        echo "Login Successful!\n Welcome $user";
        ?>
    </body>
</html>
