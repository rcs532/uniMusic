function validate(){
    
    let inputCorreo = document.getElementById("c_email");
    const expresionMail  = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    let pass = document.getElementById("c_pass");
    let confirmPass = document.getElementById("confirm-password");


    inputCorreo.addEventListener("textInput",revisar);
    confirmPass.addEventListener("textInput",revisarPass);

    if(!expresionMail.test(inputCorreo.value)){
        inputCorreo.style.border = "3px solid red";
        alert("Ingresar un correo valido");
        return false;
    }else if(pass.value != confirmPass.value){
        pass.style.border = "3px solid red";
        confirmPass.style.border = "3px solid red";
        alert("Passwords dont match");
        return false;
    }

}

function revisar(event){
    
    if(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(event.target.value)){
        event.target.style.border = "3px solid green";
        return true;
    }
}

function revisarPass(event){
    if(event.target.value == document.getElementById("c_pass").value){
        event.target.style.border = "3px solid green";
        document.getElementById("c_pass").style.border = "3px solid green";
        return true;
    }
}

