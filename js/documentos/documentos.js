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
             var categoria = $('#select-categorias').text();
             $('.hidden-categoria').attr('value',categoria.trim());
             console.log(categoria.trim());
             $("form#subir-documento").submit();
         });
         
         $('.boton-mantenimiento-category').on('click', function(){
             var categoria = $('#categoria-modificar').text();
             $('#hidden-categoria-modificar').attr('value',categoria.trim());
             console.log(categoria.trim());
             $("form#update-categoria").submit();
         });
         
         $('#boton-modificar-fichero').on('click', function(){
             $('#action').attr('value','modificar_fichero');
         });
         
         /*$('#boton-crear-categoria').on('click', function(){
             $('#action').attr('value','crear_categoria');
         });*/

    }
);
