$(document).ready(function(){


  $('#citas-agregar').click(function(){

    let formData = new FormData();

    let id_mascota = $('#id_mascota').val();
    formData.append('id_mascota',id_mascota);

    let fecha_cita = $('#fecha_cita').val();
    formData.append('fecha_cita',fecha_cita);

    let hora_cita = $('#hora_cita').val();
    formData.append('hora_cita',hora_cita);

    let doctor_cita = $('#doctor_cita').val();
    formData.append('doctor_cita',doctor_cita);

    let motivo_cita = $('#motivo_cita').val();
    formData.append('motivo_cita',motivo_cita);


    if (fecha_cita == '') {
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
       title: 'Ingresa la fecha de la cita'
     });

    }else if (hora_cita == '') {
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
       title: 'Ingresa la hora de la cita'
     });

    }else if (doctor_cita == '') {
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
       title: 'Ingresa el doctor a asignar'
     });

    }else if (motivo_cita == '') {
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
       title: 'Ingresa el motivo de la cita'
     });

    }else{

      $.ajax({
        url: 'validaciones/citas/citas-agregar',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
          parseInt(data);

        //AGREGADO CORRECTO
        if (data==0) {

          Swal.fire(
            'Cita registrada con exito',
            '',
            'success'
            ).then(function() {
              window.location = "mascotas/"+id_mascota;
            });

          }
        //AGREGADO CORRECTO


        //AGREGADO CORRECTO
        else if (data==1) {

          Swal.fire(
            'Cita topada',
            'Ya hay una cita asignada a la misma hora y con el mismo doctor, elija otra hora o doctor',
            'info'
            );

          }
        //AGREGADO CORRECTO

        else{

         Swal.fire(
          'Cita registrada con exito',
          '',
          'success'
          ).then(function() {
            window.location = "mascotas/"+id_mascota;
          });

        }


      }
    });
    }
  });
});

