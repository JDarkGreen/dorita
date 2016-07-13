<?php /* Template Name: Página Productos Plantilla */ ?>

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
	<section class="pageWrapper__content pageProductos">

		<!-- Sección con Padding -->
		<section class="sectionCommonPadding">
			<!-- Título de Página --> <h2 class="pageSectionCommon__title pageSectionCommon__title--orange text-uppercase"> <?= __(  $post->post_title , LANG ); ?> </h2>

			<!-- Separación --> <br/><br/>

			<!-- Incluir Plantilla de Productos -->
			<?php include( locate_template("partials/section-category-products.php") ); ?>

		</section> <!-- /.sectionCommonPadding -->
		
	</section> <!-- /.pageWrapper__content -->

</main> <!-- /.pageWrapper -->


<!-- Footer -->
<?php get_footer(); ?>