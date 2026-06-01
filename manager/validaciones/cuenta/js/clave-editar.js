$('#clave-detalle').click(function() {

  let clave_actual = $('#clave_actual').val();

  let clave_nueva = $('#clave_nueva').val();

  let clave_nueva_r = $('#clave_nueva_r').val();


  if (clave_actual == '') {
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
     title: 'Ingresa la contraseña actual'
   });

  }else if (clave_nueva == '') {
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
     title: 'Ingresa la nueva contraseña'
   });

  }else if (clave_nueva_r == '') {
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
     title: 'Repite la nueva contraseña'
   });

  }else{
    $.ajax({
      type: 'POST',
      url: 'validaciones/cuenta/clave-editar',
      data: {clave_actual: clave_actual, clave_nueva: clave_nueva, clave_nueva_r: clave_nueva_r},
      success: function(data){

            //ERROR
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
               type: 'warning',
               title: 'Su contraseña actual es incorrecta'
             });
            }
          //ERROR


           //ERROR
           else if (data==1) {

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
             title: 'Sus contraseñas no son iguales'
           });
          }
          //ERROR


         //EDITADO CORRECTO
         else if (data==2) {

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
           title: 'Su contraseña se actualizo con exito'
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
           title: 'Datos incorrectos'
         });
        }



      },
    });
  }
});