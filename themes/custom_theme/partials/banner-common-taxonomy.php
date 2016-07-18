<?php  
/**
* Banner Común de Página específicamente para las taxonomías
* creado un campo personalizado para ellas
**/
?>

<!-- SI EXISTE EL OBJETO -->
<?php if( isset($banner) ) : ?>
	
	<!-- BANNER DE LA PAGINA -->
	<section class="pageCommon__banner relative">
		<!-- Conseguir el banner por defecto -->
		<?php 
			//obtener opciones del termino
			$opciones_termino = get_option( 'taxonomy_' . $banner->term_id );
			//obtener imagen de banner
			$img_banner       = $opciones_termino['theme_tax_banner_img'];

			if( empty($img_banner) || $img_banner == -1 ) {
				$img_banner = "https://placeimg.com/1920/207/any";
			}
		?>
		<figure style='background-image: url("<?= $img_banner; ?>")'>
			<!--img src="<?= $img_banner ?>" alt="banner-nosotros-empresa-tributary" class="img-fluid hidden-xs-down" /-->
		</figure>

	</section> <!-- /.pageCommon__banner -->

<?php endif; ?>