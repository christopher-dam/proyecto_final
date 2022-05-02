/*utilizado cuando vamos a borrar un entrenador*/
function confirmarEntrenador(id) {

	Swal.fire({  
		title: '¿Esta seguro de eliminar este entrenador?',  
		showDenyButton: true,
		confirmButtonText: 'Confirmar',
		denyButtonText: 'Cancelar',
	  }).then((result) => {  
		  if (result.isConfirmed) {
			window.location.href = "borrarEntrenador.php?id_entrenador=" + id;
		  } else if (result.isDenied) {
			return false
		   }
	  });
		
}

/*utilizado cuando vamos a borrar un jugador*/
function confirmarJugador(id) {

	Swal.fire({  
		title: '¿Esta seguro de eliminar este jugador?',  
		showDenyButton: true,
		confirmButtonText: 'Confirmar',
		denyButtonText: 'Cancelar',
	  }).then((result) => {  
		  if (result.isConfirmed) {
			window.location.href = "borrarJugador.php?id_jugador=" + id;
		  } else if (result.isDenied) {
			return false
		   }
	  });
		
}

/*usado para asegurar que los datos de los formularios son correctos*/
function validarRegistro() {
	var nombre = document.getElementById("nombre").value;
	var apellidos = document.getElementById("apellidos").value;
	var dni = document.getElementById("dni").value;
	var telefono = document.getElementById("telefono").value;
	var email = document.getElementById("email").value;
	var ok = true;

	if (nombre.length==0) {
		Swal.fire({
			title: 'Error',
			text: 'El nombre no puede estar vacío',
			icon: 'error',
			confirmButtonText: 'Reintentar'
		})
		ok = false;
	}

	if (apellidos.length==0) {
		Swal.fire({
			title: 'Error',
			text: 'Los apellidos no pueden estar vacíos',
			icon: 'error',
			confirmButtonText: 'Reintentar'
		})
		ok = false;
	}

	if (!/^[0-9]{8}[A-Z]{1}$/.test(dni)) {
		Swal.fire({
			title: 'Error',
			text: 'El DNI debe estar compuesto por 8 números y 1 letra mayúscula',
			icon: 'error',
			confirmButtonText: 'Reintentar'
		})
		ok = false;
	}

	if (!/^[0-9]{9}$/.test(telefono)) {
		Swal.fire({
			title: 'Error',
			text: 'El número de teléfono deben de ser 9 números',
			icon: 'error',
			confirmButtonText: 'Reintentar'
		})
		ok = false;
	}

	if (!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email)) {
		Swal.fire({
			title: 'Error',
			text: 'Inserte una dirección email válida',
			icon: 'error',
			confirmButtonText: 'Reintentar'
		})
		ok = false;
	}

	return ok;
}

/*usado para validar los datos del perfil*/
function validarperfil() {
	var password = document.getElementById("password").value;
	var passwordConfirm = document.getElementById("passwordConfirm").value;

	var ok = true;

	if(password.length < 8) {
		Swal.fire({
			title: 'Error',
			text: 'La contraseña debe tener al menos 8 caracteres',
			icon: 'error',
			confirmButtonText: 'Reintentar'
		})
		ok = false;
	}
	if(password != passwordConfirm) {
		Swal.fire({
			title: 'Error',
			text: 'La contraseña de confirmación es distinta',
			icon: 'error',
			confirmButtonText: 'Reintentar'
		})
		ok = false;
	}
	return ok;
}