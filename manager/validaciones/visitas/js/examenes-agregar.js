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
    if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png' && type != 'application/pdf')
    {
      contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
      $("#img_principal").remove();
      $(".delPhoto_img").addClass('notBlock_img');
      $('#imagen').val('');
      return false;

      contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
      $("#img_principal2").remove();
      $(".delPhoto_img2").addClass('notBlock_img2');
      $('#imagen2').val('');
      return false;
    }else{  
      contactAlert.innerHTML='';
      $("#img").remove();
      $(".delPhoto_img").removeClass('notBlock_img');
      var objeto_url = nav.createObjectURL(this.files[0]);
      $(".prevPhoto_img").append("<img id='img_principal' src="+objeto_url+">");
      $(".upimg_img label").remove();

      contactAlert.innerHTML='';
      $("#img2").remove();
      $(".delPhoto_img2").removeClass('notBlock_img2');
      var objeto_url2 = nav.createObjectURL(this.files[0]);
      $(".prevPhoto_img2").append("<img id='img_principal2' src="+objeto_url2+">");
      $(".upimg_img2 label2").remove();

    }
  }else{
    alert("No selecciono imagen");
    $("#img_principal").remove();
    $("#img_principal2").remove();
  }              
});

$('.delPhoto').click(function(){
  $('#imagen').val('');
  $(".delPhoto_img").addClass('notBlock_img');
  $("#img_principal").remove();
});

$('.delPhoto2').click(function(){
  $('#imagen2').val('');
  $(".delPhoto_img2").addClass('notBlock_img2');
  $("#img_principal2").remove();
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

function guardarImg2(element){
  let inputFoto2 = $(element).val();
  var foto2 = $(element)[0].files;
  let contador2 = $(element).attr("group2");
  var nav = window.URL || window.webkitURL;

  if(inputFoto2 !=''){
    var type = foto2[0].type;
    var name = foto2[0].name;
    if(type != 'application/pdf'){
      $('#img2').remove();
      $(`#del2${contador2}`).addClass('notBlock2');
      $('#foto2').val('');
      return false;
    }else{  
      $(`#img2`).remove();
      $(`#del2${contador2}`).removeClass('notBlock2');
      var objeto_url2 = nav.createObjectURL(element.files[0]);
      $(`#prev2${contador2}`).append(`<img class="zoom" name='${name}' id='img2${contador2}' src='../assets/img/iconos/pdf.png'>`);
      $(`.upimg2 label`).remove();  
    }
  }else{
    alert("No selecciono foto");
    $(`img2${contador2}`).remove();
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


function eliminarImg2(element){
  let contador2 = $(element).attr("groupid2");

  $(`.delPhoto2`).click(function(){
    $(`#foto2${contador2}`).val('');
    $(`#del2${contador2}`).addClass('notBlock2');
    $(`#img2${contador2}`).remove();
  });
}


$(document).ready(function(){

  var contador = 0;
  $('#agregar_imagenes').click(function(){
    contador++;
    $('.mostrar_foto').append(`
      <div class="col-sm-3">
      <center>
      <div class="form-group">
      <div class="photo">

      <label for="foto">${contador}</label>
      <div class="prevPhoto" id="prev${contador}">
      <span class="delPhoto notBlock" groupid="${contador}" id="del${contador}" onclick="eliminarImg(this)">X</span>
      <label class="labelZoom" for="foto${contador}"></label>
      </div>
      <div class="upimg" id="up${contador}">
      <input type="file" name="foto[]" onchange="guardarImg(this)" accept="image/png,image/jpeg" group="${contador}" id="foto${contador}";>
      </div>
      </div>        
      </div> 
      </center>
      <br>
      </div>  
      `);
  });


  var contador2 = 0;
  $('#agregar_pdf').click(function(){
    contador2++;
    $('.mostrar_foto2').append(`
      <div class="col-sm-3">
      <center>
      <div class="form-group">
      <div class="photo2">

      <label for="foto">${contador2}</label>
      <div class="prevPhoto2" id="prev2${contador2}">
      <span class="delPhoto2 notBlock2" groupid2="${contador2}" id="del2${contador2}" onclick="eliminarImg2(this)">X</span>
      <label class="labelZoom" for="foto2${contador2}"></label>
      </div>
      <div class="upimg2" id="up${contador2}">
      <input type="file" name="foto2[]" onchange="guardarImg2(this)" accept="application/pdf" group2="${contador2}" id="foto2${contador2}";>
      </div>
      </div>        
      </div> 
      </center>
      <br>
      </div>  
      `);
  });

  $('#examenes-agregar').click(function(){

    let formData = new FormData();

        //---------------------------- imagenes ---------------------------------------
        arrayFoto = [];
        arrayOrden = [];

        $('.mostrar_foto').each(function(index2) {
          $('.mostrar_foto div center').each(function(index2) {
            arrayFoto.push($(this).children(".form-group").children(".photo").children("div.upimg").children("input")[0].files[0]);
            arrayOrden.push($(this).children(".form-group").children(".photo").children("div.prevPhoto").children("span").attr('groupid'));
          });
        });

        for(let foto of arrayFoto){
          formData.append('foto[]', foto);
        }
        for(let orden of arrayOrden){
          formData.append('groupid[]', orden);
        }
        //---------------------------- imagenes ---------------------------------------


        //---------------------------- pdf ---------------------------------------
        arrayFoto2 = [];
        arrayOrden2 = [];

        $('.mostrar_foto2').each(function(index2) {
          $('.mostrar_foto2 div center').each(function(index2) {
            arrayFoto2.push($(this).children(".form-group").children(".photo2").children("div.upimg2").children("input")[0].files[0]);
            arrayOrden2.push($(this).children(".form-group").children(".photo2").children("div.prevPhoto2").children("span").attr('groupid2'));
          });
        });

        for(let foto2 of arrayFoto2){
          formData.append('foto2[]', foto2);
        }
        for(let orden2 of arrayOrden2){
          formData.append('groupid2[]', orden2);
        }
        //---------------------------- pdf ---------------------------------------

        let id_visita = $('#id_visita').val();
        formData.append('id_visita',id_visita);

        let id_mascota = $('#id_mascota').val();
        formData.append('id_mascota',id_mascota);

        $.ajax({
          url: 'validaciones/visitas/examenes-agregar',
          type: 'post',
          data: formData,
          contentType: false,
          processData: false,
          success: function(data) {
           parseInt(data);


        //AGREGADO CORRECTO
        if (data==0) {

        	Swal.fire(
        		'Examenes/Placas registradas con exito',
        		'',
        		'success'
        		).then(function() {
        			window.location = "visitas/"+id_visita+"/"+id_mascota;
        		});

        	}
        //AGREGADO CORRECTO

        else{

          Swal.fire(
            'Examenes/Placas registradas con exito',
            '',
            'success'
            ).then(function() {
              window.location = "visitas/"+id_visita+"/"+id_mascota;
            });

          }

        }
      });

      });
});

