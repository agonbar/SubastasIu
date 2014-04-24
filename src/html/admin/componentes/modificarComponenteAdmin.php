<?php
	include HTML_ADMIN_PATH."/cabecera.php";
?>

<style>
	
	#botonI{
	float: left;
	
	
}
#botonD{
	float: right;
	

}
#botones{
	float:right;
	width: auto;
}
	
</style>
<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <h2><?php MultiIdioma::gettexto("menu.modificar_componente"); ?></h2>
    </div>

<form action="index.php" enctype="multipart/form-data" method="post"/>
<input type="hidden" name="controlador" value="ModificarComponenteAdminControlador" />
<input type="hidden" name="accion" value="modificarComponente" />
<input id="idCompSub" type="hidden" value="<?php if (isset($_REQUEST["idOption"])) { $id=$_REQUEST["idOption"]; echo $id[0]; } ?>" name="idComponente"  />

	<div class="box_text_content">
    	<!--<img src="./recursos/img/calendar.gif" alt="" title="" class="box_icon">-->
        <div class="box_text_ancho">
        	<h3><?php MultiIdioma::gettexto("altaComponente.datos_componente") ?>:</h3>
        </div>
    </div>
    <div class="box_text_content">
    	<!--<img src="./recursos/img/calendar.gif" alt="" title="" class="box_icon">-->
        <div class="box_text_ancho ult_campo">
		    <?php MultiIdioma::gettexto("altaComponente.nombre") ?>*: <input class="input_registro" type="text" name="nombreComp" value="<?php echo $compBean->getNombre(); ?>"><?php if (isset($ERRORES_FORM["nombreComp"])) { ?>ERROR<? } ?><br />
			<?php MultiIdioma::gettexto("altaComponente.descripcionBreve") ?>*: <input class="input_registro" type="text" name="desBreveComp" value="<?php echo $compBean->getDescripcionBreve(); ?>"><?php if (isset($ERRORES_FORM["desBreveComp"])) { ?>ERROR<? } ?><br />
		    <?php MultiIdioma::gettexto("altaComponente.descripcion") ?>*: <input class="input_registro" type="text" name="desComp" value="<?php echo $compBean->getDescripcion(); ?>"><?php if (isset($ERRORES_FORM["desComp"])) { ?>ERROR<? } ?><br />
			<?php MultiIdioma::gettexto("altaComponente.unidadesDisponibles") ?>*: <input class="input_registro" type="text" name="unidadesStock" value="<?php echo $compBean->getUnidadesStock(); ?>"><?php if (isset($ERRORES_FORM["unidadesStock"])) { ?>ERROR<? } ?><br />
			<?php MultiIdioma::gettexto("altaComponente.precioUnidad") ?>*: <input class="input_registro" type="text" name="precio" value="<?php echo $compBean->getPrecio(); ?>"><?php if (isset($ERRORES_FORM["precio"])) { ?>ERROR<? } ?><br />
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
        	<?php $listaFotos = $compBean->getListaFotos(); ?>
        	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE ?>" />
        	<?php $foto = $listaFotos[0]; ?>
			<?php echo $foto->getTituloFoto() ?> <?php MultiIdioma::gettexto("crearSubasta.foto") ?> 1: <input type="file" name="foto1" />&nbsp; Eliminar: <input type="checkbox" name="eliminar_foto1" value="1"  /><br/>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE ?>" />
			<?php $foto = $listaFotos[1]; ?>
			<?php echo $foto->getTituloFoto() ?> <?php MultiIdioma::gettexto("crearSubasta.foto") ?> 2: <input type="file" name="foto2" />&nbsp; Eliminar: <input type="checkbox" name="eliminar_foto2" value="1"  /><br/>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE ?>" />
			<?php $foto = $listaFotos[2]; ?>
			<?php echo $foto->getTituloFoto() ?> <?php MultiIdioma::gettexto("crearSubasta.foto") ?> 3: <input type="file" name="foto3" />&nbsp; Eliminar: <input type="checkbox" name="eliminar_foto3" value="1"  /><br />
        </div>
   </div>
    
	
    	<div class="box_text_ancho ult_campo" >
			<input type="submit" value="<?php MultiIdioma::gettexto("comun.modificar") ?>" >
			<input type="button" value="<?php MultiIdioma::gettexto("comun.volver") ?>" onclick="javascript:history.back()" />
		</div>
    	
         		      
   
</form>

    	
   
</div>
<?php
	include HTML_ADMIN_PATH."/pie.php";
?>