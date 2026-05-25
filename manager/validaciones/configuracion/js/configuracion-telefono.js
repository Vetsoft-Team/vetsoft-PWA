$(document).ready(function(){


  $('#configuracion-telefono').click(function(){

    let formData = new FormData();

    let telefono = $('#telefono').val();
    formData.append('telefono',telefono);

    if (telefono == '') {
      const Toast = Swal.mixin({
       toast: true,
       position: 'top-end',
       showConfirmButton: false,
       timer: 2000,
       timerProgressBar: true,
       didOpen: (toast) => {
         toast.addEventListener('mouseenter', Swal.stopTimer)
         toast.addEventListener('mouseleave', Swal.resumeTimer)
       }
     })

      Toast.fire({
       type: 'warning',
       title: 'Ingresa el numero de telefono'
     });

    }else{

      $.ajax({
        url: 'validaciones/configuracion/configuracion-telefono',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
          parseInt(data);

        //EDITADO CORRECTO
        if (data==0) {

          Swal.fire(
            'Telefono actualizado con exito',
            '',
            'success'
            ).then(function() {
              window.location = "config_telefono";
            });

          }
        //EDITADO CORRECTO

        else{

         Swal.fire(
          'Error al actualizar',
          '',
          'success'
          );

       }


     }
   });
    }
  });
});

