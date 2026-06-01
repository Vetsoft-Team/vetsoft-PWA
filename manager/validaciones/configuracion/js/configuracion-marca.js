$(document).ready(function(){


  $('#configuracion-marca').click(function(){

    let formData = new FormData();

    let marca = $('#marca').val();
    formData.append('marca',marca);

    if (marca == '') {
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
       title: 'Ingresa el nombre de la marca'
     });

    }else{

      $.ajax({
        url: 'validaciones/configuracion/configuracion-marca',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
          parseInt(data);

        //EDITADO CORRECTO
        if (data==0) {

          Swal.fire(
            'Marca actualizada con exito',
            '',
            'success'
            ).then(function() {
              window.location = "config_marca";
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

