<?php /* Template Name: Página Nosotros Plantilla */ ?>

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
	<section class="pageWrapper__content pageNosotros">
		
		<!-- Título de Página --> <h2 class="pageSectionCommon__title pageSectionCommon__title--orange text-uppercase"> <?= __(  $post->post_title , LANG ); ?> </h2>

		<!-- Subtítulo de Página --> 
		<h3 class="pageSectionCommon__subtitle"> 
			<?= !empty($post->post_excerpt) ? $post->post_excerpt : "Nuestra Historia"; ?>
		</h3> <!-- /.pageSectionCommon__subtitle -->

		<!-- Seccion de Contenido y galería -->
		<section class="row">
			<!-- Contenido -->
			<div class="col-xs-12 col-md-6">
				<?= !empty($post->post_content) ? apply_filters("the_content" , $post->post_content  ) : "" ; ?>
			</div> <!-- /.col-xs-12 col-md-6 -->
			<!-- Galería -->
			<div class="col-xs-12 col-md-6">

				<!-- Contenedor Relativo -->
				<section class="relative">
					<!-- Contenedor de Galería [ ] -->
					<?php  
						/*
						*  Attributos disponibles 
						* data-items = number , data-items-responsive = number_mobile ,
						* data-margins = margin_in_pixels , data-dots = true or false 
						*data autoplay = true or false
						*/
					?>

					<div id="carousel-nosotros" class="section__single_gallery js-carousel-gallery" data-items="1" data-items-responsive="1" data-margins="5" data-dots="false" data-autoplay="true">
						<!-- Obtener todas las habitaciones -->
						<?php  
							$input_ids_img  = get_post_meta($post->ID, 'imageurls_'.$post->ID , true);
							//convertir en arreglo
							$input_ids_img  = explode(',', $input_ids_img ); 
							//Eliminar numeros negativos
							$remove_array   = array(-1);
							$input_ids_img  = array_diff( $input_ids_img , $remove_array ); 

							//Hacer loop por cada item de arreglo
							foreach ( $input_ids_img as $item_img ) : 
								//Si es diferente de null o tiene elementos
								if( !empty($item_img) ) : 
								//Conseguir todos los datos de este item
								$item = get_post( $item_img  ); 
						?> <!-- Artículo -->
							<article class="item-nosotros relative">
								<!-- Imagen -->
								<figure><img src="<?= $item->guid; ?>" alt="<?= $item->post_title; ?>" class="img-fluid" /></figure>
							</article> <!-- /.item-nosotros -->

						<?php endif; endforeach; ?>
					</div> <!-- /.section__single_gallery -->

					<!-- Flechas de Carousel Ocultar en mobile -->
					<div class="text-xs-center hidden-xs-down">
						<!-- Flecha Izquierda -->
						<a href="#" id="" class="arrow__common-slider js-carousel-prev arrowCarouselNosotros-prev" data-slider="carousel-nosotros">
							<i class="fa fa-arrow-left" aria-hidden="true"></i>
						</a>							
						<!-- Flecha Derecha -->
						<a href="#" id="" class="arrow__common-slider js-carousel-next arrowCarouselNosotros-next" data-slider="carousel-nosotros">
							<i class="fa fa-arrow-right" aria-hidden="true"></i>
						</a>
					</div> <!-- /.text-xs-center  -->	

				</section> <!-- /.relative -->	

			</div> <!-- /.col-xs-12 col-md-6 -->			
		</section> <!-- /.row -->

	</section> <!-- /.pageWrapper__content -->

</main> <!-- /.pageWrapper -->


<!-- Footer -->
<?php get_footer(); ?>