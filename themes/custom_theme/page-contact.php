<?php /* Template Name: Página Contacto Plantilla */ ?>

<!-- Header -->
<?php 
	get_header(); 
	$theme_mod = get_theme_mod('theme_custom_settings'); 
?>  

<!-- Incluir Banner de Pagina -->
<?php
	global $post; //Objeto actual - Pagina 
	$banner = $post;  // Seteamos la variable banner de acuerdo al post
	include( locate_template("partials/banner-common-pages.php") ); 
?>

<!-- Contenedor Principal -->
<main class="">
	
	<!-- Contenedor Contenido -->
	<section class="pageWrapper__content pageContacto">

		<!-- Sección con Padding -->
		<section class="sectionCommonPadding">
			<!-- Título de Página --> <h2 class="pageSectionCommon__title pageSectionCommon__title--orange text-uppercase"> <?= __(  $post->post_title , LANG ); ?> </h2>

			<!-- Datos de Empresa -->
			<ul class="pageCommon__list-data pageCommon__list-data--gray text-xs-left">
				<!-- Teléfonos -->
				<?php if( isset($theme_mod['contact_tel']) && !empty($theme_mod['contact_tel']) ) : ?>
					<li> <!-- Imagen --> 
						<i> <img src="<?= IMAGES ?>/icon/iconos_contacto_telefono.png" alt="" class="img-fluid" /></i>

						<?php 
							/* Extraer todos los teléfonos y convertirlos en array*/ 
							$telefonos  = explode(",", $theme_mod['contact_tel'] );
							for( $i = 0 ; $i < count($telefonos) ; $i++ )
							{
								$separacion = $i != count($telefonos) -1 ? " / " : "";
								echo $telefonos[$i] . $separacion;
							} 
						?>
					</li>
				<?php endif; ?>								
				<!-- Celular -->
				<?php if( isset($theme_mod['contact_cel']) && !empty($theme_mod['contact_cel']) ) : ?>
					<li> <!-- Imagen --> 
						<i> <img src="<?= IMAGES ?>/icon/iconos_contacto_rpm.png" alt="" class="img-fluid" /></i>

						<?php 
							/* Extraer todos los celulares y convertirlos en array*/ 
							$celulares  = explode(",", $theme_mod['contact_cel'] );
							for( $i = 0 ; $i < count($celulares) ; $i++ )
							{
								$separacion = $i != count($celulares) -1 ? " / " : "";
								echo $celulares[$i] . $separacion;
							} 
						?>
					</li>
				<?php endif; ?>								
				<!-- Email -->
				<?php if( isset($theme_mod['contact_email']) && !empty($theme_mod['contact_email']) ) : ?>
					<li> <!-- Imagen --> 
						<i> <img src="<?= IMAGES ?>/icon/iconos_contacto_mail.png" alt="" class="img-fluid" /></i>
						<?=  $theme_mod['contact_email']; ?>
					</li>
				<?php endif; ?>
			</ul> <!-- /.mainFooter__list-data -->			
			

		</section> <!-- /.sectionCommonPadding -->
		
	</section> <!-- /.pageWrapper__content -->

</main> <!-- /.pageWrapper -->

<!-- Script Google Mapa -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNMUy9phyQwIbQgX3VujkkoV26-LxjbG0"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<!-- Scripts Solo para esta plantilla -->
<?php 
	if( !empty($theme_mod['contact_mapa']) ) : 
	$mapa = explode(',', $theme_mod['contact_mapa'] ); 

	$zoom_mapa = isset( $theme_mod['contact_mapa_zoom'] ) && !empty( $theme_mod['contact_mapa_zoom'] ) ? $theme_mod['contact_mapa_zoom'] : 16;
?>
	<script type="text/javascript">	

		<?php  
			$lat = $mapa[0];
			$lng = $mapa[1];
		?>

	    var map;
	    var lat = <?= $lat ?>;
	    var lng = <?= $lng ?>;

	    function initialize() {
	      //crear mapa
	      map = new google.maps.Map(document.getElementById('canvas-map'), {
	        center: {lat: lat, lng: lng},
	        zoom  : <?= $zoom_mapa; ?>,
	      });

	      //infowindow
	      var infowindow    = new google.maps.InfoWindow({
	        content: '<?= "TRIBUTARY S.A.C" ?>'
	      });

	      //icono
	      //var icono = "<?= IMAGES ?>/icon/contacto_icono_mapa.jpg";

	      //crear marcador
	      marker = new google.maps.Marker({
	        map      : map,
	        draggable: false,
	        animation: google.maps.Animation.DROP,
	        position : {lat: lat, lng: lng},
	        title    : "<?php _e(bloginfo('name') , LANG )?>",
	        //icon     : "<?= IMAGES . '/icon/icon_map.png' ?>",
	      });
	      //marker.addListener('click', toggleBounce);
	      marker.addListener('click', function() {
	        infowindow.open( map, marker);
	      });
	    }

	    google.maps.event.addDomListener(window, "load", initialize);

	</script>
<?php endif; ?>

<!-- Footer -->
<?php get_footer(); ?>