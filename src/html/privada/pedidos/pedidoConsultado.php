<?php
$idPedido = $pedidoBean->getIdPedido();
if (isset($idPedido)) {
	$lineas=$pedidoBean->getLineasPedido();
	echo $pedidoBean->getIdPedido();
	echo "Lineas:";
	for($i=0;$i<count($lineas);$i++){
		echo lineas;
	}
	echo "Datos Vendedor:";
	$usuarioVendedorBean = $pedidoBean->getUsuarioVendedor();
	$usuarioCompradorBean = $pedidoBean->getUsuarioComprador();
	
	echo $usuarioVendedorBean->getNombre();
	echo $usuarioCompradorBean->getNombre();
}
?>