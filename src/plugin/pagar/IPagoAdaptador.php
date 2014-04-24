<?php
/**
 * Clase adaptadora
 * @author Miguel Callon
 */
interface IPagoAdaptador {
	/**
	 * Realiza un pago por PayPal.
	 * @return true en caso que el pago se realice con exito
	 * @author Miguel Callon
	 */
	public function pagar(DatosPagoBean $datosPago);
}
?>