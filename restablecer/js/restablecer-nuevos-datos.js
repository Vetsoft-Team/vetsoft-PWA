$(document).ready(function(){


	$('#recover_true').click(function(){
		let formData = new FormData();

		let key = $('#key').val();
		formData.append('key',key);

		let clave_usuario = $('#clave_usuario').val();
		formData.append('clave_usuario',clave_usuario);

		let rclave_usuario = $('#rclave_usuario').val();
		formData.append('rclave_usuario',rclave_usuario);


		if (clave_usuario == '') {
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
				title: 'Ingresa tu nueva contraseña'
			});

		}else if(clave_usuario.length<8){

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
				title: 'Tu contraseña debe tener minimo 8 caracteres'
			});

		}else if (rclave_usuario == '') {
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
				title: 'Confirma tu nueva contraseña'
			});

		}else if(rclave_usuario.length<8){

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
				title: 'Tu contraseña debe tener minimo 8 caracteres'
			});

		}else{
			$.ajax({
				url: 'restablecer-nuevos-datos-guardar',
				type: 'post',
				data: formData,
				contentType: false,
				processData: false,
				success: function(data) {
					parseInt(data);

                //CAMBIO INCORRECTA
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
                		type: 'info',
                		title: 'Las contraseñas ingresadas no coinciden'
                	});
                }
                //CAMBIO INCORRECTA


                //CAMBIO CORRECTO
                else if (data==1) {

                	Swal.fire(
                		'CONTRASEÑA RESTABLECIDA',
                		'SU NUEVA CONTRASEÑA SE HA GUARDADO, AHORA YA PUEDES UTILIZAR TU CUENTA CON TU NUEVA CONTRASEÑA',
                		'success'
                		).then(function() {
                			window.location = "../login";
                		});

                	}
                //CAMBIO CORRECTO



                //CAMBIO INCORRECTA
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
                		title: 'RESTABLECIMIENTO INCORRECTO'
                	});
                }
                //CAMBIO INCORRECTA

            }
        });
		}
	});
});

