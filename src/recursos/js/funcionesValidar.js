function comprobarFecha(campo) {
	var patron = /(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)\d\d$/;
	if (campo.value.length == 0) {
		campo.style.borderColor = "red";
		aviso += "Campo " + campo.name + " Vacío\n"
		return false;
	} else {
		if (!campo.value.match(patron)) {
			campo.style.borderColor = "red";
			aviso += "Campo " + campo.name + " Erróneo\n"
			return false;
		} else {
			return true;
		}
	}
}

function comprobarDni(campo) {
	var numero;
	var let;
	var letra;
	var expresion;
	expresion = /^\d{8}[a-zA-Z]$/;
	if (expresion.test(campo.value) == true) {
		numero = campo.value.substr(0, campo.value.length - 1);
		let = campo.value.substr(campo.value.length - 1, 1);
		numero = numero % 23;
		letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
		letra = letra.substring(numero, numero + 1);
		if (letra != let) {
			campo.style.borderColor = "red";
			aviso += "Campo " + campo.name + " Erróneo(Revise la letra)\n";
			return false;
		} else {
			return true;
		}
	} else {
		campo.style.borderColor = "red";
		aviso += "Campo " + campo.name + " Erróneo\n";
		return false;
	}
}

function comprobarTelefono(campo) {
	if (!(/^\d{9}$/.test(campo.value))) {
		campo.style.borderColor = "red";
		aviso += "Campo " + campo.name + " Erróneo\n"
		return false;
	} else {
		return true;
	}

}

function comprobarEmail(campo) {
	if (!(/^([0-9a-zA-Z]([_.w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-w]*[0-9a-zA-Z].)+([a-zA-Z]{2,9}.)+[a-zA-Z]{2,3})$/.test(campo.value))) {
		campo.style.borderColor = "red";
		aviso += "Campo " + campo.name + " Erróneo\n"
		return false;
	} else {
		return true;
	}

}

function comprobarCP(campo) {
	if (!(/^\d{5}$/.test(campo.value))) {
		campo.style.borderColor = "red";
		aviso += "Campo " + campo.name + " Erróneo\n";
		return false;
	} else {
		return true;
	}

}

function comprobarRepetirContrasena(campo, contrasena) {
	if (campo.value != contrasena) {
		campo.style.borderColor = "red";
		aviso += "Las Contraseñas no coinciden\n"
		return false;
	} else {

		return true;
	}

}

function comprobarFoto(campo) {
	var extension = /(.jpg|.gif|.png|.bmp|.jpeg)$/;
	if (extension.test(campo.value)) {
		return true;
	} else {
		campo.style.borderColor = "red";
		aviso += "Solo se permiten imagenes de formato: jpg, gif, png, bmp, jpeg";
		return false;
	}

}

function comprobarCierre(campo, inicio) {
		//Mirar si se incluye la hora
	
	}



function comprobarPrecio(campo) {
	var expresion = /^(\d{1}\.)?(\d+\.?)+(,\d{2})?$/;
	if (expresion.test(campo.value)) {
		return true;
	} else {
		campo.style.borderColor = "red";
		aviso += "Campo " + campo.name + " Erróneo\n";
		return false;
	}

}

function comprobarLLeno(campo) {

	if (campo.value.length == 0) {
		campo.style.borderColor = "red";
		aviso += "Campo " + campo.name + " Vacío\n"
		return false;
	} else {
		return true;
	}
}

function restablecer(campo) {//Usado por el formulario para poner el fondo blanco una vez que se situa el usuario en el campo marcado anteriormente como erróneo
	campo.style.borderColor = "white";

}