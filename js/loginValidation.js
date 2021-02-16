function validate(){
    
    let inputCorreo = document.getElementById("email");
    const expresionMail  = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

    inputCorreo.addEventListener("textInput",revisar);

    if(!expresionMail.test(inputCorreo.value)){
        inputCorreo.style.border = "3px solid red";
        alert("Ingresar un correo valido");
        return false;
    }

}

function revisar(event){
    
    if(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(event.target.value)){
        event.target.style.border = "3px solid green";
        return true;
    }
}

