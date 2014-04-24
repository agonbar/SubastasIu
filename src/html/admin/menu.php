<div id="menu_admin">
    <ul>                                              
        <li><a href="index.php?controlador=InicioAdminControlador&accion=mostrar"><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li><a href="index.php?controlador=ListarUsuariosControlador&accion=listarUsuariosAdmin"><?php MultiIdioma::gettexto("menu.usuarios"); ?></a></li>
        <li><a href="index.php?controlador=ListarSubastasControlador&accion=listarSubastasAdmin"><?php MultiIdioma::gettexto("menu.subastas"); ?></a></li>
        <li><a href="index.php?controlador=ListarComponentesAdminControlador&accion=listarComponentes"><?php MultiIdioma::gettexto("menu.componentes"); ?></a></li>
        <li><a href="index.php?controlador=ListarPedidosAdminControlador&accion=listarPedidos"><?php MultiIdioma::gettexto("menu.pedidos"); ?></a></li>
        <li><a href="index.php?controlador=ListarPedidosControlador&accion=listarPedidosPrivada"><?php MultiIdioma::gettexto("menu.mensajes"); ?></a></li>                
  		<li><a href="index.php?controlador=ListarPedidosControlador&accion=listarPedidosPrivada"><?php MultiIdioma::gettexto("menu.informes"); ?></a></li> 
  		<li><a href="index.php?controlador=CerrarSesionControlador&accion=cerrar" >Cerrar sesi&oacute;n</a></li>                
    </ul>
</div>
