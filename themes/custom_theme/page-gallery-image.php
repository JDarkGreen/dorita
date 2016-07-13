<?php /* Template Name: Página Fotos Imagen Plantilla */ ?>

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
			<!-- Título de Página --> <h2 class="pageSectionCommon__title pageSectionCommon__title--orange text-uppercase"> <?= __(  "fotos" , LANG ); ?> </h2>

			<!-- Contenido de Galería -->
			<section class="pageGallery__content">
				<?php  
					/**
					* Conseguir la Primera Galería
					*/
					$args = array(
						'order'          => 'ASC',
						'orderby'        => 'date',
						'post_status'    => 'publish',
						'post_type'      => 'galery-images',
						'posts_per_page' => 1,
					);
					$galery_master = get_posts( $args );
					$galery_master = $galery_master[0];

					//Seteando la variable para obtener el valor del array
					//de la galería de este post
					$item_type_post = $galery_master;

					//Obtenemos todos los items en este caso de la galería
					$input_ids_img  = get_post_meta($item_type_post->ID, 'imageurls_'.$item_type_post->ID , true);
					//convertir en arreglo
					$input_ids_img  = explode(',', $input_ids_img ); 
					//Eliminar numeros negativos
					$remove_array   = array(-1);
					$input_ids_img  = array_diff( $input_ids_img , $remove_array ); 

					//Seteamos cuantos items irán por página
					$post_per_page = 6;
				?>
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

						<div id="carousel-gallery-fotos" class="section__single_gallery js-carousel-gallery" data-items="1" data-items-responsive="1" data-margins="5" data-dots="false" data-autoplay="false">
							
							<?php
								/* división para saber el número total de paginación */
								$number_items = floor( count($input_ids_img) / $post_per_page );
								$repeat_items = 1 +  $number_items; 
								/* repeticiones */
								for( $i = 0 ; $i < $repeat_items ; $i++ ){ ?>

							<!-- SECCION CONTENEDOR DE ITEMS -->
							<section class="pageGallery__section">	
								<div class="row">	
									<?php
										//Hacer loop por cada item de arreglo
										//con un offset o paso despues de x 
										//elementos 
										$inicio_array = ( ($post_per_page - 1 ) * $i ) + $i;
										$fin_array    = $inicio_array + $post_per_page;

										$new_array_img = array_slice( $input_ids_img , $inicio_array , $fin_array );

										//var_dump($new_array_img);

										foreach ( $new_array_img as $item_img ) : 
											//Si es diferente de null o tiene elementos
											if( !empty($item_img) ) : 
											//Conseguir todos los datos de este item
											$item = get_post( $item_img  );
									?> <!-- Artículo -->
										<div class="col-xs-12 col-md-4">
											<article class="item-gallery relative">
												<!-- LINK -->
												<a href="<?= $item->guid; ?>" class="gallery-fancybox center-block relative" rel="group" title="<?= !empty($item->post_content) ? $item->post_content : "Image"; ?>">
													<!-- Imagen -->
													<figure><img src="<?= $item->guid; ?>" alt="<?= $item->post_title; ?>" class="img-fluid" /></figure>

													<!-- Hover Imagen -->
													<div class="container-hover container-flex align-content">
														<!-- Icon plus -->
														<div class="fullwidth">
															<i class="fa fa-plus container-flex align-content" aria-hidden="true"></i>
														</div> <!-- /center-block -->
														<!-- Name Image o Descripción -->
														<?= !empty($item->post_content) ? $item->post_content : "Image"; ?>
													</div> <!-- /-container-hover -->
													
												</a> <!-- /.gallery-fancybox -->

											</article> <!-- /.item-gallery -->
										</div> <!-- /(.col-xs-12 col-md-4) -->

									<?php endif; endforeach; ?>
								</div> <!-- /.row -->
							</section> <!-- /.pageGallery__section -->

							<!-- Finalización de las Repeticiones -->
							<?php } ?>

						</div> <!-- /.section__single_gallery -->

					</section> <!-- /.relative -->	

			</section> <!-- /-pageGallery__content -->

			<!-- FLECHAS DE GALERÍA -->
			<div class="relative">
				<!-- Flecha Izquierda --> 
				<a href="#" id="" class="arrow__common-slider js-carousel-prev arrowCarouselBlog-prev" data-slider="carousel-gallery-fotos">
					<i class="fa fa-arrow-left" aria-hidden="true"></i>
				</a>								
				<!-- Flecha Derecha --> 
				<a href="#" id="" class="arrow__common-slider js-carousel-next arrowCarouselBlog-next" data-slider="carousel-gallery-fotos">
					<i class="fa fa-arrow-right" aria-hidden="true"></i>
				</a>
			</div> <!-- /. -->				

		</section> <!-- /.sectionCommonPadding -->

	</section> <!-- /.pageWrapper__content -->

</main> <!-- /.pageWrapper -->


<!-- Footer -->
<?php get_footer(); ?>