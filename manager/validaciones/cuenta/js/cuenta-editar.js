$('#cuenta-detalle').click(function() {

  let nombre = $('#nombre').val();

  let apellidos = $('#apellidos').val();

  let correo = $('#correo').val();

  let telefono = $('#telefono').val();


  if (nombre == '') {
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
     title: 'Ingresa el nombre'
   });

  }else if (apellidos == '') {
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
     title: 'Ingresa los apellidos'
   });

  }else if (correo == '') {
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
     title: 'Ingresa la correo'
   });

  }else if($("#correo").val().indexOf('@', 0) == -1 || $("#correo").val().indexOf('.', 0) == -1){
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
     title: 'Ingresa un correo electrónico valido'
   });    

  }else if (telefono == '') {
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
     title: 'Ingresa el telefono'
   });

  }else{
    $.ajax({
      type: 'POST',
      url: 'validaciones/cuenta/cuenta-editar',
      data: {nombre: nombre, apellidos: apellidos, correo: correo, telefono: telefono},
      success: function(data){

        //EDITADO CORRECTO
        if (data==0) {

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
           type: 'success',
           title: 'Información actualizada'
         }).then(function() {
          window.location = "cuenta";
        });
       }
    //EDITADO CORRECTO

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
       title: 'Actualización erronea'
     });
    }



  },
});
  }
});