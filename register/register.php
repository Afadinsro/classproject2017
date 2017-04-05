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
                    <span id="usernameError"></span>
                </fieldset>
                <fieldset>
                    <input placeholder="Password" id="pword" name="pword" type="password" tabindex="2" required onblur="validatePassword()">
                    <span id="passwordError"></span>
                </fieldset>
                <fieldset>
                    <input placeholder="First name" id="fname" name="fname" type="text" tabindex="3" required onblur="validateFname()">
                    <span id="fnameError"></span>
                </fieldset>
                <fieldset>
                    <input placeholder="Last name" id="lname" name="lname" type="text" tabindex="4" required onblur="validateLname()">
                    <span id="lnameError"></span>
                </fieldset>
                <fieldset>
                    <input placeholder="Email" id="email" name="email" type="email" tabindex="5" required onblur="validateEmail()">
                    <span id="emailError"></span>
                </fieldset>
                <fieldset>
                    <select name="gender" id="genderSelect" onblur="validateGender()">
                        <option>Gender..</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                    <span id="genderError"></span>
                </fieldset>

                <fieldset>
                    <select name="major" id="majorSelect" onblur="validateMajor()">
                        <option>Select a major...</option>
                        <!-- Load from database -->
                        <?php include '../unsecure/load_majors.php'; ?>
                    </select>
                    <span id="majorError"></span>
                </fieldset>

                <fieldset>
                    <button name="submit" type="submit" id="registerSubmit" data-submit="...Sending" 
                            onclick="return validateRegistration()">Submit</button>
                </fieldset>

            </form>
        </div>


        <!-- load javascript -->
        <script type="text/javascript" src="../js/registration_validation.js"></script>
    </body>
</html>