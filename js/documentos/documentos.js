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
             $('#action').attr('value','upload_file');
         });
         
         
         $('#boton-modificar-categoria').on('click', function(){
             $('#action').attr('value','modificar_categoria');
         });
         
         $('#boton-modificar-fichero').on('click', function(){
             $('#action').attr('value','modificar_fichero');
         });
         
         $('#boton-crear-categoria').on('click', function(){
             $('#action').attr('value','crear-categoria');
         });

    }
);
