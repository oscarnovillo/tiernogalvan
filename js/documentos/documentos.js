/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
        $('.titulo-categoria').on('click',function(){
            var valor =  '.' + $(this).attr('data-category-name');
            $(valor).toggle(); 
        });

         $('#boton-upload').on('click', function(){
             var categoria = $('#select-categorias  option:selected').text();
             $('.hidden-categoria').attr('value',categoria.trim());
             $("form#subir-documento").submit();
         });
         
         $('#boton-actualizar-categoria').on('click', function(){
             var categoria = $('#categoria-modificar option:selected').text();
             $('#hidden-categoria-modificar').attr('value',categoria.trim());
             $("form#update-categoria").submit();
         });
         
         $('#boton-modificar-fichero').on('click', function(){
             $('#action').attr('value','modificar_fichero');
         });
         
         $('#btn-borrar-categoria').on('click', function(){
            var categoria = $('#select-borrar-categoria option:selected').text();
            $('#hidden-categoria-borrar').attr('value',categoria.trim());
            $("form#borrar-categoria").submit();
         });
         
          $('#boton-actualizar-documento').on('click', function(){
            var categoria = $('#select-categoria-doc-modificar option:selected').text();
            var fichero = $('#select-doc-modificar option:selected').text()
            $('#idden-categoria-borrar').attr('value',fichero.trim());
            $('#categoria-fichero').attr('value',categoria.trim());
            $("form#modificar-documento").submit();
         });
         
         $('#select-categoria-doc-modificar').on('change',fn_cargar_usuarios);

    });
function fn_cargar_usuarios(){
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
                 $notify({
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
            $notify({
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