var aviso = ""; //Variable Global usada para que los mensajes de error se muestren en un solo alert()


function validarLogin(form) {
	
    var todoLLeno = true; //usado para saber si queda algún campo vacío
    var lleno = true; //usado para saber si un campo en particular está vacío

    for (var i = 0; i < form.elements.length; i++) {		//recorre todos los elementos del formulario
                                 
                lleno = comprobarLLeno(form.elements[i]);
                if (todoLLeno && lleno == false) {		//con este if se comprueba si todos los campos afectados por el método comprobarLLeno están llenos.
                    todoLLeno = false;
                }
   }
    if (todoLLeno) {	//Retornará True al formulario si todas las validaciones son satisfactorias
        return true;
    } else {
        alert(aviso);
        aviso = "";
        return false;
    }
}
