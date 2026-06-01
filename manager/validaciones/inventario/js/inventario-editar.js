$(document).ready(function(){

  $('#inventario-editar').click(function(){

   let formData = new FormData();

   let id_inventario = $('#id_inventario').val();
   formData.append('id_inventario',id_inventario);
   
   let nombre_articulo = $('#nombre_articulo').val();
   formData.append('nombre_articulo',nombre_articulo);

   let numero_factura = $('#numero_factura').val();
   formData.append('numero_factura',numero_factura);

   let fecha_ingreso = $('#fecha_ingreso').val();
   formData.append('fecha_ingreso',fecha_ingreso);

   let proveedor = $('#proveedor').val();
   formData.append('proveedor',proveedor);

   let cantidad_sugerida = $('#cantidad_sugerida').val();
   formData.append('cantidad_sugerida',cantidad_sugerida);

   let stock = $('#stock').val();
   formData.append('stock',stock);

   let precio_unitario = $('#precio_unitario').val();
   formData.append('precio_unitario',precio_unitario);

   let precio_sugerido = $('#precio_sugerido').val();
   formData.append('precio_sugerido',precio_sugerido);

   let descripcion = $('#descripcion').val();
   formData.append('descripcion',descripcion);

   let fecha_vencimiento = $('#fecha_vencimiento').val();
   formData.append('fecha_vencimiento',fecha_vencimiento);

   let codigo_barras = $('#codigo_barras').val();
   formData.append('codigo_barras',codigo_barras);


   if (nombre_articulo == '') {
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
     title: 'Ingresa el nombre del articulo'
   });

  }else if (numero_factura == '') {
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
     title: 'Ingresa el numero de la factura'
   });

  }else if (fecha_ingreso == '') {
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
     title: 'Ingresa la fecha de ingreso'
   });

  }else if (proveedor == '') {
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
     title: 'Ingresa el nombre del proveedor'
   });

  }else if (cantidad_sugerida == '') {
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
     title: 'Ingresa la cantidad sugerida'
   });

  }else if (stock == '') {
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
     title: 'Ingresa el stock'
   }); 

  }else if (precio_unitario == '') {
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
     title: 'Ingresa el precio unitario'
   }); 

  }else if (precio_sugerido == '') {
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
     title: 'Ingresa el precio sugerido'
   }); 

  }else if (descripcion == '') {
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
     title: 'Ingresa la descripcion o detalle'
   }); 

  }else if (fecha_vencimiento == '') {
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
     title: 'Ingresa la fecha de vencimiento'
   }); 

  }else if (codigo_barras == '') {
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
     title: 'Ingresa el codigo de barras'
   }); 

  }else{

    $.ajax({
      url: 'validaciones/inventario/inventario-editar',
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
           title: 'Producto actualizado con exito'
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
           type: 'error',
           title: 'Error al guardar'
         });
        }
       //REGISTRO INCORRECTO

     }
   });
  }
});
});

