<?php
/**
 * Listado de componentes para asignar a una subasta
 * @author Miguel Callon
 */
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./recursos/css/style_mini.css" media="screen">
<script src="./recursos/js/jquery-1.7.2.js"></script>
<script src="./recursos/js/jquery-ui.js"></script>
</head>
<body>
<form action="index.php">
<input type="hidden" name="controlador" value="ListarCompCrearSubControlador" />
<input type="hidden" name="accion" value="buscarComponentes" />
<p><input type="text" name="nombre" value="<? echo $busquedaComponentesBean->getNombre() ?>" >
<input type="submit" value="Buscar" />
</p>
</form>

	<div id="main_content">
		<div class="box_content">
	<?php if ($paginadoBean->getNumElemTotal() == 0) { ?>
		<?php MultiIdioma::gettexto("compListadosCrearSub.ningun_componente") ?>
		</div>
	</div>

	<? } else { ?>
					
			<div class="box_text_content">
				<div class="box_text_listar_comp">
					<?php MultiIdioma::gettexto("compListadosCrearSub.nombre") ?>
				</div>
				<div class="box_text_listar_comp_mini">
					<?php MultiIdioma::gettexto("compListadosCrearSub.precio") ?>
				</div>
				<div class="box_text_listar_comp_mini">
					<?php MultiIdioma::gettexto("compListadosCrearSub.unidades_stock") ?>
				</div>
				<div class="box_text_listar_comp_mini">
					&nbsp;
				</div>
			</div>
			<div class="box_text_content">
				<div class="linea"><hr/></div>
			</div>
			<?php
			    foreach ($listaComponentes as $componente) {
			?>
			<div class="box_text_content">
				<div class="box_text_listar_comp">
					<?php echo $componente->getNombre() ?>
				</div>
				<div class="box_text_listar_comp_mini">
					<?php echo $componente->getPrecio() ?>
				</div>
				<div class="box_text_listar_comp_mini">
					<?php echo $componente->getUnidadesStock() ?>
				</div>
				<div class="box_text_listar_comp_mini">
					<a href="" class="details" id="<?php echo $componente->getIdComponente() ?>"><?php MultiIdioma::gettexto("compListadosCrearSub.seleccionar") ?></a>
				</div>
			</div>
			<div class="box_text_content">
				<div class="linea"><hr/></div>
			</div>
			<script>
				$(function(){
					$('#<?php echo $componente->getIdComponente() ?>').on('click',function(eEvento){		
						//prevenir el comportamiento normal del enlace
						eEvento.preventDefault();
						$('#idCompSub', window.parent.document).val('<?php echo $componente->getIdComponente() ?>');
						$('#nombre', window.parent.document).val('<?php echo $componente->getNombre() ?>');
						
						// Eliminamos el div que hace el efecto de modal
						$("#bgtransparent", window.parent.document).remove();
							
						$miElemento = $(".clsVentanaCerrar", window.parent.document);
						//buscamos la ventana padre (del boton "cerrar")
						var $objVentana=$($miElemento.parents().get(1));
						
						//cerramos la ventana suavemente
						$objVentana.fadeOut(300,function(){
							//eliminamos la ventana del DOM
							$miElemento.remove();
							//ocultamos el overlay suavemente
							$('#divOverlay').fadeOut(500,function(){
								//eliminamos el overlay del DOM
								$miElemento.remove();
							});
						});
				
					});
				});
			</script>
			<?php
				}
			?>	
		</div>
	</div>
<?php
	include HTML_PATH."/paginado.php";
?>
<? } ?>
</body>
</html>