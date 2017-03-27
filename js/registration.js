/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var email = document.getElementById("email");
var PWD_REGEX = /^([a-zA-Z0-9@*#]{8,15})$/;
var EMAIL_REGEX = /^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$/;

function validateForm(){
    
}


function validateEmail(){
    //test for conformity to regex
    var valid = EMAIL_REGEX.test(email.value);
    if(valid){
        email.style.border = "1px solid lightgreen";
    }else{
        email.style.border = "1px solid red";
    }
}

function validatePassword(){
    
}