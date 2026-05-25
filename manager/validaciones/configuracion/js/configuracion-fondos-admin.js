$(document).ready(function(){

    //--------------------- SELECCIONAR FOTO ---------------------
    $("#foto").on("change",function(){
      var uploadFoto = document.getElementById("foto").value;
      var foto       = document.getElementById("foto").files;
      var nav = window.URL || window.webkitURL;
      var contactAlert = document.getElementById('form_alert');

      if(uploadFoto !='')
      {
        var type = foto[0].type;
        var name = foto[0].name;
        if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
        {
          contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
          $("#img").remove();
          $(".delPhoto").addClass('notBlock');
          $('#foto').val('');
          return false;
        }else{  
          contactAlert.innerHTML='';
          $("#img").remove();
          $(".delPhoto").removeClass('notBlock');
          var objeto_url = nav.createObjectURL(this.files[0]);
          $(".prevPhoto").append("<img id='img' src="+objeto_url+">");
          $(".upimg label").remove();

        }
      }else{
        alert("No selecciono foto");
        $("#img").remove();
      }              
    });

    $('.delPhoto').click(function(){
      $('#foto').val('');
      $(".delPhoto").addClass('notBlock');
      $("#img").remove();
    });
    //--------------------- SELECCIONAR FOTO ---------------------

    $('#fondos-admin').click(function(){
      let formData = new FormData();

      let files = $('#foto')[0].files[0];
      formData.append('foto',files);

      $.ajax({
        url: 'validaciones/configuracion/configuracion-fondos-admin',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
          parseInt(data);


        //IMAGEN ENVIADO
        if (data==0) {

          Swal.fire(
            'FONDO ACTUALIZADO',
            'El nuevo fondo se actualizo correctamente',
            'success'
            ).then(function() {
              window.location = "config_fondos_admin";
            });

          }
        //IMAGEN ENVIADO


        //IMAGEN ERROR
        else if (data==1) {

          Swal.fire(
            'IMAGEN SIN CONTENIDO',
            'No has agregado una imagen para cargar',
            'info'
            )

        }
        //IMAGEN ERROR


        //IMAGEN CON ERROR
        else{

          const Toast = Swal.mixin({
           toast: true,
           position: 'top-end',
           showConfirmButton: false,
           timer: 3000,
           timerProgressBar: true,
           didOpen: (toast) => {
             toast.addEventListener('mouseenter', Swal.stopTimer)
             toast.addEventListener('mouseleave', Swal.resumeTimer)
           }
         })

          Toast.fire({
           type: 'warning',
           title: 'Sube el nuevo fondo'
         });

        }
        //IMAGEN CON ERROR

      }
    });

      
    });
  });

