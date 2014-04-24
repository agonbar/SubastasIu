var aviso = "";
//Variable Global usada para que los mensajes de error se muestren en un solo alert()

function validarSubasta(form) {

	var todoLLeno = true;
	//usado para saber si queda algún campo vacío
	var lleno = true;
	//usado para saber si un campo en particular está vacío

	for (var i = 0; i < form.elements.length; i++) {//recorre todos los elementos del formulario

		switch (form.elements[i].name) {
			case "foto":
				var foto = comprobarFoto(form.elements[i]);
				break;
			
			case "fechaApertura":
				var fechaA = comprobarFecha(form.elements[i]);
				var valorApertura = form.elements[i].value;
				break;
			case "fechaCierre":
				var fechaC = comprobarCierre(form.elements[i], valorApertura);
				break;
			case "precio":
				var precio = comprobarPrecio(form.elements[i]);
				break;

			default:
				lleno = comprobarLLeno(form.elements[i]);
				if (todoLLeno && lleno == false) {//con este if se comprueba si todos los campos afectados por el método comprobarLLeno están llenos.
					todoLLeno = false;
				}
				break;

		}
		

	}
	if (todoLLeno && fechaA && precio && foto &&fechaC) {//Retornará True al formulario si todas las validaciones son satisfactorias
		alert(fechaC);
		return true;
	} else {
		alert(aviso);
		aviso = "";
		return false;
	}
}

