<?php /** Archivo Template: Taxonomía Categoría de Productos **/ ?>
<!-- Header -->
<?php 
	get_header(); 
	$theme_mod = get_theme_mod('theme_custom_settings'); 
?>  

<!-- Incluir Banner de Pagina -->
<?php
	$current_product_cat = get_queried_object(); //Objeto actual - Pagina 

	/**["term_id"]["name"]["slug"]"term_group"]"term_taxonomy_id"]["taxonomy"]
	*["description"]["parent"]["count"]["filter"] */
	#var_dump($current_product_cat);

	// Seteamos la variable banner de acuerdo al objeto
	$banner  = $current_product_cat;  
	include( locate_template("partials/banner-common-pages.php") ); 

	/**
	* OBTENEMOS TODOS LOS CAMPOS PERSONALIZADOS EN EL ADMIN DE ESTE OBJETO - CATEGORIA
	*/
	$term_option = get_option( 'taxonomy_' . $current_product_cat->term_id );

	//Seteando variables
	$current_color = $term_option['theme_tax_color']; #color seteado

?>

<!-- Contenedor Principal -->
<main class="">
	
	<!-- Contenedor Contenido -->
	<section class="pageWrapper__content pageProduct">

		<!-- Sección con Padding -->
		<section class="sectionCommonPadding">

			<!-- Título de Página --> <h2 class="pageSectionCommon__title text-uppercase" style="color: <?= $current_color?> !important;"> <?= __( $current_product_cat->name , LANG ); ?> </h2>

			<!-- Descripción : En este caso de esta categoría -->
			<div class="pageProduct__content-description">
				<?php 
					if( !empty( $current_product_cat->description) ) : 
					echo apply_filters("the_content" , $current_product_cat->description );
					else: 
				?> <p> <?= __( "Actualizando Descripción" , LANG ); ?></p>
				<?php endif; ?>
			</div> <!-- /.pageProduct__content-description -->

		    <!-- Limpiar floats -->	<div class="clearfix"></div>

			<!-- Contenedor Productos de ésta categoría -->
			<section class="pageProduct__content">
					<?php  
						//Argumentos
						$args = array(
							'order'          => 'ASC',
							'orderby'        => 'menu_order',
							'post_status'    => 'publish',
							'post_type'      => 'producto-dorita',
							'posts_per_page' => -1,
							'tax_query'      => array(
								array(
									'taxonomy' => 'producto_category',
									'field'    => 'slug',
									'terms'    => $current_product_cat->slug,
								),
							),
						);
						//obtenemos todos los productos
						$productos = get_posts( $args );

						/* Variable de control para asignar filas */
						$control_row     = 0;	
						/* Item a mostrar por fila */
						$item_per_row    = 3;
						/* Minimo num items  */
						$min_num_per_row = $item_per_row - 1;
						/* Maximo num items  */
						$max_num_per_row = $item_per_row + $min_num_per_row;

						//Mostramos los productos
						if( !empty($productos) ) : foreach($productos as $producto) :
					?> <!-- Item  -->
						
						<!-- ABRIR FILA -->
						<?php if( $control_row % $item_per_row == 0 ) : ?>
							<div class="row">
						<?php endif; ?>
						
						<!-- CONTENEDOR IMAGEN -->
						<div class="col-xs-12 col-md-4">
							<article class="itemProducto itemProducto__preview" style="border-color: <?= $current_color ?> !important;">
								<!-- Link -->
								<a href="<?= get_permalink( $producto->ID ); ?>" class="center-block">
									<!-- Imagen -->
									<figure class="container-flex align-content">
										<?php 
											if( has_post_thumbnail($producto->ID) ) : 
											echo get_the_post_thumbnail($producto->ID , 'full' , array('class'=>'img-fluid imgNotBlur') );
											else:
										?> <img src="https://placeimg.com/500/500/any" alt="<?= $producto->post_name; ?>" class="img-fluid imgNotBlur" />
										<?php endif; ?>
									</figure><!-- / -->
								</a> <!-- /.end of link -->
								<!-- Nombre o titulo -->
								<h3 class="text-capitalize text-xs-center" style="background-color: <?= $current_color; ?> !important; "><?= __( $producto->post_title , LANG ); ?></h3>
							</article> <!-- /.itemProducto__preview -->
						</div> <!-- /-col-xs-12 col-md-4 -->
						
						<!-- CERRAR FILA -->
						<?php if( ($control_row == $min_num_per_row ) || ($control_row >= $max_num_per_row && ($control_row - $max_num_per_row ) % $item_per_row == 0  ) ) : ?> </div><!-- /end row --> <?php endif; ?>

					<?php $control_row++; endforeach; endif; ?>
			</section> <!-- /.pageProduct__content -->

		</section> <!-- /.sectionCommonPadding -->
		
	</section> <!-- /.pageWrapper__content -->

</main> <!-- /.pageWrapper -->

<!-- Footer -->
<?php get_footer(); ?>