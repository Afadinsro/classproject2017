<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<title>Class Project 2017</title>  
	<link rel="stylesheet" href="../css/loginstyle.css">  
</head>

<body>
	<div class="container">  
            <form id="contact" action="loginController.php" method="post">
			<center><h2>Login</h2></center>
			<fieldset>
                            <input placeholder="Username" name="uname" type="text" tabindex="1" required autofocus>
			</fieldset>
			<fieldset>
                            <input placeholder="Password" name="pwd" type="password" tabindex="2" required>
			</fieldset>
			
			<fieldset>
				<button name="submit" type="submit" id="loginSubmit" data-submit="...Sending">Submit</button>
			</fieldset>

		</form>
	</div>


</body>
</html>
