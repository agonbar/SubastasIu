<?php
/**
 * Clase adaptadora que realiza el pago por PayPal
 * @author Miguel Callon
 */
class PagoPayPalAdaptador implements IPagoAdaptador {
	/**
	 * Realiza un pago por PayPal.
	 * @return true en caso que el pago se realice con exito
	 * @author Miguel Callon
	 */
	public function pagar(DatosPagoBean $datosPago) {
		// TODO Por implementar
		return true;
	}
}
?>