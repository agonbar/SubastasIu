<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso Subasta
 * @author Miguel Callon
 */
class ConsultarSubastaControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "consultarSubasta":
				$idSubasta = $_REQUEST["idSubasta"];
				
				$orden = !isset($_REQUEST["orden"])?"cantPujada desc":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, $orden, $max, null);
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$subastaBean = new SubastaBean();
					$fachada->consultarSubasta($idSubasta, $subastaBean, $paginadoBean);
					
					$pujaGanadora = $subastaBean->getPujaGanadora();
					$existenPujas = false;
					if (isset($pujaGanadora)) {
							$existenPujas = true;
					}
					
					$idUsuarioConectado = Session::get(ID_USUARIO_CONECTADO_KEY);
					if ($subastaBean->getIdEstadoSub() == ESTADO_SUBASTA_CREADA
						&& $subastaBean->getIdUsuCreador() == $idUsuarioConectado) {
						include (HTML_PRIVADA_SUBASTAS_PATH."/subastaConsultadaCreadaPro.php");
					} elseif ($subastaBean->getIdEstadoSub() == ESTADO_SUBASTA_EN_PROCESO) {
						if ($subastaBean->getIdUsuCreador() == $idUsuarioConectado) {
							include (HTML_PRIVADA_SUBASTAS_PATH."/subastaConsultadaAbiertaPro.php");
						} else {
							include (HTML_PRIVADA_SUBASTAS_PATH."/subastaConsultadaAbierta.php");
						}
					} elseif ($subastaBean->getIdEstadoSub() == ESTADO_SUBASTA_FINALIZADA
						|| $subastaBean->getIdEstadoSub() == ESTADO_SUBASTA_CANCELADA
						|| $subastaBean->getIdEstadoSub() == ESTADO_SUBASTA_ABORTADA) {
						include (HTML_PRIVADA_SUBASTAS_PATH."/subastaConsultadaCerrada.php");
					}
				} catch (ConsultarSubastaFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_SUBASTAS_PATH."/errorConsultarSubasta.php");
				}
				
				break;
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>