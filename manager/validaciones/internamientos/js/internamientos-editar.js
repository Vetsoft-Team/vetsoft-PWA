$(document).ready(function(){

  $('#internamientos-editar').click(function(){

    let formData = new FormData();

    let id_internamiento = $('#id_internamiento').val();
    formData.append('id_internamiento',id_internamiento);

    let id_mascota = $('#id_mascota').val();
    formData.append('id_mascota',id_mascota);

    let fecha_entrada = $('#fecha_entrada').val();
    formData.append('fecha_entrada',fecha_entrada);

    let fecha_salida = $('#fecha_salida').val();
    formData.append('fecha_salida',fecha_salida);

    let medicinas_aplicadas = $('#medicinas_aplicadas').val();
    formData.append('medicinas_aplicadas',medicinas_aplicadas);

    let motivo = $('#motivo').val();
    formData.append('motivo',motivo);

    let antecedentes = $('#antecedentes').val();
    formData.append('antecedentes',antecedentes);

    let tratamiento = $('#tratamiento').val();
    formData.append('tratamiento',tratamiento);


    if (fecha_entrada == '') {

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
       title: 'Ingresa la fecha de entrada'
     });

    }else if (medicinas_aplicadas == '') {

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
       title: 'Ingresa las medicinas aplicadas'
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

    }else if (antecedentes == '') {

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
       title: 'Ingresa los antecedentes'
     });

    }else if (tratamiento == '') {

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
       title: 'Ingresa el tratamiento'
     });

    }else{
     $.ajax({
      url: 'validaciones/internamientos/internamientos-editar',
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
           title: 'Internamiento actualizado'
         }).then(function() {
          window.location = "internamientos/"+id_internamiento+"/"+id_mascota;
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

