<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<title>Class Project 2017</title>  
	<link rel="stylesheet" href="../css/loginstyle.css">  
</head>

<body>
    <?php 
    
    if(isset($_SESSION['umessage']) || isset($_SESSION['pmessage'])){
        $uMessage = $_SESSION['umessage'];
        $pMessage = _SESSION['umessage'];
    }
    
    //include_once 'loginController.php';
    
    ?>
	<div class="container">  
            <form id="contact" action="loginController.php" method="post">
			<center><h2>Login</h2></center>
			<fieldset>
                            <input placeholder="Username" id="uname" name="uname" type="text" tabindex="1" required autofocus onblur="validateUsername()">
                            <span id="usernameError"><?php if(isset($uMessage) && !empty($uMessage)){echo $uMessage;} ?></span>
			</fieldset>
			<fieldset>
                            <input placeholder="Password" id="pword" name="pwd" type="password" tabindex="2" required onblur="validatePassword()">
                            <span id="passwordError"><?php if(isset($pMessage) && !empty($pMessage)){echo $pMessage;} ?></span>
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
