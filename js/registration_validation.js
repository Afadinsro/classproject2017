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
var PWD_REGEX = /([a-zA-Z0-9@*#!;]{8,15})$/;
var EMAIL_REGEX = /^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$/;

function validateForm(){
    
}


function validateEmail(){
    //test for conformity to regex
    var valid = EMAIL_REGEX.test(email.value);
    if(valid){
        email.style.borderColor = "green";
    }else{
        email.style.borderColor = "red";
    }
}

function validatePassword(){
    //test for conformity to regex
    var valid = PWD_REGEX.test(pword.value);
    if(valid){
        pword.style.borderColor = "green";
    }else{
        pword.style.borderColor = "red";
    }
}

function validateMajor(){
    var major = majorSelect.value;
    if(major === "Select a major..."){
        majorSelect.style.borderColor = 'red';
    }else{
        majorSelect.style.borderColor = "green";
    }
}

function validateGender(){
    var gender = genderSelect.value;
    if(gender === "Gender.."){
        genderSelect.style.borderColor = 'red';
    }else{
        genderSelect.style.borderColor = "green";
    }
}