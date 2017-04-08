/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var pword = document.getElementById("pword");
var uname = document.getElementById("uname");
var pwd_err = document.getElementById("passwordError");
var uname_err = document.getElementById("usernameError");

//define regex expressions
var NAME_REGEX = /^[a-zA-Z]+$/;
var PWD_REGEX = /([a-zA-Z0-9@*#!;]{5,15})$/;


function validateLogin() {
    if (!validateUsername()) {
        alert("Invalid username");
        pwd_err.innerHTML = "Invalid username";
    } else if (!validatePassword()) {
        alert("Invalid Password");
    }
}


function validatePassword() {
    //test for conformity to regex
    var valid = PWD_REGEX.test(pword.value) && pword.value !== "";
    if (!valid) {
        pword.style.borderColor = "red";
    }
    return valid;
}

function validateUsername() {
    var valid = false;
    if (uname.value === '' || !NAME_REGEX.test(uname.value)) {
        uname.style.borderColor = "red";
    } else {
        valid = true;
        uname.style.borderColor = "";
    }
    return valid;
}