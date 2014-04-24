<?php
/**
 * Clase utilidad que permite validar los campos de los formularios.
 * @author Miguel Callon
 */
class ValidarCampos {
	/**
	 * Valida si los datos de la puja que se realiza en una subasta
	 * son correctos
	 * @author Miguel Callon
	 */
	public static function validarPuja(PujaBean $puja) {
		$errores;	
		if ($puja->getCantPujada() == "" || !is_numeric($puja->getCantPujada()) 
			|| $puja->getCantPujada() < 0) {
			$errores["cantPujada"] = true;
		}
		if (isset($errores)) {
			/*echo "hay algun error";
			foreach ($errores as $key => $error) {
				echo "error es: $key";
			}*/
			//echo "error: ".$errores["nombre"];
			$ex = new PujaDatosIncFacEx();
			$ex -> setErrores($errores);
			throw $ex;
		}
		return true;
	}
	/**
	 * Valida si los datos de la subasta estan correctamente rellenados
	 * antes de crear una subasta.
	 * @author Miguel Callon
	 */
	public static function validarCrearSubasta(SubastaBean $subasta) {
		$errores;
		if ($subasta -> getTitulo() == "" || strlen($subasta -> getTitulo()) > 255) {
			$errores["titulo"] = true;
		}
		if ($subasta -> getDescripcionBreve() == "" || strlen($subasta -> getDescripcionBreve()) > 255) {
			$errores["descripcionBreve"] = true;
		}
		if ($subasta -> getDescripcion() == "" || strlen($subasta -> getDescripcion()) > 400) {
			$errores["descripcion"] = true;
		}
		if ($subasta -> getFechaApertura() == "") {
			$errores["fechaApertura"] = true;
		}
		if ($subasta -> getHoraApertura() == "") {
			$errores["horaApertura"] = true;
		}
		if ($subasta -> getFechaCierre() == "") {
			$errores["fechaCierre"] = true;
		}
		if ($subasta -> getHoraCierre() == "") {
			$errores["horaCierre"] = true;
		}
		if ($subasta -> getIdCompSub() == "") {
			$errores["idCompSub"] = true;
		}
		if ($subasta -> getPrecioInicial() == "" || $subasta -> getPrecioInicial() < 0) {
			$errores["precioInicial"] = true;
		}
		if (isset($errores)) {
			/*echo "hay algun error";
			foreach ($errores as $key => $error) {
				echo "error es: $key";
			}*/
			//echo "error: ".$errores["nombre"];
			$ex = new SubDatosIncFacEx();
			$ex -> setErrores($errores);
			throw $ex;
		}
		return true;
	}

	/**
	 * Valida si los datos del login estan correctamente rellenados
	 * @author Miguel Callon
	 */
	public static function validarLogin($usuario, $clave) {
		$errores;
		if ($usuario == "") {
			$errores["usuario"] = true;
		}
		if ($clave == "") {
			$errores["clave"] = true;
		}
		if (isset($errores)) {
			$ex = new LoginFacEx();
			$ex -> setErrores($errores);
			throw $ex;
		}
	}

	/**
	 * Valida si los datos del login estan correctamente rellenados
	 * @author Miguel Callon
	 */
	public static function validarNuevoUsuario(UsuarioBean $usuarioBean) {
		$errores;
		if ($usuarioBean -> getNombre() == "" || strlen($usuarioBean -> getNombre()) > 20) {
			$errores["nombre"] = true;
		}
		if ($usuarioBean -> getApellidos() == "" || strlen($usuarioBean -> getApellidos()) > 30) {
			$errores["apellidos"] = true;
		}
		if ($usuarioBean->getMesNacimiento() == "" || 
			$usuarioBean->getDiaNacimiento() == "" ||
			$usuarioBean->getAnhoNacimiento() == "" || 
			!checkdate($usuarioBean->getMesNacimiento(), $usuarioBean->getDiaNacimiento(), $usuarioBean->getAnhoNacimiento())) {
			$errores["fechaNacimiento"] = true;
		}
		if ($usuarioBean -> getDni() == "" || !ValidarCampos::comprobarNif($usuarioBean -> getDni())) {
			$errores["dni"] = true;
		}
		if ($usuarioBean -> getTelefono() == "") {
			$errores["telefono"] = true;
		}
		if ($usuarioBean -> getEmail() == "" || !ValidarCampos::validaMail($usuarioBean -> getEmail())) {
			$errores["email"] = true;
		}
		if ($usuarioBean -> getDireccion() == "" || strlen($usuarioBean -> getDireccion()) > 50) {
			$errores["direccion"] = true;
		}
		if ($usuarioBean -> getLocalidad() == "" || strlen($usuarioBean -> getLocalidad()) > 255) {
			$errores["localidad"] = true;
		}
		if ($usuarioBean -> getProvincia() == "" || strlen($usuarioBean -> getProvincia()) > 255) {
			$errores["provincia"] = true;
		}
		if ($usuarioBean -> getCP() == "" || strlen($usuarioBean -> getCP()) > 5) {
			$errores["cp"] = true;
		}
		if ($usuarioBean -> getCuentaPayPal() == "" || strlen($usuarioBean -> getCuentaPayPal()) > 30) {
			$errores["cuentaPayPal"] = true;
		}
		if ($usuarioBean -> getUsuario() == "" || strlen($usuarioBean -> getUsuario()) > 20) {
			$errores["usuario"] = true;
		}
		if ($usuarioBean -> getClave() == "") {
			$errores["clave"] = true;
		}
		if (isset($errores)) {
			/*foreach ($errores as $key => $valor) {
				echo "$key";
			}*/
			$ex = new DatUserIncFacEx();
			$ex -> setErrores($errores);
			throw $ex;
		}
	}
	/**
	 * Valida si los datos de cambiar clave del formulario
	 * de datos propios del usuario conectado son correctos
	 * @author Miguel Callon
	 */
	public static function validarCambiarClave(DatosCambiarClaveBean $datosCambiarClave) {
		if ($datosCambiarClave -> getClaveActual() == "") {
			$errores["claveActual"] = true;
		}
		if ($datosCambiarClave -> getClaveNueva() == "") {
			$errores["claveNueva"] = true;
		}
		if ($datosCambiarClave -> getRepetirClave() == "") {
			$errores["repetirClave"] = true;
		}
		if ($datosCambiarClave -> getRepetirClave() != $datosCambiarClave -> getClaveNueva()) {
			$errores["claveNoCoincide"] = true;
		}
		if (isset($errores)) {
			/*foreach ($errores as $key => $valor) {
				echo "$key";
			}*/
			$ex = new DatUserIncFacEx();
			$ex -> setErrores($errores);
			throw $ex;
		}
	}

	/**
	 * Valida si los datos del pago estan correctamente rellenados
	 * antes de realizar el pago de un pedido.
	 * @author Miguel Callon
	 */
	public static function validarDatosPago(DatosPagoBean $datosPago) {
		$errores;
		if ($datosPago -> getCuentaOrigen() == "") {
			$errores["cuentaOrigen"] = true;
		}
		if ($datosPago -> getDireccionEnvio() == "") {
			$errores["direccionEnvio"] = true;
		}
		if ($datosPago -> getLocalidadEnvio() == "") {
			$errores["localidadEnvio"] = true;
		}
		if ($datosPago -> getProvinciaEnvio() == "") {
			$errores["provinciaEnvio"] = true;
		}
		if (isset($errores)) {
			$ex = new RealizarPagoDatosIncFacEx();
			$ex -> setErrores($errores);
			throw $ex;
		}
		return true;
	}

	/**
	 * Valida si los nuevosdatos del usuario estan
	 *  correctamente rellenados antes de modificarlo.
	 * @author Adrián González
	 */
	public static function validarModificarDatos($usuario) {
		$errores;
		if ($usuario == "") {
			$errores["usuario"] = true;
		}

		if (isset($errores)) {
			$ex = new datUserEx();
			$ex -> setErrores($errores);
			throw $ex;
		}
	}

	/**
	 * Funcion que comprueba el nif de un usuario
	 * @param $nif Nif a comprobar
	 * @author Sacada de internet
	 */
	public static function comprobarNif($nif) {
		$letras = explode(',', 'T,R,W,A,G,M,Y,F,P,D,X,B,N,J,Z,S,Q,V,H,L,C,K,E');
		if ((strlen($nif) != 9) || (!is_long($entero = intval(substr($nif, 0, 8)))) || (!in_array($letra = strtoupper(substr($nif, 8, 1)), $letras)) || ($letra != $letras[$entero % 23])) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Funcion que comprueba el email de un usuario
	 * @param Email a validar
	 * @author Sacada de internet
	 */
	public static function validaMail($pMail) {
		if (ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@+([_a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]{2,200}\.[a-zA-Z]{2,6}$", $pMail)) {
			return true;
		} else {
			return false;
		}
	}
	
	
	/**
	 * Valida si los datos de un componente estan correctamente rellenados antes de crear uno.
	 * @author Almudena Novoa
	 */
	public static function validarAltaComponente(ComponenteBean $componente) {
		$errores;
		if ($componente -> getNombre() == "" || strlen($componente -> getNombre()) > 20) {
			$errores["nombre"] = true;
		}
		if ($componente -> getPrecio() == "" || $componente -> getPrecio() < 0) {
			$errores["precio"] = true;
		}
		if ($componente -> getUnidadesStock() == "" || $componente -> getUnidadesStock() < 0) {
			$errores["unidadesStock"] = true;
		}
		
		if (isset($errores)) {
			echo "hay algun error";
			foreach ($errores as $key => $error) {
				echo "error es: $key";
			}
			//echo "error: ".$errores["nombre"];
			$ex = new CompDatosFacEx();
			$ex -> setErrores($errores);
			throw $ex;
		}
		return true;
	}
	

	/**
	 * Valida si los nuevos datos de un componente estan correctamente rellenados antes de modificarlo.
	 * @author Almudena Novoa
	 */
	public static function validarModificarComponente($componente) {
		$errores;
		if ($componente == "") {
			$errores["componente"] = true;
		}

		if (isset($errores)) {
			$ex = new CompDatosFacEx();
			$ex -> setErrores($errores);
			throw $ex;
		}
	}
}
?>