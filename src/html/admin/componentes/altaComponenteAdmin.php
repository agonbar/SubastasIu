<?php
	include HTML_ADMIN_PATH."/cabecera.php";
?>

<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <h2><?php MultiIdioma::gettexto("menu.alta_componente"); ?></h2>
    </div>

<form action="index.php" enctype="multipart/form-data" method="post"/>
<input type="hidden" name="controlador" value="AltaComponenteAdminControlador" />
<input type="hidden" name="accion" value="altaComponente" />
<input id="idCompSub" type="hidden" name="idCompSub" value="<?php if (isset($_REQUEST["idCompSub"])) { echo $_REQUEST["idCompSub"]; } ?>" />
	<div class="box_text_content">
    	<!--<img src="./recursos/img/calendar.gif" alt="" title="" class="box_icon">-->
        <div class="box_text_ancho">
        	<h3><?php MultiIdioma::gettexto("altaComponente.datos_componente") ?>:</h3>
        </div>
    </div>
    <div class="box_text_content">
    	<!--<img src="./recursos/img/calendar.gif" alt="" title="" class="box_icon">-->
        <div class="box_text_ancho ult_campo">
		    <?php MultiIdioma::gettexto("altaComponente.nombre") ?>*: <input class="input_registro" type="text" name="nombreComp" value="<?php if (isset($_REQUEST["nombreComp"])) { echo $_REQUEST["nombreComp"]; } ?>"><?php if (isset($ERRORES_FORM["nombreComp"])) { ?>ERROR<? } ?><br />
			<?php MultiIdioma::gettexto("altaComponente.descripcionBreve") ?>*: <input class="input_registro" type="text" name="desBreveComp" value="<?php if (isset($_REQUEST["desBreveComp"])) { echo $_REQUEST["desBreveComp"]; } ?>"><?php if (isset($ERRORES_FORM["desBreveComp"])) { ?>ERROR<? } ?><br />
		    <?php MultiIdioma::gettexto("altaComponente.descripcion") ?>*: <input class="input_registro" type="text" name="desComp" value="<?php if (isset($_REQUEST["desComp"])) { echo $_REQUEST["desComp"]; } ?>"><?php if (isset($ERRORES_FORM["desComp"])) { ?>ERROR<? } ?><br />
			<?php MultiIdioma::gettexto("altaComponente.unidadesDisponibles") ?>*: <input class="input_registro" type="text" name="unidadesStock" value="<?php if (isset($_REQUEST["unidadesStock"])) { echo $_REQUEST["unidadesStock"]; } ?>"><?php if (isset($ERRORES_FORM["unidadesStock"])) { ?>ERROR<? } ?><br />
			<?php MultiIdioma::gettexto("altaComponente.precioUnidad") ?>*: <input class="input_registro" type="text" name="precio" value="<?php if (isset($_REQUEST["precio"])) { echo $_REQUEST["precio"]; } ?>"><?php if (isset($ERRORES_FORM["precio"])) { ?>ERROR<? } ?><br />
		</div>
	</div>	
	<div class="box_text_content">
    	<!--<img src="./recursos/img/calendar.gif" alt="" title="" class="box_icon">-->
        <div class="box_text_ancho">
        	<h3><?php MultiIdioma::gettexto("altaComponente.datos_componente") ?>:</h3>
        </div>
    </div>
	<div class="box_text_content">
    	<!--<img src="./recursos/img/calendar.gif" alt="" title="" class="box_icon">-->
        <div class="box_text_ancho ult_campo">	
        	Foto principal*:<select name="isPrincipal" >
        		<option value="foto1" >Foto1</option>
        		<option value="foto2" >Foto2</option>
        		<option value="foto3" >Foto3</option>
        	</select>
        </div>
        <div class="box_text_ancho ult_campo">
        	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE ?>" />
			<?php MultiIdioma::gettexto("crearSubasta.foto") ?> 1: <input type="file" name="foto1" /><br/>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE ?>" />
			<?php MultiIdioma::gettexto("crearSubasta.foto") ?> 2: <input type="file" name="foto2" /><br/>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE ?>" />
			<?php MultiIdioma::gettexto("crearSubasta.foto") ?> 3: <input type="file" name="foto3" />
        </div>
   </div>
    
	<div class="box_text_content">
    	<div class="box_text_ancho ult_campo">
       		<div class="right"><input type="button" value="<?php MultiIdioma::gettexto("comun.volver") ?>" onclick="javascript:history.back()" /></div>
       		<div class="right"><input type="submit" value="<?php MultiIdioma::gettexto("crearSubasta.crear") ?>" /></div>
       		
        </div>
    </div>
</form>
</div>
<?php
	include HTML_ADMIN_PATH."/pie.php";
?>