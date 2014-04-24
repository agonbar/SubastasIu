<?php
    /**
 * Pagina mostrada al listar los usuarios del sistema
 * @author Nuria Canle
 */
 
 	include HTML_ADMIN_PATH."/cabecera.php";
	
?>
<style type="text/css" media="screen">
	#tablaB{
		margin-left:150px;
	}
	#tablaB input{
		margin-right:40px;
	}
	
	#botones{
		margin-top:20px;
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
	

<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <h2><?php MultiIdioma::gettexto("menu.pedidos"); ?></h2>

    </div>
    
<form id="form" action="index.php" >
	<div class="box_text_content" id="tablaB">
<table>
<tr>
<td><label></label><?php MultiIdioma::gettexto("usuarios.id") ?><label> </td>
<td>	<input type="text" name="idUsuario" value="<?php echo $busquedaUsuariosBean->getIdUsuario() ?>" /></td>
<td><label><?php MultiIdioma::gettexto("usuarios.usuario") ?><label> </td>
<td>	<input type="text" name="usuario" value="<?php echo $busquedaUsuariosBean->getUsuario() ?>" /></td>
<td></td>
</tr>

<tr>
<td><label><?php MultiIdioma::gettexto("usuarios.nombre") ?><label> </td>
<td>	<input type="text" name="nombre" value="<?php echo $busquedaUsuariosBean->getNombre() ?>" /></td>
<td><label><?php MultiIdioma::gettexto("usuarios.apellidos") ?><label> </td>
<td>	<input type="text" name="apellidos" value="<?php echo $busquedaUsuariosBean->getApellidos() ?>" /></td>
<td><input type="submit" value="Buscar" onClick="control('ListarUsuariosControlador','buscarUsuariosAdmin'); document.getElementById('form').submit()" /></td>
</tr>
</table>
<input id="controlador" type="hidden" name="controlador" value="ListarUsuariosControlador" />
<input id="accion" type="hidden" name="accion" value="buscarUsuariosAdmin" />
</div>

<div class="box_text_content">
	  	<div class="box_text_ancho">
	 	  <?php include HTML_PATH."/paginadoTop.php"; ?>
	    </div>
	</div>

<table id="tabla">
	<tr>
		<th><input type="checkbox" name="checktodos" value="todos"></th>
		<th><?php MultiIdioma::gettexto("usuarios.id") ?></th>
		<th><?php MultiIdioma::gettexto("usuarios.usuario") ?></th>
		<th><?php MultiIdioma::gettexto("usuarios.nombre") ?></th>
		<th><?php MultiIdioma::gettexto("usuarios.apellidos") ?></th>
		<th><?php MultiIdioma::gettexto("usuarios.email") ?></th>
	</tr>
<?php
    foreach ($listaUsuarios as $usuario) {
?>
	<tr>
		<td><input type="checkbox" name="idOption[]" class="option" value=<?php echo $usuario->getIdUsuario()?>></td>
		<td><a href="/index.php?controlador=ConsultarUsuarioAdminControlador&accion=consultarDatos&idOption=<?php echo $usuario->getIdUsuario() ?>"><?php echo $usuario->getIdUsuario() ?></a></td>
		<td><?php echo $usuario->getUsuario() ?></td>
		<td><?php echo $usuario->getNombre() ?></td>
		<td><?php echo $usuario->getApellidos() ?></td>
		<td><?php echo $usuario->getEmail() ?></td>
	</tr>
<?php
	}
?>
</table>

<div class="box_text_content">
	  	<div class="box_text_ancho">
	 	  <?php include HTML_PATH."/paginado.php"; ?>
	    </div>
	</div>
	
	<div class="box_text_ancho ult_campo" id="botones">
			<input type="button" onClick="control('CrearUsuarioPrivilegiadoControlador','crearUsuarioPrivilegiado'); document.getElementById('form').submit()" value="<?php MultiIdioma::gettexto("comun.crear") ?>" >
			<input type="button" onClick="control('ConsultarUsuarioAdminControlador','consultarDatos'); document.getElementById('form').submit()" value="<?php MultiIdioma::gettexto("comun.consultar") ?>" >
			<input  type="button" onClick="control('ModificarUsuarioControlador','mostrarFormulario'); document.getElementById('form').submit()" value="<?php MultiIdioma::gettexto("comun.modificar") ?>" />
			<input type="button" onClick="control('BajaUsuarioControlador','bajaComponente'); document.getElementById('form').submit()" value="<?php MultiIdioma::gettexto("comun.eliminar") ?>" >
		</div>
	
</form>

</div>

<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>