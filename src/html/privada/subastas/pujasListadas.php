<?php
	/**
	 * Plantilla con el listado de pujas para incorporar en los detalles de subasta
	 * @author Miguel Callon
	 */
?>
	<div class="box_text_content">
		<?php if ($paginadoBean->getNumElemTotal() == 0) { ?>
		<div class="box_text_ancho">
			<?php MultiIdioma::gettexto("subastas.pujasNoList") ?>
		</div>
	</div>
		<?php } else { ?>
	</div>
			<div class="box_text_content">
				<div class="box_text_pujas lista_head"><?php MultiIdioma::gettexto("consultarSubasta.usuario") ?></div>
				<div class="box_text_pujas lista_head"><?php MultiIdioma::gettexto("consultarSubasta.fecha") ?></div>
				<div class="box_text_pujas lista_head"><?php MultiIdioma::gettexto("consultarSubasta.hora") ?></div>
				<div class="box_text_pujas ult_campo lista_head"><?php MultiIdioma::gettexto("consultarSubasta.puja") ?></div>
			</div>
		<?php 
			foreach ($subastaBean->getListaPujas() as $puja) {
		?>
			<div class="box_text_content">
				<div class="box_text_pujas"><?php echo $puja->getUsuarioPuja()->getUsuario() ?></div>
				<div class="box_text_pujas"><?php echo $puja->getFechaPuja() ?></div>
				<div class="box_text_pujas"><?php echo $puja->getHoraPuja() ?></div>
				<div class="box_text_pujas ult_campo"><?php echo $puja->getCantPujada() ?> &euro;</div>
			</div>
			<div class="box_text_content">
				<div class="linea"><hr/></div>
			</div>
		<?php
			}
		?>
			<div class="box_text_content">
			  	<div class="box_text_ancho">
			 	  <?php include HTML_PRIVADA_SUBASTAS_PATH."/paginadoSubasta.php"; ?>
			    </div>
			</div>
		<?php } ?>