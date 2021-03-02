

function validarTarjeta(){
    var cardnumberID = document.getElementById("ccnum");
    // Strip spaces and dashes
    var cardnumberValue = cardnumberID.value.replace(/[ -]/g, '');
    // See if the card is valid
    // The regex will capture the number in one of the capturing groups
    var match = /^(?:(4[0-9]{12}(?:[0-9]{3})?)|(5[1-5][0-9]{14})|↵(6(?:011|5[0-9]{2})[0-9]{12})|(3[47][0-9]{13})|(3(?:0[0-5]|[68][0-9])↵[0-9]{11})|((?:2131|1800|35[0-9]{3})[0-9]{11}))$/;


    cardnumberID.addEventListener("textInput",revisar);

    if(!match.test(cardnumberValue)){
        cardnumberID.style.border = "3px solid red";
        alert("Ingresar tarjeta valida");
        return false;
    }



}

function revisar(event){
    
    if(/^(?:(4[0-9]{12}(?:[0-9]{3})?)|(5[1-5][0-9]{14})|↵(6(?:011|5[0-9]{2})[0-9]{12})|(3[47][0-9]{13})|(3(?:0[0-5]|[68][0-9])↵[0-9]{11})|((?:2131|1800|35[0-9]{3})[0-9]{11}))$/.test(event.target.value)){
        event.target.style.border = "3px solid green";
        return true;
    }
}