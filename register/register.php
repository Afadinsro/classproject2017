<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <meta charset="UTF-8"> 
        <link rel="stylesheet" href="../css/loginstyle.css">
    </head>


    <body>
        <div class="container">  
            <form id="contact" action="registerController.php" method="post">
                <center><h2>Register</h2></center>
                <fieldset>
                    <input placeholder="Username" id="uname" name="uname" type="text" tabindex="1" required autofocus onblur="validateUsername()">
                </fieldset>
                <fieldset>
                    <input placeholder="Password" id="pword" name="pword" type="password" tabindex="2" required onblur="validatePassword()">
                </fieldset>
                <fieldset>
                    <input placeholder="First name" id="fname" name="fname" type="text" tabindex="3" required onblur="validateFname()">
                </fieldset>
                <fieldset>
                    <input placeholder="Last name" id="lname" name="lname" type="text" tabindex="4" required onblur="validateLname()">
                </fieldset>
                <fieldset>
                    <input placeholder="Email" id="email" name="email" type="email" tabindex="5" required onblur="validateEmail()">
                </fieldset>
                <fieldset>
                    <select name="gender" id="genderSelect">
                        <option>Gender..</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </fieldset>

                <fieldset>
                    <select name="major" id="majorSelect">
                        <option>Major...</option>
                        <!-- Load from database -->
                        <?php include 'majors_dropdown.php'; ?>
                    </select>
                </fieldset>

                <fieldset>
                    <button name="submit" type="submit" id="registerSubmit" data-submit="...Sending">Submit</button>
                </fieldset>

            </form>
        </div>


        <!-- load javascript -->
        <script type="text/javascript" src="../js/registration.js"></script>
    </body>
</html>