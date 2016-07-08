<!DOCTYPE html>
<!--[if IE 8]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="author" content="">

	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
	
	<!-- Pingbacks -->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicon and Apple Icons -->
	
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
	
	<?php 
		$theme_mod = get_theme_mod( 'theme_custom_settings' ); 
		global $post;

		//Comprobar si esta desplegada la barra de Navegación
		$admin_bar = is_admin_bar_showing() ? 'mainHeader__active' : '';
	?>

<!-- Header -->

<!-- Contenedor Version Desktop -->
<header class="mainHeader hidden-xs-down relative">

	<!-- Primera sección Contenedor de Información y Pedido -->
	<?php  
		# Extraemos el fondo header de las opciones del tema
		$bg_header = isset($theme_mod['image_backheader']) && !empty($theme_mod['image_backheader']) ? $theme_mod['image_backheader'] : IMAGES . '/backgrounds/inicio_baner_menu_la_dorita_frutas_pulpas_lima_peru.jpg';
	?>
	<section class="mainHeader__info" style="background-image: url(<?= $bg_header; ?>);">
		<div class="container">
			<!-- Contenedor de pedido y telefonos -->
			<div class="sectionDataInfo text-xs-center pull-xs-right">
				<!-- Titulo --> <h2 class=""> <?php _e("Haz tu Pedido Ya!" , LANG ); ?></h2>
				<!-- Contenedor flexible -->
				<div class="container-flex-align-content">
					<!-- Email -->
					<?php if( isset($theme_mod['contact_email']) && !empty($theme_mod['contact_email']) ) : ?>
						<span> <!-- Icono --> <i class="fa fa-envelope" aria-hidden="true"></i> 
						<?= $theme_mod['contact_email']; ?>
						</span>
					<?php endif; ?>
					<!-- Teléfono -->
					<?php if( isset($theme_mod['contact_tel']) && !empty($theme_mod['contact_tel']) ) : ?>
						<span> <!-- Icono --> <i class="fa fa-phone" aria-hidden="true"></i> 
						<?php  
							#Obtener el string telefono, convertirlo a array y luego mostrar el primero
							$telefonos = $theme_mod['contact_tel'];
							$telefonos = explode( ",",  $telefonos );
							echo $telefonos[0];
						?>
						</span>
					<?php endif; ?>

				</div><!-- /.container-flex-align-content -->
			</div> <!-- /. -->
		</div> <!-- /.container -->
	</section> <!-- /.mainHeader__info -->

	<!-- Segunda Sección Navegación Principal -->
	<nav class="mainNavigation">
		<div class="container container-flex">
			<!-- Menu de Navegacion Izquierda -->
			<?php wp_nav_menu(
				array(
					'menu_class'     => 'main-menu',
					'theme_location' => 'left-main-menu'
				));
			?>

			<!-- Logo Principal -->
			<h1 class="logo">
				<a href="<?= site_url() ?>">
					<?php  
						# Conseguimos la ruta del logo mediante las opciones del tema 
						# Si no lo dejamos por defecto
						$img_logo = isset($theme_mod['logo']) && !empty($theme_mod['logo']) ? $theme_mod['logo'] : IMAGES . "/logo.png";
					?>
					<img src="<?= $img_logo; ?>" alt="la-dorita-pulpas-frutas-nectares-almibar" class="img-fluid center-block" />
				</a>
			</h1> <!-- /.lgoo -->				

			<!-- Menu de Navegacion Derecha -->
			<?php wp_nav_menu(
				array(
					'menu_class'     => 'main-menu',
					'theme_location' => 'right-main-menu'
				));
			?>	

		</div> <!-- /.container -->
	</nav> <!-- /.mainNavigation -->



</header> <!-- /.mainHeader  -->

<!-- Contenedor Version Mobile -->
<header class="mainHeader container-flex align-content hidden-sm-up sb-slide">

	<!-- Icono Izquierda -->
	<div id="toggle-left-nav" class="icon-header"> 
		<i class="fa fa-bars" aria-hidden="true"></i> 
	</div> <!-- /.icon-header -->	

	<!-- Logo Principal -->
	<h1 class="logo">
		<a href="<?= site_url() ?>">
			<?php if( !empty($theme_mod['logo']) ) : ?>
				<img src="<?= $theme_mod['logo'] ?>" alt="<?= "-logo-" . bloginfo('name') ?>" class="img-fluid center-block" />
			<?php else: ?>
				<img src="<?= IMAGES ?>/logo.png" alt="<?= "-logo-" . bloginfo('name') ?>" class="img-fluid center-block" />
			<?php endif; ?>
		</a>
	</h1> <!-- /.lgoo -->

	<!-- Icono Izquierda -->
	<div id="toggle-right-nav" class="icon-header"> 
		<i class="fa fa-bars" aria-hidden="true"></i> 
	</div> <!-- /.icon-header -->
	
</header> <!-- /.container-flex align-content hidden-sm-up -->


<!-- Contenedor Izquierda Version Mobile -->
<aside class="sb-slidebar sb-left sb-style-push">
	<!-- Navegación Principal -->
	<nav class="mainNavigation">
		<?php wp_nav_menu(
			array(
				'menu_class'     => 'main-menu text-center',
				'theme_location' => 'main-menu'
			));
		?>						
	</nav> <!-- /.mainNav -->  
</aside> <!-- /.sb-slidebar sb-left sb-style-push -->

<!-- Contenedor Derecha Version Mobile -->
<section class="sb-slidebar sb-right sb-style-push">
	<?php  
		/* Extraer todas las categorías padre */  
		$categorias = get_categories( array(
			'orderby' => 'name' , 'parent' => 0,
		) );
		
		/*Incluir plantilla de categorias */
		include( locate_template("partials/sidebar-categories.php") ); 
	?>
</section> <!-- /.sb-slidebar sb-right sb-style-push -->


<!-- Flecha Indicador hacia arriba -->
<a href="#" id="arrow-up-page"><i class="fa fa-angle-up" aria-hidden="true"></i></a>

<!-- Contenedor version mobile libreria sliderbar js -->
<div id="sb-site" class="">








