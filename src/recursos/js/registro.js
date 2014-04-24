
var aviso = ""; //Variable Global usada para que los mensajes de error se muestren en un solo alert()

function validarRegistro(form) {

    var todoLLeno = true; //usado para saber si queda algún campo vacío
    var lleno = true; //usado para saber si un campo en particular está vacío

    for (var i = 0; i < form.elements.length; i++) {		//recorre todos los elementos del formulario
        switch (form.elements[i].name) {
          
            case "dni":
                var dni = comprobarDni(form.elements[i]);
                break;
            case "telefono":
                var telefono = comprobarTelefono(form.elements[i]);
                break;
            case "email":
                var email = comprobarEmail(form.elements[i]);
                break;
            case "codigoPostal":
                var codigoPostal = comprobarCP(form.elements[i]);
                break;
            case "clave":
                var contrasena = comprobarLLeno(form.elements[i]);
                var valorContrasena= form.elements[i].value;
                break;
            case "repetirClave":
                var repetirContrasena = comprobarRepetirContrasena(form.elements[i], valorContrasena);
                break;
                    
            default:
                lleno = comprobarLLeno(form.elements[i]);
                if (todoLLeno && lleno == false) {		//con este if se comprueba si todos los campos afectados por el método comprobarLLeno están llenos.
                    todoLLeno = false;
                }
                break;


        }

    }
    if (todoLLeno && telefono && email && codigoPostal && dni && contrasena && repetirContrasena) {		//Retornará True al formulario si todas las validaciones son satisfactorias
        return true;
    } else {
        alert(aviso);
        aviso = "";
       return false;

    }
}
