<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title>Class Project 2017</title>  
        <link rel="stylesheet" href="../css/loginstyle.css">  
    </head>

    <body>
        <?php
        $GLOBALS['pwdMessage'] = $GLOBALS['uMessage'] = $GLOBALS['username'] = '';
        if (isset($GLOBALS['uMessage'])) {
            $uMessage = $GLOBALS['uMessage'];
        }
        if (isset($GLOBALS['pwdMessage'])) {
            $pMessage = $GLOBALS['pwdMessage'];
            $username = $GLOBALS['username'];
        }

        //include_once 'loginController.php';
        ?>
        <div class="container">  
            <form id="contact" action="loginController.php" method="post">
                <center><h2>Login</h2></center>
                <fieldset>
                    <input placeholder="Username" id="uname" name="uname" type="text" tabindex="1" required <?php if (empty($pMessage)) { ?> autofocus <?php } ?> onblur="validateUsername()" value="<?php
        if (!empty($pMessage)) {
            echo $username;
        }
        ?>">
                    <span id="usernameError" style="color: red">
                        <?php
                        if (isset($uMessage) && !empty($uMessage)) {
                            echo $uMessage;
                        }
                        ?>
                    </span>
                </fieldset>
                <fieldset>
                    <input placeholder="Password" id="pword" name="pwd" type="password" tabindex="2" required onblur="validatePassword()" <?php if (isset($pMessage) && !empty($pMessage)) { ?> autofocus <?php } ?>>
                    <span id="passwordError" style="color: red">
                        <?php
                        if (isset($pMessage) && !empty($pMessage)) {
                            echo $pMessage;
                        }
                        ?>
                    </span>
                </fieldset>

                <fieldset>
                    <button name="submit" type="submit" id="loginSubmit" data-submit="...Sending" onclick="return validateLogin()">Submit</button>
                </fieldset>

            </form>
        </div>

        <!-- load javascript -->
        <script type="text/javascript" src="../js/login_validation.js"></script>
    </body>
</html>
