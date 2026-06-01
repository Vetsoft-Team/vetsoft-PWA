//--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
$("#imagen").on("change",function(){
  var uploadimagen = document.getElementById("imagen").value;
  var imagen       = document.getElementById("imagen").files;
  var nav = window.URL || window.webkitURL;
  var contactAlert = document.getElementById('form_alert');

  if(uploadimagen !='')
  {
    var type = imagen[0].type;
    var name = imagen[0].name;
    if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
    {
      contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
      $("#img_principal").remove();
      $(".delPhoto_img").addClass('notBlock_img');
      $('#imagen').val('');
      return false;
    }else{  
      contactAlert.innerHTML='';
      $("#img").remove();
      $(".delPhoto_img").removeClass('notBlock_img');
      var objeto_url = nav.createObjectURL(this.files[0]);
      $(".prevPhoto_img").append("<img id='img_principal' src="+objeto_url+">");
      $(".upimg_img label").remove();

    }
  }else{
    alert("No selecciono imagen");
    $("#img_principal").remove();
  }              
});

$('.delPhoto').click(function(){
  $('#imagen').val('');
  $(".delPhoto_img").addClass('notBlock_img');
  $("#img_principal").remove();
});

function guardarImg(element){
  let inputFoto = $(element).val();
  var foto = $(element)[0].files;
  let contador = $(element).attr("group");
  var nav = window.URL || window.webkitURL;

  if(inputFoto !=''){
    var type = foto[0].type;
    var name = foto[0].name;
    if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
      $('#img').remove();
      $(`#del${contador}`).addClass('notBlock');
      $('#foto').val('');
      return false;
    }else{  
      $(`#img`).remove();
      $(`#del${contador}`).removeClass('notBlock');
      var objeto_url = nav.createObjectURL(element.files[0]);
      $(`#prev${contador}`).append(`<img class="zoom" name='${name}' id='img${contador}' src=`+objeto_url+`>`);
      $(`.upimg label`).remove();  
    }
  }else{
    alert("No selecciono foto");
    $(`img${contador}`).remove();
  }
}

function eliminarImg(element){
  let contador = $(element).attr("groupid");

  $(`.delPhoto`).click(function(){
    $(`#foto${contador}`).val('');
    $(`#del${contador}`).addClass('notBlock');
    $(`#img${contador}`).remove();
  });
}

$(document).ready(function(){

  var contador = 0;
  $('#agregar_foto').click(function(){
    contador++;
    $('.mostrar_foto').append(`
      <div class="col-sm-3">
      <center>
      <div class="form-group">
      <div class="photo">
      <label for="foto">Imagen ${contador}</label>
      <div class="prevPhoto" id="prev${contador}">
      <span class="delPhoto notBlock" groupid="${contador}" id="del${contador}" onclick="eliminarImg(this)">X</span>
      <label class="labelZoom" for="foto${contador}"></label>
      </div>
      <div class="upimg" id="up${contador}">
      <input type="file" name="foto[]" onchange="guardarImg(this)" group="${contador}" id="foto${contador}";>
      </div>
      </div>        
      </div> 
      </center>
      <br>
      </div>  
      `);
  });

  $('#imagenes-agregar').click(function(){

   arrayFoto = [];
   arrayOrden = [];

   $('.mostrar_foto').each(function(index2) {
    $('.mostrar_foto div center').each(function(index2) {
      arrayFoto.push($(this).children(".form-group").children(".photo").children("div.upimg").children("input")[0].files[0]);
      arrayOrden.push($(this).children(".form-group").children(".photo").children("div.prevPhoto").children("span").attr('groupid'));
    });
  });

   let formData = new FormData();

   let id_inventario = $('#id_inventario').val();
   formData.append('id_inventario',id_inventario);

   for(let foto of arrayFoto){
    formData.append('foto[]', foto);
  }
  for(let orden of arrayOrden){
    formData.append('groupid[]', orden);
  }

  $.ajax({
    url: 'validaciones/inventario/imagenes-agregar',
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
           title: 'Nuevas imagenes agregadas con exito'
         }).then(function() {
          window.location = "inventario/"+id_inventario;
        });
       }
        //REGISTRO CORRECTO
        

        //REGISTRO INCORRECTO
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
           title: 'Debes agregar almenos una imagen al producto'
         });
        }
       //REGISTRO INCORRECTO

     }
   });
});
});

