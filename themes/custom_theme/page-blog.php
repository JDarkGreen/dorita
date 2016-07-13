<?php /* Template Name: Página Blog Plantilla */ ?>

<!-- Header -->
<?php get_header(); $theme_mod = get_theme_mod('theme_custom_settings');  ?>

<!-- Incluir Banner de Pagina -->
<?php
	global $post; //Objeto actual - o -Pagina 
	$banner = $post;  // Seteamos la variable banner de acuerdo a la página
	include( locate_template("partials/banner-common-pages.php") ); 
?>

<!-- Contenedor Principal -->
<main class="">
	
	<!-- Contenedor Contenido -->
	<section class="pageWrapper__content pageBlog">

		<!-- Sección con Padding -->
		<section class="sectionCommonPadding">
			<!-- Título de Página --> <h2 class="pageSectionCommon__title pageSectionCommon__title--orange text-uppercase"> <?= __(  "blog" , LANG ); ?> </h2>
			
			<!-- Contenido -->
			<div class="row">
				<!-- SECCION CONTENIDO	-->
				<section class="col-xs-12 col-md-8">
					<?php
						/* Setear Cuantos Post Irán Por Página*/
						$posts_on_page = 6; 
						/*Incluir template de carousel de blog*/ 
						include( locate_template("partials/section-get-posts.php") );
					?>
				</section> <!-- /-col-xs-12 col-md-8 -->

				<!-- SECCION CATEGORÍAS -->
				<section class="col-xs-12 col-md-4">
					<?php  
						/**
						* Incluir template de categorías
						*/
						include( locate_template("partials/sidebar-categories.php") );
					?>
				</section> <!-- /.col-xs-12 col-md-4 -->

			</div> <!-- /.row -->

			<!-- Seccion Flechas de Carousel -->
			<?php 
				$total_post = isset($number_articulos) && !empty($number_articulos) ? $number_articulos : 0;
				if( $total_post > $posts_on_page ) : 
			?>
				<div class="containerArrowBlog relative">
					<!-- Flecha Izquierda --> 
					<a href="#" id="" class="arrow__common-slider js-carousel-prev arrowCarouselBlog-prev" data-slider="carousel-blog">
						<i class="fa fa-arrow-left" aria-hidden="true"></i>
					</a>								
					<!-- Flecha Derecha --> 
					<a href="#" id="" class="arrow__common-slider js-carousel-next arrowCarouselBlog-next" data-slider="carousel-blog">
						<i class="fa fa-arrow-right" aria-hidden="true"></i>
					</a>
				</div> <!-- /. -->				
			<?php endif; ?>

			<!-- Limpiar floats --> <div class="clearfix"></div>

	</section> <!-- /.pageWrapper__content -->

</main> <!-- /.pageWrapper -->


<!-- Footer -->
<?php get_footer(); ?>