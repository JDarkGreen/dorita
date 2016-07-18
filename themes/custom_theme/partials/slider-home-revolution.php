<?php  
/**
* Plantila Slider Home modificado para trabajar con libreria 
* SLIDER REVOLUTION
**/

	// The Query
	$args = array(
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
		'post_status'    => 'publish',
		'post_type'      => 'slider-home',
		'posts_per_page' => -1,
	);

	$the_query = new WP_Query( $args );

	//Control Loop
	$i = $j = $k = 0;

	// The Loop
	if ( $the_query->have_posts() ) : 
?>

<!-- Contenedor de bannner para responsive no full width  -->
<div id="" class="banner-container relative"> <span class="Apple-tab-span"> </span>

	<!-- Contenedor Wrapper for sliders -->
	<section id="carousel-home" class="pageInicio__slider">
		<ul class="">
		<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>

			<!-- Extraer transición por slider o dejarlo por defecto -->
			<?php  
				$transition = get_post_meta( get_the_ID() , 'mb_revslider_select' , true );
				$transition = !empty($transition) ? $transition : 'boxslide';
			?>
			
			<li class="item-slider" data-transition="<?= $transition ?>" data-slotamount="10">
				
				<!-- Imagen Destacada -->
				<?php if( has_post_thumbnail() ) :  ?>
					<?php the_post_thumbnail('full', array('class'=>'img-fluid') ); ?>
				<?php endif; ?>

				<!-- Caption Titulo y contenido -->
				<div class="caption sft big_white" data-x="50" data-y="67" data-speed="3000" data-start="900" data-easing="easeOutBack">
					<section class="pageInicio__slider__content">
						<h2 class="">
							<?php _e( get_the_title() , LANG ); ?>
						</h2> <!-- /.pageInicio__slider__title -->
					</section> <!-- /.pageInicio__slider__content -->
				</div> <!-- /.caption sft big_white -->	
				
				<!-- Meta Contenido - Información Adicional -->
				<div class="caption sft big_white" data-x="50" data-y="197" data-speed="3000" data-start="2000" data-easing="easeInBack">
					<!-- Meta Contenido - Información Adicional -->
					<div class="pageInicio__slider__content pageInicio__slider__meta-content">
						<!-- Contenido del Slider  -->
						<p class="text-capitalize">
							<?php _e( get_the_content() , LANG ); ?>
						</p> <!-- /.pageInicio__slider__content -->

						<!-- Extracto -->
						<span><?php _e( get_the_excerpt() , LANG ); ?></span>
						
					</div> <!-- /.pageInicio__slider__meta-content -->
				</div> <!-- /.caption sft big_white -->

				<!-- Imagen Extra -->
				<?php 
					$extra_img = get_post_meta( get_the_ID() , 'input_img_banner_'.get_the_ID() , true); 
					if( !empty($extra_img) ) : 

					/* Posicion de Imagen extra */
					$pos_x_img = get_post_meta(get_the_ID(), 'input_posx_img_'.get_the_ID() , true);
					$pos_x_img = !empty( $pos_x_img ) ? $pos_x_img : "550";					

					$pos_y_img = get_post_meta(get_the_ID(), 'input_posy_img_'.get_the_ID() , true);
					$pos_y_img = !empty( $pos_y_img ) ? $pos_y_img : "40";
				?>
					<div class="caption big_white" data-x="<?= $pos_x_img; ?>" data-y="<?= $pos_y_img; ?>" data-speed="3000" data-start="3000" data-easing="easeOutBack">
						<figure class="item-slider__extra-img">
							<img src="<?= $extra_img; ?>" alt="image-extra-dorita-fruta" class="img-fluid" />
						</figure> <!-- /.item-slider__extra-img -->
					</div>
				<?php endif; ?>
		
			</li> <!-- /.item-slider -->
		<?php $i++; endwhile; ?>
		</ul> <!-- /. ul -  -->
	</section> <!-- /.carousel-home -->

	<!-- Flechas de Carousel -->
	<section id="pageInicio__slider__arrows" class="pageInicio__slider__arrows">
		<!-- Izquierda -->
		<a href="#" data-slider="carousel-home" data-move="prev" class="arrow-prev">
			<!-- Icon --> <i class="fa fa-angle-left" aria-hidden="true"></i>
		</a>
		<!-- Derecha -->
		<a href="#" data-slider="carousel-home" data-move="next" class="arrow-next">
			<!-- Icon --> <i class="fa fa-angle-right" aria-hidden="true"></i>
		</a>
	</section> <!-- /.pageInicio__slider__arrows -->
	
	<!-- Dots o indicadores -->
	<section id="pageInicio__slider__dots" class="pageInicio__slider__dots text-xs-center">
		<?php
			//variable j  
			while( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<a href="#" data-slider="carousel-home" data-dot="<?= $k + 1; ?>"></a>
		<?php $j++; endwhile; wp_reset_postdata(); ?>
	</section> <!-- /.pageInicio__slider__dots -->

</div> <!-- /.banner-container relative -->

<!-- LINEA SEPARADORA  -->
<div id="separator-line-slider"></div>

<?php endif; wp_reset_postdata(); ?>