/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
        var correcto = $('#success-message').val();
        if(correcto != null){
            $.notify({
                    message:correcto
                },{
                    type: 'success',
                    placement:{
                        from: 'bottom',
                        align: 'right'
                    },
                    z_index:2000
                });
        }
        var error = $('#error-message').val();
        if(error != null){
            $.notify({
                    message:error
                },{
                    type: 'danger',
                    placement:{
                        from: 'bottom',
                        align: 'right'
                    },
                    z_index:2000
                });
        }
        
            
        $('.titulo-categoria').on('click',function(){
            var valor =  '.' + $(this).attr('data-category-name');
            var estado = $(this).attr('data-category-status');
            var estadoCarpeta = $(this).attr('data-estado');
            var folder_id = 'folder-'+$(this).attr('data-category-name');
            if(estadoCarpeta == 'cerrado'){
                $('#'+folder_id).removeAttr('class');
                $('#'+folder_id).attr('class','fa fa-folder-open');
                $(this).removeAttr('data-estado');
                $(this).attr('data-estado','abierto');  
            }else if(estadoCarpeta=='abierto'){
                $('#'+folder_id).removeAttr('class');
                $('#'+folder_id).attr('class','fa fa-folder');
                $(this).removeAttr('data-estado');
                $(this).attr('data-estado','cerrado');  
            }
            if(estado == 'empty'){
                $.notify({
                    message:'Esta categoria esta vacia'
                },{
                    type: 'info',
                    placement:{
                        from: 'bottom',
                        align: 'right'
                    },
                    z_index:2000
                });
            }
            $(valor).toggle(); 
        });
        $('#boton-crear-categoria').on('click', function(){
             if(fn_comprobar_datos_forms('input-crear-categoria')){
                $("form#crear-categoria").submit();
            }else{
                $.notify({
                    message:'Indique el nombre de la categoria'
                },{
                    type: 'danger',
                    placement:{
                        from: 'bottom',
                        align: 'right'
                    },
                    z_index:2000
                });
            }
         });
         $('#boton-upload').on('click', function(){
             var categoria = $('#select-categorias  option:selected').text();
             $('.hidden-categoria').attr('value',categoria.trim());
             if(fn_comprobar_datos_forms('input-subir-doc')){
                $("form#subir-documento").submit();
            }else{
                $.notify({
                    message:'Seleccione una categoria y el fichero a subir'
                },{
                    type: 'danger',
                    placement:{
                        from: 'bottom',
                        align: 'right'
                    },
                    z_index:2000,
                });
            }
         });
         
         $('#boton-actualizar-categoria').on('click', function(){
             var categoria = $('#categoria-modificar option:selected').text();
             $('#hidden-categoria-modificar').attr('value',categoria.trim());
            
             if(fn_comprobar_datos_forms('input-modificar-category')){
                 $("form#update-categoria").submit();
            }else{
                $.notify({
                    message:'Faltan datos sobre los que actualizar, rellene los campos'
                },{
                    type: 'danger',
                    placement:{
                        from: 'bottom',
                        align: 'right'
                    },
                    z_index:2000,
                });
            }
         });
         
        
         
         $('#btn-borrar-categoria').on('click', function(){
            var categoria = $('#select-borrar-categoria option:selected').text();
            $('#hidden-categoria-borrar').attr('value',categoria.trim());
            
            if(fn_comprobar_datos_forms('input-borrar-category')){
                $("form#borrar-categoria").submit();
            }else{
                $.notify({
                    message:'Faltan datos sobre los que actualizar, rellene los campos'
                },{
                    type: 'danger',
                    placement:{
                        from: 'bottom',
                        align: 'right'
                    },
                    z_index:2000,
                });
            }
         });
         
          $('#boton-actualizar-documento').on('click', function(){
            var categoria = $('#select-categoria-doc-modificar option:selected').text();
            var fichero = $('#select-doc-modificar option:selected').text()
            $('#documento_antiguo').attr('value',fichero.trim());
            $('#categoria-fichero').attr('value',categoria.trim());
            if(fn_comprobar_datos_forms('input-actualizar-doc')){
                $("form#modificar-documento").submit();
            }else{
                $.notify({
                    message:'Faltan datos sobre los que actualizar, rellene los campos'
                },{
                    type: 'danger',
                    placement:{
                        from: 'bottom',
                        align: 'right'
                    },
                    z_index:2000,
                });
            }

         });
         
          $('#boton-borrar-documento').on('click', function(){
            var categoria = $('#select-categoria-doc-borrar option:selected').text();
            var fichero = $('#select-doc-borrar option:selected').text()
            $('#documento_antiguo_borrar').attr('value',fichero.trim());
            $('#categoria-fichero_borrar').attr('value',categoria.trim());
            
            if(fn_comprobar_datos_forms('input-delete-doc')){
                $("form#borrar-documento").submit();
            }else{
                $.notify({
                    message:'Faltan datos sobre los que actualizar, rellene los campos'
                },{
                    type: 'danger',
                    placement:{
                        from: 'bottom',
                        align: 'right'
                    },
                    z_index:2000,
                });
            }
         });
         
         $('#select-categoria-doc-modificar').on('change',fn_cargar_documentos_modificar);
         $('#select-categoria-doc-borrar').on('change',fn_cargar_documentos_borrar);

    });
function fn_cargar_documentos_modificar(){
    var categoria = $('#select-categoria-doc-modificar').val();
    $.ajax({
        url:'index.php?c=documentos&a=doc_categoria&idcategoria='+categoria,
        type: 'GET',
        
        success:function(data){
            var datos =JSON.parse(data)
            if(!datos.includes("Error")){
                   $("#select-doc-modificar").empty();
                $("#select-doc-modificar").append("<option value=''>---Seleccione un documento---</option>");
                for(var dato in datos){
                    $("#select-doc-modificar").append("<option value='"+datos[dato].idDocumentos+"'>"+datos[dato].Documento+"</option>");
                }
             }else{
                 $.notify({
                message:'Se producjo un error al cargar los documentos de la categoria'
            },{
                type: 'danger',
                placement:{
                    from: 'bottom',
                    align: 'right'
                },
                z_index:2000,
            });
             }
            //referscar select
        },
        error:function(data){
            $.notify({
                message:'Se producjo un error al cargar los documentos de la categoria'
            },{
                type: 'danger',
                placement:{
                    from: 'bottom',
                    align: 'right'
                },
                z_index:2000,
            });
        }
    });
}

function fn_cargar_documentos_borrar(){
    var categoria = $('#select-categoria-doc-borrar').val();
    $.ajax({
        url:'index.php?c=documentos&a=doc_categoria&idcategoria='+categoria,
        type: 'GET',
        
        success:function(data){
            var datos =JSON.parse(data)
            if(!datos.includes("Error")){
                   $("#select-doc-borrar").empty();
                $("#select-doc-borrar").append("<option value=''>---Seleccione un documento---</option>");
                for(var dato in datos){
                    $("#select-doc-borrar").append("<option value='"+datos[dato].idDocumentos+"'>"+datos[dato].Documento+"</option>");
                }
             }else{
                 $.notify({
                message:'Se producjo un error al cargar los documentos de la categoria'
            },{
                type: 'danger',
                placement:{
                    from: 'bottom',
                    align: 'right'
                },
                z_index:2000,
            });
             }
            //referscar select
        },
        error:function(data){
            $.notify({
                message:'Se producjo un error al cargar los documentos de la categoria'
            },{
                type: 'danger',
                placement:{
                    from: 'bottom',
                    align: 'right'
                },
                z_index:2000,
            });
        }
    });
}

function fn_comprobar_datos_forms(form){
    var comp= true;
    $('.'+form).each(function( index ) {
        var valor =  $(this).val();
        
        if(valor == ""){
            return comp = false;
        }
    });
    return comp;
}