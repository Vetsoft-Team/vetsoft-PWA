$(document).ready(function(){

  $('#visitas-editar').click(function(){

    let formData = new FormData();

    let id_visita = $('#id_visita').val();
    formData.append('id_visita',id_visita);

    let id_mascota = $('#id_mascota').val();
    formData.append('id_mascota',id_mascota);

    let motivo_v = $('#motivo_v').val();
    formData.append('motivo_v',motivo_v);

    let peso_v = $('#peso_v').val();
    formData.append('peso_v',peso_v);

    let tipo_peso_v = $('#tipo_peso_v').val();
    formData.append('tipo_peso_v',tipo_peso_v);

    let temperatura_v = $('#temperatura_v').val();
    formData.append('temperatura_v',temperatura_v);

    let diagnostico_v = $('#diagnostico_v').val();
    formData.append('diagnostico_v',diagnostico_v);

    let sintomas_v = $('#sintomas_v').val();
    formData.append('sintomas_v',sintomas_v);

    let medicinas_aplicadas_v = $('#medicinas_aplicadas_v').val();
    formData.append('medicinas_aplicadas_v',medicinas_aplicadas_v);

    let visita_proxima_v = $('#visita_proxima_v').val();
    formData.append('visita_proxima_v',visita_proxima_v);

    let motivo_proximo_v = $('#motivo_proximo_v').val();
    formData.append('motivo_proximo_v',motivo_proximo_v);


    if (motivo_v == '') {

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
       title: 'Ingresa el motivo de la visita'
     });

    }else if (peso_v == '') {

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
       title: 'Ingresa el peso'
     });

    }else if (temperatura_v == '') {

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
       title: 'Ingresa la temperatura'
     });

    }else if (diagnostico_v == '') {

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
       title: 'Ingresa el diagnostico y tratamiento'
     });

    }else if (sintomas_v == '') {

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
       title: 'Ingresa los sintomas'
     });

    }else if (medicinas_aplicadas_v == '') {

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
       title: 'Ingresa las medicinas o productos aplicados'
     });

    }else if (visita_proxima_v == '') {

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
       title: 'Ingresa la fecha de la proxima visita'
     });

    }else if (motivo_proximo_v == '') {

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
       title: 'Ingresa el motivo de la proxima visita'
     });


    }else{
     $.ajax({
      url: 'validaciones/visitas/visitas-editar',
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
           title: 'Visita actualizada'
         }).then(function() {
          window.location = "visitas/"+id_visita+"/"+id_mascota;
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

