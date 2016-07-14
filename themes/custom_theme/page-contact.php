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

		<div class="row">
			
			<!-- 1.- Primera Sección -->
			<div class="col-xs-12 col-md-6">

				<!-- Sección con Padding -->
				<section class="sectionCommonPadding relative">	
					<!-- Título de Página --> <h2 class="pageSectionCommon__title pageSectionCommon__title--orange text-uppercase"> <?= __(  $post->post_title , LANG ); ?> </h2>

					<!-- Datos de Empresa -->
					<ul class="pageCommon__list-data pageCommon__list-data--gray text-xs-left">

						<!-- Teléfonos -->
						<?php if( isset($theme_mod['contact_tel']) && !empty($theme_mod['contact_tel']) ) : ?>
							<li> <!-- Imagen --> 
								<i> <img src="<?= IMAGES ?>/icon/iconos_contacto_telefono_black.png" alt="" class="img-fluid" /></i>

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
								<i> <img src="<?= IMAGES ?>/icon/iconos_contacto_rpm_black.png" alt="" class="img-fluid" /></i>

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
								<i> <img src="<?= IMAGES ?>/icon/iconos_contacto_mail_black.png" alt="" class="img-fluid" /></i>
								<?=  $theme_mod['contact_email']; ?>
							</li>
						<?php endif; ?>

						<!-- Ubicación -->
						<?php if( isset($theme_mod['contact_address']) && !empty($theme_mod['contact_address']) ) : ?>
						<li> 
							<!-- Imagen --> <i> <img src="<?= IMAGES ?>/icon/iconos_contacto_direccion_black.png" alt="" class="img-fluid" /></i>
							<?= apply_filters("the_content" , $theme_mod['contact_address'] ); ?>
						</li>
						<?php endif; ?>

					</ul> <!-- /.mainFooter__list-data -->	

					<!-- Separación --> <br/><br/>

					<!-- Redes Sociales -->
					<h3 class="text-capitalize"><?php _e("redes sociales" , LANG ); ?></h3>

					<ul class="social-links social-links--gray text-xs-center">
						<!-- Facebook -->
						<?php if( isset($theme_mod['red_social_fb']) && !empty($theme_mod['red_social_fb']) ): ?>
							<li> 
								<a href="<?= $theme_mod['red_social_fb']; ?>" target="_blank">
									<!-- Icon -->  
									<i class="fa fa-facebook" aria-hidden="true"></i>
								</a>
							</li>
						<?php endif; ?>								
						<!-- Twitter -->
						<?php if( isset($theme_mod['red_social_twitter']) && !empty($theme_mod['red_social_twitter']) ): ?>
							<li> 
								<a href="<?= $theme_mod['red_social_twitter']; ?>" target="_blank">
									<!-- Icon -->  
									<i class="fa fa-twitter" aria-hidden="true"></i>
								</a>
							</li>
						<?php endif; ?>								
						<!-- Youtube -->
						<?php if( isset($theme_mod['red_social_ytube']) && !empty($theme_mod['red_social_ytube']) ): ?>
							<li> 
								<a href="<?= $theme_mod['red_social_ytube']; ?>" target="_blank">
									<!-- Icon -->  
									<i class="fa fa-youtube" aria-hidden="true"></i>
								</a>
							</li>
						<?php endif; ?>
					</ul> <!-- /.social-links -->							
				</section> <!-- /.sectionCommonPadding relative -->	

			</div> <!-- /.col-xs-12 col-md-6 -->

			<!--2.- Segunda Sección -->
			<div class="col-xs-12 col-md-6">
				<!-- SECCIÓN DE FORMULARIO -->
				<section class="pageContacto__formulary">
					<!-- Titulo --> <h2 class="text-capitalize"><?php _e( "formulario" , LANG ); ?></h2>

					<!-- Formulario -->
					<form id="form-contacto" action="" class="pageContacto__form" method="POST">

						<!-- Nombre -->
						<div class="pageContacto__form__group">
							<label for="input_name" class="sr-only"></label>
							<input type="text" id="input_name" name="input_name" placeholder="<?php _e( 'Nombre', LANG ); ?>" required />
						</div> <!-- /.pageContacto__form__group -->

						<!-- Email -->
						<div class="pageContacto__form__group">
							<label for="input_email" class="sr-only"></label>
							<input type="email" id="input_email" name="input_email" placeholder="<?php _e( 'E-mail', LANG ); ?>" data-parsley-trigger="change" required="" data-parsley-type-message="Escribe un email válido"/>
						</div> <!-- /.pageContacto__form__group -->						

						<!-- Teléfono -->
						<div class="pageContacto__form__group">
							<label for="input_phone" class="sr-only"></label>
							<input type="text" id="input_phone" name="input_phone" placeholder="<?php _e( 'Teléfono', LANG ); ?>" data-parsley-type='digits' data-parsley-type-message="Solo debe contener números" required="" />
						</div> <!-- /.pageContacto__form__group -->

						<!-- Asunto --> <?php /*
						<div class="pageContacto__form__group">
							<label for="input_subject" class="sr-only"></label>
							<input type="text" id="input_subject" name="input_subject" placeholder="<?php _e( 'Asunto', LANG ); ?>" required />
						</div> <!-- /.pageContacto__form__group --> */ ?>

						<!-- Mensaje -->
						<div class="pageContacto__form__group">
							<label for="input_consulta" class="sr-only"></label>
							<textarea name="input_consulta" id="input_consulta" placeholder="<?php _e( 'Mensaje', LANG ); ?>" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Necesitas más de 20 caracteres" data-parsley-validation-threshold="10"></textarea>
						</div> <!-- /.pageContacto__form__group -->

						<!-- Boton Centrado -->
						<div class="center-block text-xs-center">
							<button type="submit" id="send-form" class="btnCommon__show-more btnCommon__show-more--reverse text-uppercase">
								<?php _e( 'enviar' , LANG ); ?>
							</button> <!-- /.btn__send-form -->
							
						</div> <!-- /.center-block text-xs-center -->

						<!-- Limpiar Floats  --> <div class="clearfix"></div>

					</form> <!-- /.pageContacto__form -->

				</section> <!-- /.pageContacto__formulary -->	

			</div> <!-- /.col-xs-12 col-md-6 -->
			
		</div> <!-- /.row -->

	</section> <!-- /.pageWrapper__content -->

	<!-- 2.- SECCION DE MAPA -->
	<div class="container pageContacto">
		<h3 class="text-capitalize"> <?php _e("mapa" , LANG ); ?></h3>
	</div> <!-- /. -->

	<!-- MAPA -->
	<?php if( !empty($theme_mod['contact_mapa']) ) : ?>
		<section class="pageContacto__mapa">
			<div id="canvas-map"></div>

			<!-- Separación --> <br><br><br><br>
			
		</section> <!-- /.pageContacto__mapa -->
	<?php else: ?>
		<p><?php _e( 'Información no disponible actualmente' , LANG ); ?></p>
	<?php endif; ?>	

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