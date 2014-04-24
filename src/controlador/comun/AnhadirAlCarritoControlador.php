<?php
/**
 * Clase controladora del caso de uso Anhadir Componente al carrito
 * @author Hector Riopedre
 */
class AnhadirAlCarritoControlador extends PrivadoControlador {
	public function __construct() {

	}

	protected function ejecutar($accion) {
		switch($accion) {
			case "addCarrito" :
				$idComponente = $_REQUEST["idComponente"];
				$numElementos = $_REQUEST["numElementos"];
				$componenteBean = new ComponenteBean();
				$lineaPedidoBean = new LineaPedidoBean();
				// La factoria devuelve un objeto factoria de la fachada privada
				//para poder llamar al metodo consultarCarrito
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$fachada -> consultarComponente($idComponente, $componenteBean);
					$lineaPedidoBean -> setComponente($componenteBean);
					$lineaPedidoBean -> setUnidades($numElementos);
					$lineaPedidoBean -> setVendedor($componenteBean->getUsuarioVendedor());
					$lineaPedidoBean -> setPrecioUnidad($componenteBean->getPrecio());
					$fachada -> anhadirAlCarrito($lineaPedidoBean);
					include (HTML_PRIVADA_CARRITO_PATH . "/carritoAnhadido.php");
					
				} catch (AnhadirACarritoFacEx $ex) {
					$ERRORES_FORM = $ex -> getErrores();
					include (HTML_PRIVADA_CARRITO_PATH . "/errorAnhadiendoACarrito.php");
					
				}

				break;

			default :
				echo "accionNoEncontrada";
				break;
		}

	}

}
?>