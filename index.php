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
        //verify login
        require_once dirname(__FILE__).'/settings/core.php';
        verify_login();
        
        require_once dirname(__FILE__).'/classes/User.php';
        $temp = User::getDefault();
        //unserialise user data
        $unseri = $temp->unserialize($_SESSION['suser']); 
        //replicate user
        $user = User::init($unseri);
        //var_dump($unseri);
        $user->display();
        getHeader($user->per_id);
        echo "Login Successful!\n Welcome";
        
        ?>
    </body>
</html>
