<?php
/**
 * Clase controladora del caso de uso Eliminar Componente de carrito
 * @author Hector Riopedre
 */
class EliminarDeCarritoControlador extends PrivadoControlador {
	public function __construct() {

	}

	protected function ejecutar($accion) {
		switch($accion) {
			case "eliminar" :
				$id = $_REQUEST["idComp"];
				// La factoria devuelve un objeto factoria de la fachada privada
				//para poder llamar al metodo consultarCarrito
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					
					$fachada -> eliminarDeCarrito($id);
					include (HTML_PRIVADA_CARRITO_PATH . "/carritoModificado.php");
					
				} catch (EliminarDeCarritoFacEx $ex) {
					$ERRORES_FORM = $ex -> getErrores();
					include (HTML_PRIVADA_CARRITO_PATH . "/errorModificandoCarrito.php");
					
				}

				break;

			default :
				echo "accionNoEncontrada";
				break;
		}

	}

}
?>