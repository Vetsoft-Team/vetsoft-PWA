$('#fecha_nacimiento').on('change', function(){
	$('#edad').val(Calcular_Edad());
});


function Calcular_Edad()
{
	var fecha_seleccionada = $('#fecha_nacimiento').val();
	var fecha_nacimiento = new Date(fecha_seleccionada);
	var fecha_Actual = new Date();
	var edad = (parseInt((fecha_Actual - fecha_nacimiento) / (1000*60*60*24*365)));
	return edad;
}