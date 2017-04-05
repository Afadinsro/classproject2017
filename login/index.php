<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<title>Class Project 2017</title>  
	<link rel="stylesheet" href="../css/loginstyle.css">  
</head>

<body>
    <?php 
    session_start();
    if(isset($_SESSION['error'])){
        echo $_SESSION['error'];
    }
        
    
    ?>
	<div class="container">  
            <form id="contact" action="loginController.php" method="post">
			<center><h2>Login</h2></center>
			<fieldset>
                            <input placeholder="Username" id="uname" name="uname" type="text" tabindex="1" required autofocus onblur="validateUsername()">
                            <span id="usernameError"></span>
			</fieldset>
			<fieldset>
                            <input placeholder="Password" id="pword" name="pwd" type="password" tabindex="2" required onblur="validatePassword()">
                            <span id="passwordError"></span>
			</fieldset>
			
			<fieldset>
                            <button name="submit" type="submit" id="loginSubmit" data-submit="...Sending" onclick="return validateLogin()">Submit</button>
			</fieldset>

		</form>
	</div>

    <!-- load javascript -->
    <script type="text/javascript" src="../js/registration_validation.js"></script>
</body>
</html>
