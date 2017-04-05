/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var email = document.getElementById("email");
var pword = document.getElementById("pword");
var uname = document.getElementById("uname");
var fname = document.getElementById("fname");
var lname = document.getElementById("lname");
var genderSelect = document.getElementById("genderSelect");
var majorSelect = document.getElementById("majorSelect");

//define regex expressions
var NAME_REGEX = /^[a-zA-Z]+$/;
var PWD_REGEX = /([a-zA-Z0-9@*#!;]{8,15})$/;
var EMAIL_REGEX = /^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$/;

function validateRegistration(){
    if(!validateUsername()){
        alert("Invalid username");
    } else if (!validateFname()){
        alert("Invalid first name");
    }else if (!validateLname()){
        alert("Invalid last name");
    }else if (!validatePassword()){
        alert("Invalid Password");
    }else if (!validateEmail()){
        alert("Invalid email");
    }else if (!validateGender()){
        alert("Invalid gender");
    }else if (!validateMajor()){
        alert("Invalid Email");
    }
}

function validateUsername(){
    var valid = false;
    if(uname.value === '' || !NAME_REGEX.test(uname.value)){
        uname.style.borderColor = "red";
    }else{
        valid = true;
        uname.style.borderColor = "green";
    }
    return valid;
}

function validateFname(){
    var valid = false;
    if(fname.value === '' || !NAME_REGEX.test(fname.value)){
        fname.style.borderColor = "red";
    }else{
        valid = true;
        fname.style.borderColor = "green";
    }
    return valid;
}

function validateLname(){
    var valid = false;
    if(lname.value === '' || !NAME_REGEX.test(lname.value)){
        lname.style.borderColor = "red";
    }else{
        valid = true;
        lname.style.borderColor = "green";
    }
    return valid;
}


function validateEmail(){
    //test for conformity to regex
    var valid = EMAIL_REGEX.test(email.value);
    if(valid){
        email.style.borderColor = "green";
    }else{
        email.style.borderColor = "red";
    }
    return valid;
}

function validatePassword(){
    //test for conformity to regex
    var valid = PWD_REGEX.test(pword.value);
    if(valid){
        pword.style.borderColor = "green";
    }else{
        pword.style.borderColor = "red";
    }
    return valid;
}

function validateMajor(){
    var major = majorSelect.value;
    var valid = false;
    if(major === "Select a major..."){
        majorSelect.style.borderColor = 'red';
    }else{
        majorSelect.style.borderColor = "green";
        valid = true;
    }
    return valid;
}

function validateGender(){
    var gender = genderSelect.value;
    var valid = false;
    if(gender === "Gender.."){
        genderSelect.style.borderColor = 'red';
    }else{
        genderSelect.style.borderColor = "green";
        valid = true;
    }
    return valid;
}

