$(document).ready(function(){


  $('#configuracion-copyright').click(function(){

    let formData = new FormData();

    let pie_pagina = $('#pie_pagina').val();
    formData.append('pie_pagina',pie_pagina);

    if (pie_pagina == '') {
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
       title: 'Ingresa el nombre del copyright'
     });

    }else{

      $.ajax({
        url: 'validaciones/configuracion/configuracion-copyright',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
          parseInt(data);

        //EDITADO CORRECTO
        if (data==0) {

          Swal.fire(
            'Copyright actualizado con exito',
            '',
            'success'
            ).then(function() {
              window.location = "config_copyright";
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

