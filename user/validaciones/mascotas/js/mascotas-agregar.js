 $(document).ready(function(){

  $('#fecha').on('change', function(){
    $('#edad').val(Calcular_Edad());
  });
  
  
  function Calcular_Edad()
  {
    var fecha_seleccionada = $('#fecha').val();
    var fecha_nacimiento = new Date(fecha_seleccionada);
    var fecha_Actual = new Date();
    var edad = (parseInt((fecha_Actual - fecha_nacimiento) / (1000*60*60*24*365)));
    return edad;
  }



      //--------------------- SELECCIONAR FOTO ---------------------
      $("#foto").on("change",function(){
        var uploadFoto = document.getElementById("foto").value;
        var foto       = document.getElementById("foto").files;
        var nav = window.URL || window.webkitURL;
        var contactAlert = document.getElementById('form_alert');

        if(uploadFoto !='')
        {
          var type = foto[0].type;
          var name = foto[0].name;
          if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
          {
            contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
            $("#img").remove();
            $(".delPhoto").addClass('notBlock');
            $('#foto').val('');
            return false;
          }else{  
            contactAlert.innerHTML='';
            $("#img").remove();
            $(".delPhoto").removeClass('notBlock');
            var objeto_url = nav.createObjectURL(this.files[0]);
            $(".prevPhoto").append("<img id='img' src="+objeto_url+">");
            $(".upimg label").remove();

          }
        }else{
          alert("No selecciono foto");
          $("#img").remove();
        }              
      });

      $('.delPhoto').click(function(){
        $('#foto').val('');
        $(".delPhoto").addClass('notBlock');
        $("#img").remove();
      });
    //--------------------- SELECCIONAR FOTO ---------------------

    $('#mascotas-agregar').click(function(){

      let formData = new FormData();

      let files = $('#foto')[0].files[0];
      formData.append('foto',files);

      let nombre = $('#nombre').val();
      formData.append('nombre',nombre);

      let fecha_nacimiento = $('#fecha_nacimiento').val();
      formData.append('fecha_nacimiento',fecha_nacimiento);

      let edad = $('#edad').val();
      formData.append('edad',edad);

      let raza = $('#raza').val();
      formData.append('raza',raza);

      let especie = $('#especie').val();
      formData.append('especie',especie);

      let color = $('#color').val();
      formData.append('color',color);

      let sexo = $('#sexo').val();
      formData.append('sexo',sexo);

      let peso = $('#peso').val();
      formData.append('peso',peso);

      let tipo_peso = $('#tipo_peso').val();
      formData.append('tipo_peso',tipo_peso);


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

      }else if (fecha_nacimiento == '') {
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
         title: 'Ingresa la fecha de fecha nacimiento'
       });

      }else if (edad == '') {
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
         title: 'Ingresa la edad'
       });

      }else if (raza == '') {
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
         title: 'Ingresa la raza'
       });

      }else if (especie == '') {
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
         title: 'Ingresa la especie'
       });

      }else if (color == '') {
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
         title: 'Ingresa el color'
       });

      }else if (sexo == '') {
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
         title: 'Ingresa el tipo de sexo'
       });

      }else if (peso == '') {
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

      }else if (tipo_peso == '') {
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
         title: 'Ingresa el tipo de peso'
       });

      }else{

        $.ajax({
          url: 'validaciones/mascotas/mascotas-agregar',
          type: 'post',
          data: formData,
          contentType: false,
          processData: false,
          success: function(data) {
            parseInt(data);

        //AGREGADO CORRECTO
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
           title: 'Solicitud de nueva mascota enviada'
         }).then(function() {
          window.location = "mascotas";
        });

       }
        //AGREGADO CORRECTO


        //IMAGEN ERROR
        else if (data==1) {

          Swal.fire(
            'IMAGEN SIN CONTENIDO',
            'No has agregado una imagen para cargar',
            'info'
            )

        }
        //IMAGEN ERROR


        //IMAGEN CON ERROR
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
           type: 'warning',
           title: 'Sube la imagen de la mascota'
         });

        }
        //IMAGEN CON ERROR


      }
    });
      }


    });
});

