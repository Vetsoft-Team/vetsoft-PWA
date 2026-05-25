$(document).ready(function(){


	$('#recover').click(function(){
		let formData = new FormData();

		let correo = $('#correo').val();
		formData.append('correo',correo);


		if (correo == '') {
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
				type: 'warning',
				title: 'Ingresa tu correo electronico'
			});

		}else if($("#correo").val().indexOf('@', 0) == -1 || $("#correo").val().indexOf('.', 0) == -1){
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
				type: 'warning',
				title: 'Ingresa un correo electronico valido'
			});  

		}else{
			$.ajax({
				url: 'restablecer/recover',
				type: 'post',
				data: formData,
				contentType: false,
				processData: false,
				success: function(data) {
					parseInt(data);

                //CORREO NO EXISTE
                if (data==0) {
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
                		type: 'info',
                		title: 'El correo ingresado no existe o no esta verificado'
                	});
                }
                //CORREO EXISTE -> PASAR AL PASO 2
                else if (data==1) {
					$('#paso1').hide();
					$('#paso2').show();
					$('#correo').prop('disabled', true); // Deshabilitarlo por si acaso
                }
            }
        });
		}
	});

	// PASO 2: GUARDAR CONTRASEÑA
	$('#save_password').click(function(){
		let correo = $('#correo').val();
		let nueva_clave = $('#nueva_clave').val();
		let confirmar_clave = $('#confirmar_clave').val();

		if(nueva_clave == ''){
			Swal.fire('Advertencia', 'Ingresa la nueva contraseña', 'warning');
		} else if(confirmar_clave == ''){
			Swal.fire('Advertencia', 'Confirma la nueva contraseña', 'warning');
		} else if(nueva_clave !== confirmar_clave){
			Swal.fire('Advertencia', 'Las contraseñas no coinciden', 'warning');
		} else {
			let formData = new FormData();
			formData.append('correo', correo);
			formData.append('nueva_clave', nueva_clave);

			$.ajax({
				url: 'restablecer/update_password',
				type: 'post',
				data: formData,
				contentType: false,
				processData: false,
				success: function(data) {
					if(data == 1){
						Swal.fire(
							'¡Éxito!',
							'Tu contraseña ha sido actualizada.',
							'success'
						).then(function() {
							window.location = "login";
						});
					} else {
						Swal.fire('Error', 'Hubo un problema al actualizar la contraseña', 'error');
					}
				}
			});
		}
	});
});
