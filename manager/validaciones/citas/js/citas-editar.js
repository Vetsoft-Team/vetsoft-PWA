$(document).ready(function(){

  $('#citas-editar').click(function(){

    let formData = new FormData();

    let id_cita = $('#id_cita').val();
    formData.append('id_cita',id_cita);

    let id_mascota = $('#id_mascota').val();
    formData.append('id_mascota',id_mascota);

    let fecha_cita = $('#fecha_cita').val();
    formData.append('fecha_cita',fecha_cita);

    let hora_cita = $('#hora_cita').val();
    formData.append('hora_cita',hora_cita);

    let doctor_cita = $('#doctor_cita').val();
    formData.append('doctor_cita',doctor_cita);

    let motivo = $('#motivo').val();
    formData.append('motivo',motivo);


    if (fecha_cita == '') {

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
       title: 'Ingresa la fecha de la cita'
     });

    }else if (hora_cita == '') {

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
       title: 'Ingresa la hora de la cita'
     });

    }else if (doctor_cita == '') {

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
       title: 'Ingresa el doctor'
     });

    }else if (motivo == '') {

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
       title: 'Ingresa el motivo'
     });

    }else{
     $.ajax({
      url: 'validaciones/citas/citas-editar',
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      success: function(data) {
       parseInt(data);


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
           title: 'Cita actualizada'
         }).then(function() {
          window.location = "citas/"+id_cita+"/"+id_mascota;
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


  }
});
   }
 });
});

