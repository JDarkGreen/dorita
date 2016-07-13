<?php /* Template Name: Página Videos Plantilla */ ?>

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
	<section class="pageWrapper__content pageGallery">

		<!-- Sección con Padding -->
		<section class="sectionCommonPadding">
			<!-- Título de Página --> <h2 class="pageSectionCommon__title pageSectionCommon__title--orange text-uppercase"> <?= __(  "videos" , LANG ); ?> </h2>

			<!-- Contenido de Galería -->
			<section class="pageGallery__content">
				<?php  
					/**
					* Conseguir la Galería
					*/
					$args = array(
						'order'          => 'DESC',
						'orderby'        => 'date',
						'post_status'    => 'publish',
						'post_type'      => 'galery-videos',
						'posts_per_page' => -1,
					);
					$total_items = get_posts( $args );

					/* numero de post con esta taxonomia */
					$number_articulos = count( $total_items ); 

					/* número de cuantos post quieres presentar por página */
					$post_per_page  = 2;

					/* Wrapper for slider */

					/*
					*  Attributos disponibles 
					* data-items = number , data-items-responsive = number_mobile ,
					* data-margins = margin_in_pixels , data-dots = true or false
					* if data-autoplay false then not autoplay else true ;
					*/
					?>

					<div id="carousel-galery-videos" class="section__single_gallery js-carousel-gallery" data-items="1" data-items-responsive="1" data-margins="5" data-dots="false" data-autoplay="false">

					<?php  
						/* división para saber el número total de paginación */
						$number_items = floor( $number_articulos / $post_per_page );

						$repeat_items = 1 +  $number_items; 

						/* repeticiones */
						for( $i = 0 ; $i < $repeat_items ; $i++ ){ 
					?>  <!-- Seccion que contendrá los videos por el numero de pagina seteado -->

					<section class="pageGallery__section">
						<div class="row">
							<?php 
								/* argumentos y videos */
								$args2 = array(
									'order'          => 'ASC',
									'orderby'        => 'menu_order',
									'post_status'    => 'publish',
									'post_type'      => 'galery-videos',
									'posts_per_page' => $post_per_page,
									'offset'         => $i * $post_per_page,
								);
								/* videos */
								$videos = get_posts( $args2 );
								foreach( $videos as $video ) :
							?> <!--  video -->
								<div class="col-xs-12 col-md-6">
									<article class="item-gallery">

										<!-- Video -->
										<?php 
											$link_video = get_post_meta( $video->ID , 'mb_url_video_text' , true );
											$link_video = str_replace( 'watch?v=' , 'embed/' , $link_video);
										?> 
										<iframe src="<?= $link_video; ?>" frameborder="0" allowfullscreen ></iframe>

										<!-- TITULO -->
										<h3 class="item-gallery-title text-md-left text-xs-center">
										<strong><?php _e( $video->post_title , LANG ); ?></strong></h3>

										<!-- TEXTO -->
										<div class="item-gallery-content">
											<?php _e( $video->post_content , LANG ); ?>
										</div><!-- /.item-gallery-content -->

										<!-- Limpiar float --> <div class="clearfix"></div>
									</article><!-- /.sectionPage__articles__item -->
								</div> <!-- /.col-xs-12 col-md-4 -->
							<?php endforeach; ?>
						</div> <!-- /.row -->
					</section> <!-- /.pagePreview_post -->		

					<?php } /* end for */?>

				</div> <!-- /. fin de contenedor para slider -->

			</section> <!-- /-pageGallery__content -->

			<!-- FLECHAS DE GALERÍA -->
			<div class="relative">
				<!-- Flecha Izquierda --> 
				<a href="#" id="" class="arrow__common-slider js-carousel-prev arrowCarouselBlog-prev" data-slider="carousel-galery-videos">
					<i class="fa fa-arrow-left" aria-hidden="true"></i>
				</a>								
				<!-- Flecha Derecha --> 
				<a href="#" id="" class="arrow__common-slider js-carousel-next arrowCarouselBlog-next" data-slider="carousel-galery-videos">
					<i class="fa fa-arrow-right" aria-hidden="true"></i>
				</a>
			</div> <!-- /. -->				

		</section> <!-- /.sectionCommonPadding -->

	</section> <!-- /.pageWrapper__content -->

</main> <!-- /.pageWrapper -->


<!-- Footer -->
<?php get_footer(); ?>