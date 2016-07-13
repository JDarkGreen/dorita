<?php /* Archivo contiene Carousel de Contenido de Blog */ ?>

<?php 

	/* Extraer todas las categorías padre */  
	$categorias = get_categories( array(
		'orderby' => 'name' , 'parent' => 0,
	) );

	/* Extraer la primera categoría y si es una página de categoría o taxonomía 
	* setear esta como principal
	**/
	$the_cat_principal = isset($the_cat_page) && !empty($the_cat_page) ? $the_cat_page : "";

	#$categorias[0];

	/* Vamos a obtener todos los post */
	$args = array(
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_status'    => 'publish',
		'post_type'      => 'post',
		'posts_per_page' => -1,
		'category_name'  => $the_cat_principal->slug,
	);
	$total_items = get_posts( $args );

	/* numero de post con esta taxonomia */
	$number_articulos = count( $total_items ); 

	/* número de cuantos post quieres presentar por página */
	$post_per_page  = isset($posts_on_page) && !empty($posts_on_page) ? $posts_on_page : 3;

	/* Si el número de post es mayor a la cantidad por presentar entonces
	* se hace un carousel */
	if ( $number_articulos > $post_per_page ) : 

		/* Wrapper for slider */

		/*
		*  Attributos disponibles 
		* data-items = number , data-items-responsive = number_mobile ,
		* data-margins = margin_in_pixels , data-dots = true or false
		* if data-autoplay false then not autoplay else true ;
		*/
	?>

	<div id="carousel-blog" class="section__single_gallery js-carousel-gallery" data-items="1" data-items-responsive="1" data-margins="5" data-dots="false" data-autoplay="false" >

		<?php  
			/* división para saber el número total de paginación */
			$number_items = floor( $number_articulos / $post_per_page );

			$repeat_items = 1 +  $number_items; 

			/* repeticiones */
			for( $i = 0 ; $i < $repeat_items ; $i++ ){ 
		?>  <!-- Seccion que contendrá los articulos o por la taxonomia categoria de proyecto por el numero de pagina seteado -->

			<section class="pagePreview_post">
				<div class="row">
					<?php 
						/* argumentos y articulos */
						$args2 = array(
							'order'          => 'DESC',
							'orderby'        => 'date',
							'post_status'    => 'publish',
							'post_type'      => 'post',
							'posts_per_page' => $post_per_page,
							'offset'         => $i * $post_per_page,
							'category_name'  => $the_cat_principal->slug,
						);
						/* articulos */
						$articulos = get_posts( $args2 );
						foreach( $articulos as $articulo ) :
					?> <!--  Articulo -->
						<div class="col-xs-12 col-md-4">
							<article class="articles-item">
								<!-- Imagen -->
								<figure class="">
									<a href="<?= get_permalink( $articulo->ID ); ?>">
									<?php 
										$image = get_the_post_thumbnail( $articulo->ID , 'full' , array('class'=>'img-fluid center-block imgNotBlur') ); 
										if( !empty($image) ) : echo $image;
										else:
									?>
										<img src="<?= IMAGES; ?>/actualizando-imagen.jpg" alt="lorempixel" class="img-fluid center-block imgNotBlur" />
									<?php endif; ?>
									</a>
								</figure><!-- /figure -->

								<!-- Texto -->
								<h3 class="articles-item-title text-xs-center">
								<?php _e( $articulo->post_title , LANG ); ?></h3>

								<!-- Limpiar float --> <div class="clearfix"></div>
							</article><!-- /.sectionPage__articles__item -->
						</div> <!-- /.col-xs-12 col-md-4 -->
					<?php endforeach; ?>
				</div> <!-- /.row -->
			</section> <!-- /.pagePreview_post -->		

		<?php } /* end for */?>

	</div> <!-- /. fin de contenedor para slider -->

	<!-- Flechas de Carousel -->
	<?php /*
	<div class="containerArrowBlog relative">
		<!-- Flecha Izquierda --> 
		<a href="#" id="" class="arrow__common-slider js-carousel-prev arrowCarouselBlog-prev" data-slider="carousel-blog">
			<i class="fa fa-chevron-left" aria-hidden="true"></i>
		</a>								
		<!-- Flecha Derecha --> 
		<a href="#" id="" class="arrow__common-slider js-carousel-next arrowCarouselBlog-next" data-slider="carousel-blog">
			<i class="fa fa-chevron-right" aria-hidden="true"></i>
		</a>
	</div> <!-- /. --> */?>

<!-- Sino hacer una seccion simple -->
<?php else: ?>
	
	<section class="pagePreview_post">
		<div class="row">
		<?php 
			/* argumentos y articulos */
			$args2 = array(
				'order'          => 'DESC',
				'orderby'        => 'date',
				'post_status'    => 'publish',
				'post_type'      => 'post',
				'posts_per_page' => -1,
				'category_name'  => $the_cat_principal->slug,
			);
			/* articulos */
			$articulos = get_posts( $args2 );
			foreach( $articulos as $articulo ) :
		?> <!--  Articulo -->
			<div class="col-xs-12 col-md-4">
				<article class="articles-item">
					<!-- Imagen -->
					<figure>
						<a href="<?= get_permalink( $articulo->ID ); ?>">
							<?php 
								$image = get_the_post_thumbnail( $articulo->ID , 'full' , array('class'=>'img-fluid center-block imgNotBlur') ); 
								if( !empty($image) ) : echo $image;
								else:
							?>
								<img src="<?= IMAGES; ?>/actualizando-imagen.jpg" alt="lorempixel" class="img-fluid center-block imgNotBlur" />
							<?php endif; ?>
						</a> <!-- /end of link -->
					</figure><!-- /figure -->
					<!-- Texto -->
					<h3 class="articles-item-title text-xs-center">
					<?php _e( $articulo->post_title , LANG ); ?></h3>
					<!-- Limpiar float --> <div class="clearfix"></div>
				</article><!-- /.sectionPage__articles__item -->
			</div> <!-- /.col-xs-12 col-md-4 -->
		<?php endforeach; ?>
		</div> <!-- /.row -->
	</section> <!-- /.pagePreview_post -->		

<?php endif; /* Fin de condicional */ ?> 	
