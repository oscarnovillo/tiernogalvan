

function validarCliente(){
    var telefono_user = document.getElementById("telefono_user").value;
           
    var reg = new RegExp("^[0-9]{4-15}$");
    var error = false;           

    if(!reg.test(telefono_user)){//comprueba RegExp n_cuenta
        document.getElementById("mensajeRegistroError").innerHTML = "El teléfono está mal";
        //setTimeout(function(){ $("#mensajeRegistroError").fadeOut("slow"); }, 5000);
        error = true;
    }
    
    if(error == true){
       return false;
    }else{return true;} 
}

