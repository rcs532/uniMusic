function validatePass(){
    
    let pass = document.getElementById("new_pass");
    let confirmPass = document.getElementById("confirm-password");


    confirmPass.addEventListener("textInput",revisarPass);

    if(pass.value != confirmPass.value){
        pass.style.border = "3px solid red";
        confirmPass.style.border = "3px solid red";
        alert("Passwords dont match");
        return false;
    }

}

function revisarPass(event){
    if(event.target.value == document.getElementById("new_pass").value){
        event.target.style.border = "3px solid green";
        document.getElementById("new_pass").style.border = "3px solid green";
        return true;
    }
}

