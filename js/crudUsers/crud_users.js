function cargarUser(id,nombre,apellidos,telefono,email,nick,id_rol){
    document.getElementById("id_user").value=id;
    document.getElementById("nombre_user").value=nombre;
    document.getElementById("apellidos_user").value=apellidos; 
    document.getElementById("telefono_user").value=telefono;
    document.getElementById("email_user").value=email;
    document.getElementById("nick_user").value=nick;
    document.getElementById("id_rol").value=id_rol;
}
        

    $(document).ready(function(){
        setTimeout(function(){ $("#mensajeRegistro").fadeOut("slow"); }, 5000);
    });



