<?php /* Single Name: Single Producto Plantilla */ ?>
<!-- Header -->
<?php 
	get_header(); 
	$theme_mod = get_theme_mod('theme_custom_settings'); 

	global $post;
?>  

<!-- Incluir Banner de Pagina -->
<?php
	
	//pagina de productos
	$page_productos = get_page_by_path("productos"); 
	//setear el banner
	$banner         = $page_productos;  
	include( locate_template("partials/banner-common-pages.php") ); 

	/** Conseguir el término categoría de producto asociado a este producto **/
	$category_product = get_the_terms( $post->ID , "producto_category" );
	$category_product = $category_product[0];
	/** Obtener las opciones personalizadas de esa taxonomia **/
	$term_option = get_option( 'taxonomy_' . $category_product->term_id );
	//Seteando variables
	$current_color = $term_option['theme_tax_color']; #color seteado	
?>

<!-- Contenedor Principal -->
<main class="">
	
	<!-- Contenedor Contenido -->
	<section class="pageWrapper__content pageProducto">

		<!-- Sección con Padding -->
		<section class="sectionCommonPadding">

			<!-- Sección Migas de Pan o breadcrumbs -->
			<section class="sectionBreadcrums">
				<ul class="text-capitalize list-inline">
					<!-- Inicio -->
					<li class=""><a href="<?= site_url(); ?>"><?= __( "inicio" , LANG ); ?></a></li>
					<!-- Producto -->
					<li class=""><a href="#"><?= __( "producto" , LANG ); ?></a></li>
					<!-- Categoría de este producto -->
					<li class="">
						<a href="<?= get_term_link( $category_product ); ?>"> <?= __( $category_product->name , LANG ); ?></a>
					</li>
					<!-- Producto -->
					<li class=""><a href="#" style="color: <?= $current_color; ?> !important;"><?= __( $post->post_title , LANG ); ?></a></li>
				</ul>
			</section><!-- /. -->

			<!-- SECCION CONTENIDO -->
			<section class="pageProduct__content">
				<div class="row">
					
					<!-- IMAGEN -->
					<div class="col-xs-12 col-md-4">
						<div class="itemProducto__preview" style="border-color: <?= $current_color ?> !important;">
							<!-- Imagen -->
							<figure class="container-flex align-content">
								<?php 
								if( has_post_thumbnail($post->ID) ) : 
									echo get_the_post_thumbnail($post->ID , 'full' , array('class'=>'img-fluid imgNotBlur') );
								else:
									?> <img src="https://placeimg.com/500/500/any" alt="<?= $post->post_name; ?>" class="img-fluid imgNotBlur" />
								<?php endif; ?>
							</figure><!-- / -->
							<!-- Nombre o titulo -->
							<h3 class="text-capitalize text-xs-center" style="background-color: <?= $current_color; ?> !important; "><?= __( $post->post_title , LANG ); ?></h3>
						</div> <!-- /.itemProducto__preview -->
					</div> <!-- /.col-xs-12 col-md-4 -->

					<!-- CONTENIDO o detalle de producto -->
					<div class="col-xs-12 col-md-8">
						
						<div class="itemProducto__details">
							<!-- Titulo --> 
							<h2 class="pageSectionCommon__title text-uppercase" style="color: <?= $current_color ?> !important;"> <?= __( $post->post_title , LANG ); ?></h2>

							<!-- Separación  --> <br/>
								
							<!-- Detalle o descripción -->
							<div class="text-justify">
								<?php 
									if( !empty( $post->post_content ) ): 
									echo apply_filters( "the_content" , $post->post_content );
									else:
								?> <p> <?= __( "Actualizando Descripción" , LANG ); ?></p>
								<?php endif; ?>
							</div> <!-- /. -->

							<!-- Separación --> <p></p>

							<!-- Extracto como slogan -->
							<span class="itemProducto__slogan">
								<?= !empty($post->post_excerpt) ? $post->post_excerpt : "Simplemente fruta 100% Natural!"; ?>
							</span> <!-- /.itemProducto__slogan -->

						</div> <!-- /.itemProducto__details -->	

						<!-- BOTON VOLVER A PRODUCTOS -->
						<a href="<?= get_term_link( $category_product ); ?>" class="btnCommon__show-more text-uppercase"> <?php _e( "volver" , LANG ); ?></a>

					</div> <!-- /.col-xs-12 col-md-8 -->

				</div> <!-- /.row -->
			</section> <!-- /.pageProduct__content -->

		</section> <!-- /.sectionCommonPadding -->

		<!-- SEPARACIÓN --> <br><br>

		<!-- IMAGEN O CONTENIDO DE PRODUCTO -->
		<div class="pageProducto__extra-content">
			<?= apply_filters("the_content" , $page_productos->post_content ); ?>
		</div> <!-- /. -->
		
	</section> <!-- /.pageWrapper__content -->

</main> <!-- /.pageWrapper -->

<!-- Footer -->
<?php get_footer(); ?>