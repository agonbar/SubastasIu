<div id="menu">
    <ul>                                              
        <li><a <?php if ($_REQUEST["controlador"] == "InicioControlador"){ ?>class="current"<?php } ?> href="index.php?controlador=InicioControlador&accion=mostrar"><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li><a <?php if ($_REQUEST["controlador"] == "ComoFuncionaControlador"){ ?>class="current"<?php } ?> href="index.php?controlador=ComoFuncionaControlador&accion=mostrar"><?php MultiIdioma::gettexto("menu.como_funciona"); ?></a></li>
        <li><a <?php if ($_REQUEST["controlador"] == "PreguntasFrecuentesControlador"){ ?>class="current"<?php } ?> href="index.php?controlador=PreguntasFrecuentesControlador&accion=mostrar"><?php MultiIdioma::gettexto("menu.preguntas_frecuentes"); ?></a></li>                
    </ul>
</div>



