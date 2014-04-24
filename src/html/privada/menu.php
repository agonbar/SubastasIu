<div id="menu_privada">
    <ul>                                              

		<?php $fachada = FactoriaFachada::getPrivadaFachada() ?>
		<?php $numNotificacionesSinLeer = $fachada->numNotificacionesSinLeer(Session::get(ID_USUARIO_CONECTADO_KEY)) ?>
        <li><a <?php if ($_REQUEST["controlador"] == "InicioPrivadoControlador"){ ?>class="current"<?php } ?> href="index.php?controlador=InicioPrivadoControlador&accion=mostrar"><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li><a <?php if ($_REQUEST["controlador"] == "ListarSubastasControlador"){ ?>class="current"<?php } ?> href="index.php?controlador=ListarSubastasControlador&accion=listarSubastasPrivada"><?php MultiIdioma::gettexto("menu.subastas"); ?></a></li>
        <li><a <?php if ($_REQUEST["controlador"] == "ListarComponentesControlador"){ ?>class="current"<?php } ?> href="index.php?controlador=ListarComponentesControlador&accion=listarComponentes"><?php MultiIdioma::gettexto("menu.componentes"); ?></a></li>
        <li><a <?php if ($_REQUEST["controlador"] == "ListarPedidosControlador"){ ?>class="current"<?php } ?> href="index.php?controlador=ListarPedidosControlador&accion=listarPedidosEnviados"><?php MultiIdioma::gettexto("menu.pedidos"); ?></a></li>
        <li><a <?php if ($_REQUEST["controlador"] == "ListarNotificacionesControlador"){ ?>class="current"<?php } ?> href="index.php?controlador=ListarNotificacionesControlador&accion=listarNotificacionesPrivada"><?php MultiIdioma::gettexto("menu.mensajes"); ?><?php if ($numNotificacionesSinLeer > 0) { ?>&nbsp;(<?php echo $numNotificacionesSinLeer ?>)<?php } ?></a></li>                
  		<li><a href="index.php?controlador=CerrarSesionControlador&accion=cerrar" ><?php MultiIdioma::gettexto("menu.session"); ?></a></li>                

    </ul>
</div>
