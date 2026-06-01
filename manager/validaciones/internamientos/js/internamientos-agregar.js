$(document).ready(function(){


  $('#internamientos-agregar').click(function(){

    let formData = new FormData();

    let id_mascota = $('#id_mascota').val();
    formData.append('id_mascota',id_mascota);

    let entrada_i = $('#entrada_i').val();
    formData.append('entrada_i',entrada_i);

    let medicinas_aplicadas_i = $('#medicinas_aplicadas_i').val();
    formData.append('medicinas_aplicadas_i',medicinas_aplicadas_i);

    let motivo_i = $('#motivo_i').val();
    formData.append('motivo_i',motivo_i);

    let antecedentes_i = $('#antecedentes_i').val();
    formData.append('antecedentes_i',antecedentes_i);

    let tratamiento_i = $('#tratamiento_i').val();
    formData.append('tratamiento_i',tratamiento_i);


    if (entrada_i == '') {
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
       title: 'Ingresa la fecha de entrada de la mascota'
     });

    }else if (medicinas_aplicadas_i == '') {
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
       title: 'Ingresa las medicinas aplicadas'
     });

    }else if (motivo_i == '') {
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
       title: 'Ingresa el motivo'
     });

    }else if (antecedentes_i == '') {
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
       title: 'Ingresa los antecedentes'
     });

    }else if (tratamiento_i == '') {
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
       title: 'Ingresa el tratamiento'
     });

    }else{

      $.ajax({
        url: 'validaciones/internamientos/internamientos-agregar',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
          parseInt(data);

        //AGREGADO CORRECTO
        if (data==0) {

          Swal.fire(
            'Internamiento registrado con exito',
            '',
            'success'
            ).then(function() {
              window.location = "mascotas/"+id_mascota;
            });

          }
        //AGREGADO CORRECTO

        else{

           Swal.fire(
            'Internamiento registrado con exito',
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

