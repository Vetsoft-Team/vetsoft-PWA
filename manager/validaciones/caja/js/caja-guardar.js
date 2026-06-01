$(document).ready(function(){


  $('#caja-agregar').click(function(){

    let formData = new FormData();

    let total_venta = $('#total_venta').val();
    formData.append('total_venta',total_venta);

    let usuario_venta = $('#usuario_venta').val();
    formData.append('usuario_venta',usuario_venta);

    let id_ultima_venta = $('#id_ultima_venta').val();
    formData.append('id_ultima_venta',id_ultima_venta);


    if (usuario_venta == '') {
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
       title: 'Ingresa el nombre del doctor'
     });

    }else{

      $.ajax({
        url: 'validaciones/caja/caja-guardar',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
          parseInt(data);


        //REGISTRO CORRECTO
        if (data==0) {

          const Toast = Swal.mixin({
           toast: true,
           position: 'top-end',
           showConfirmButton: false,
           timer: 1000,
           timerProgressBar: true,
           didOpen: (toast) => {
             toast.addEventListener('mouseenter', Swal.stopTimer)
             toast.addEventListener('mouseleave', Swal.resumeTimer)
           }
         })

          Toast.fire({
           type: 'success',
           title: 'Venta registrada con exito'
         }).then(function() {
          window.location = "ventas/"+id_ultima_venta;
        });
       }
        //REGISTRO CORRECTO
        

        //CUENTA INCORRECTA
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
           type: 'error',
           title: 'Información registrada con errores'
         });
        }
        //CUENTA INCORRECTA

      }
    });
    }
  });
});

