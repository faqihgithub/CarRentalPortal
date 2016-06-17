
function password(event) {
    'use strict';
    var cPass = event.currentTarget;
    var error = document.getElementById(cPass.id + "_error");
    var empty = cPass.value;
    
    //var pos1 = empty.search(/\s/g);
    var pos2 = empty.search(/.{6,}/g);
    ///var pos3 = empty.search(/\W/g);
    
    if (empty === null || empty === "") {
        error.innerHTML = "Type in a password";
        error.className = "error";
    } else {
        if (pos2 === -1) {
            error.innerHTML = "Please enter a valid password & at least 6 digits";
            error.className = "error";
        } else {
            error.innerHTML = "";
        }
    }
}

//--------------------
function vpass(event) {
    'use strict';
    var cPass = event.currentTarget;
    var error = document.getElementById(cPass.id + "_error");
    var vPass = document.getElementById("passw").value;
    
    if (cPass.value !== vPass) {
        error.innerHTML = "Password confirmation does not match the password";
        error.className = "error";
    } else {
        error.innerHTML = "";
    }
}