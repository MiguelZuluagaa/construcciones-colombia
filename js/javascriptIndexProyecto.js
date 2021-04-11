const fechaInicio = document.querySelector('#fecha_inicio');
const fechaFin = document.querySelector('#fecha_fin');

const validar = () =>{
	let valueFechaInicio, valueFechaFin;
	valueFechaInicio = new Date(fechaInicio.value);
	valueFechaFin = new Date(fechaFin.value);
	if (valueFechaInicio > valueFechaFin) {
		swal({
			title: "Error",
			text: "La fecha inicial no puede ser mayor a la fecha final",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		fechaInicio.value = "";
		fechaFin.value = "";
	}
}
fechaInicio.addEventListener('change', () => {
	validar();
});
fechaFin.addEventListener('change', () => {
	validar();
});


function validarPais(){
	var idPais = document.getElementById("pais").value;
	if(idPais == 0){
		$("#departamentoSelect").prop("disabled", true);
		$("#ciudadSelect").prop("disabled", true);
		document.getElementById("departamentoSelect").value = "0";
		document.getElementById("ciudadSelect").value = "0";
	}else{
		$("#departamentoSelect").prop("disabled", false);

		$.ajax({
			type: 'post',
			url: 'includes/getDepartamento.php',
			dataType: 'html',
			data: {id: idPais},
			success: function(data){
				$("#departamentoSelect").html(data);
			}
		});
	}
}

function validarCiudad(){
	var idDepartamento = document.getElementById("departamentoSelect").value;
	if(idDepartamento == 0){
		$("#ciudadSelect").prop("disabled", true);
		document.getElementById("ciudadSelect").value = "0";
	}else{
		$("#ciudadSelect").prop("disabled", false);
		$.ajax({
			type: 'post',
			url: 'includes/getCiudad.php',
			dataType: 'html',
			data: {id: idDepartamento},
			success: function(data){
				$("#ciudadSelect").html(data);
			}
		});
	}
}

function enviarRegistroObra(evt) {
	evt.preventDefault();// Evitamos el submit en nuevos navegadores
	let pais = document.getElementById("pais");
	let departamento = document.getElementById("departamentoSelect");
	let ciudad = document.getElementById("ciudadSelect");
	let estadoObra = document.getElementById("estadoObra");
	let clienteObra = document.getElementById("clienteObra");
	let tipoObra = document.getElementById("tipoObra");
	let numeroPisos = document.getElementById("cantidadPisos");
	if (pais.value == "0" || departamento.value == "0" || ciudad.value == "0" || estadoObra.value == "0" || clienteObra.value == "0" || tipoObra.value == "0")  {
		swal({
			title: "Faltan datos por completar",
			text: "Ingresa todos los campos requeridos",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				if(pais.value == "0"){pais.focus();}
				if(departamento.value == "0"){departamento.focus();}
				if(ciudad.value == "0"){ciudad.focus();}
				if(estadoObra.value == "0"){estadoObra.focus();}
				if(clienteObra.value == "0"){clienteObra.focus();}
				if(tipoObra.value == "0"){tipoObra.focus();}
			}
		});
		return true;
	} else {
		if(numeroPisos.value > 4 && tipoObra.value == "1"){
			swal({
				title: "Error",
				text: "Una edificacion tipo casa no puede tener mas de 4 pisos",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			numeroPisos.value = "";
			tipoObra.value = "0";
		}else{
			let vidFileLength = $("#planos")[0].files.length;
			if(vidFileLength == "0"){
				swal({
					title: "Estas seguro que deseas continuar?",
					text: "No has adjuntado la documentacion de tu proyecto!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						swal("Procesando informacion!", {
							timer: 3000,
						});
						document.registrarObra.submit()
							
					} else {
						swal("Termina de llenar tu formulario");
					}
				});
			}
		}
	}
}