$(document).ready(function(){


  $('#configuracion-titulo').click(function(){

    let formData = new FormData();

    let titulo = $('#titulo').val();
    formData.append('titulo',titulo);

    if (titulo == '') {
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
       title: 'Ingresa el nombre del titulo'
     });

    }else{

      $.ajax({
        url: 'validaciones/configuracion/configuracion-titulo',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
          parseInt(data);

        //EDITADO CORRECTO
        if (data==0) {

          Swal.fire(
            'Titulo actualizado con exito',
            '',
            'success'
            ).then(function() {
              window.location = "config_titulo";
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

