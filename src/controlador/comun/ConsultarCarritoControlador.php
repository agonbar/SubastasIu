<?php
/**
 * Clase controladora del caso de uso Consultar Carrito
 * @author Hector Riopedre
 */
class ConsultarCarritoControlador extends PrivadoControlador {
	public function __construct() {

	}

	/*<a href=”index.php?controlador=ConsultarCarritoControlador&accion=consultarCarrito”>ConsultarCarrito</a>*/

	protected function ejecutar($accion) {
		switch($accion) {
			case "consultarCarrito" :
				// Se instancia el bean del carrito.
				$carritoBean = new CarritoBean();

				// La factoria devuelve un objeto factoria de la fachada privada
				//para poder llamar al metodo consultarCarrito
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$fachada -> consultarCarrito($carritoBean);
					include (HTML_PRIVADA_CARRITO_PATH . "/carritoConsultado.php");
				} catch (ConsultarCarritoFacEx $ex) {
					$ERRORES_FORM = $ex -> getErrores();
					include (HTML_PRIVADA_CARRITO_PATH . "/errorConsultarCarrito.php");
				}

				break;

			default :
				echo "accionNoEncontrada";
				break;
		}

	}

}
?>