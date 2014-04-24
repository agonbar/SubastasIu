<?php
	
	include HTML_ADMIN_PATH."/cabecera.php";
?>

<script>
 $(document).ready(function(){
 
	//Checkbox
	$("input[name=checktodos]").change(function(){
		$('input[type=checkbox]').each( function() {			
			if($("input[name=checktodos]:checked").length == 1){
				this.checked = true;
			} else {
				this.checked = false;
			}
		});
	});
	
	$(".option").change(function(){
		if($('input[name=checktodos]').is(':checked')==true){
				
				$('input[name=checktodos]').prop("checked","");
			}
		
		
		});
});
 </script>

<script>	
 function control(controlador,accion){
	

	document.getElementById("controlador").value=controlador;
    document.getElementById("accion").value=accion;
    
  
    
}	
	
</script>


<style>
	
	#botones{
		margin-left:50px;
		width:690px;
		
	}
	
	#tabla{
		width:698px;
		margin-left:70px;
		text-align:center;
		margin-bottom:30px;
		padding-top:30px;
	}
	
</style>
<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php" ><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
		<li><?php MultiIdioma::gettexto("menu.componentes"); ?></li>
    </ul>
</div>



<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <h2><?php MultiIdioma::gettexto("menu.componentes"); ?></h2>
    </div>


<form action="index.php" id="form" >
	  <div class="box_text_content" >
	  	
			<label><?php MultiIdioma::gettexto("componentesListados.componente"); ?></label><input type="text" name="nombre" value="<?php echo $busquedaComponentesBean->getNombre() ?>" />
			<label><?php MultiIdioma::gettexto("componentesListados.vendedor"); ?></label><input type="text" name="vendedor" value="<?php echo $busquedaComponentesBean->getUsuarioVendedor() ?>"/>
			<label><?php MultiIdioma::gettexto("componentesListados.precio"); ?></label><input type="text" name="precio" value="<?php echo $busquedaComponentesBean->getPrecio() ?>"/>
			  <input id="controlador" type="hidden" name="controlador" value="ModificarComponenteAdminControlador" />
				<input id="accion" type="hidden" name="accion" value="mostrarFormulario" />
    		
			<input type="button" value="Buscar" onClick="control('ListarComponentesAdminControlador','buscarComponentes'); document.getElementById('form').submit()" />
		
	  </div>
	  <div class="box_text_content">
	  	<div class="box_text_ancho">
	 	  <?php include HTML_PATH."/paginadoTop.php"; ?>
	    </div>
	  </div>

<table id="tabla">
	<tr>
		<th><input type="checkbox" name="checktodos" value="todos"></th>
		<th><?php MultiIdioma::gettexto("componentesListados.producto"); ?></th>
		<th><?php MultiIdioma::gettexto("componentesListados.precio"); ?></th>
		<th><?php MultiIdioma::gettexto("componentesListados.vendedor"); ?></th>
		<th><?php MultiIdioma::gettexto("componentesListados.descripcion"); ?></th>
		

		
	</tr>
<?php
    foreach ($listaComponentes as $componente) {
?>
	<tr>
		<td><input type="checkbox" name="idOption[]" class="option" value=<?php echo $componente->getIdComponente()?>></td>
		<td><?php echo $componente->getNombre() ?></td>
		<td><?php echo $componente->getPrecio() ?> &euro;</td>
		<td><?php echo $componente->getUsuarioVendedor()->getUsuario();?></td>
		<td><?php echo $componente->getDescripcionBreve(); ?></td>
	</tr>
<?php
	}
?>
</table>

<div class="box_text_ancho ult_campo" id="botones">
			<input type="button" onClick="control('AltaComponenteAdminControlador','mostrarFormulario'); document.getElementById('form').submit()" value="<?php MultiIdioma::gettexto("comun.crear") ?>" >
			<input type="button" onClick="control('ConsultarComponenteAdminControlador','consultarComponente'); document.getElementById('form').submit()" value="<?php MultiIdioma::gettexto("comun.consultar") ?>" >
			<input  type="button" onClick="control('ModificarComponenteAdminControlador','mostrarFormulario'); document.getElementById('form').submit()" value="<?php MultiIdioma::gettexto("comun.modificar") ?>" />
			<input type="button" onClick="control('BajaComponenteAdminControlador','bajaComponente'); document.getElementById('form').submit()" value="<?php MultiIdioma::gettexto("comun.eliminar") ?>" >
		</div>




   
    <div class="box_text_content">
	  	<div class="box_text_ancho">
	 	  <?php include HTML_PATH."/paginado.php"; ?>
	    </div>
	</div>
</form>
</div>


<?php
	include HTML_ADMIN_PATH."/pie.php";
?>