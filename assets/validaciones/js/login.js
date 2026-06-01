$(document).ready(function(){


  $('#login').click(function(){

    let formData = new FormData();

    let correo = $('#correo').val();
    formData.append('correo',correo);
    
    let clave = $('#clave').val();
    formData.append('clave',clave);

    if (correo == '') {
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
       title: 'Ingresa tu correo electrónico'
     });

    }else if($("#correo").val().indexOf('@', 0) == -1 || $("#correo").val().indexOf('.', 0) == -1){
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
       title: 'Ingresa un correo electrónico valido'
     });    

    }else if (clave == '') {
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
       title: 'Ingresa tu contraseña'
     }); 

    }else{

      $.ajax({
        url: 'assets/validaciones/login',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
          parseInt(data);

          //LOGIN ADMIN
          if (data==1) {

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
             type: 'success',
             title: 'Iniciando sesión'
           }).then(function() {
            window.location = "manager/";
          });

         }
        //LOGIN ADMIN


        //LOGIN USUARIO
        else if (data==2) {

          const Toast = Swal.mixin({
           toast: true,
           position: 'top-end',
           showConfirmButton: false,
           timer: 800,
           timerProgressBar: true,
           didOpen: (toast) => {
             toast.addEventListener('mouseenter', Swal.stopTimer)
             toast.addEventListener('mouseleave', Swal.resumeTimer)
           }
         })

          Toast.fire({
           type: 'success',
           title: 'Iniciando sesión'
         }).then(function() {
          window.location = "user/";
        });
       }
        //LOGIN USUARIO


         //CUENTA INACTIVA
         else if (data==3) {
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
           title: 'Cuenta inactiva, comuniquese con soporte'
         }); 
        }
        //CUENTA INACTIVA


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
           title: 'Correo electrónico/Contraseña incorrectos'
         });
        }
        //CUENTA INCORRECTA

      }
    });
}
});
});

