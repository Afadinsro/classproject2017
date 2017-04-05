<?php
session_start();
if (!isset($_SESSION['suser']) || empty($_SESSION['suser'])) {
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
        require_once dirname(__FILE__).'/classes/User.php';
        
        $temp = User::getDefault();
        $unseri = $temp->unserialize($_SESSION['suser']); 
        
        //$user = User::init($unseri);
        //var_dump($user);
        //$user->display();
        echo "Login Successful!\n Welcome";
        
        ?>
    </body>
</html>
