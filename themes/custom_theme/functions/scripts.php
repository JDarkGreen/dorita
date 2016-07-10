<?php  

/* Archivo que solo se encargara de cargas los scripts del tema 
	http://www.ey.com/PE/es/Home
*/

function load_custom_scripts()
{
   //wp_deregister_script('jquery');
   //wp_register_script('jquery', "https://code.jquery.com/jquery-2.2.3.min.js", false, null);
   //wp_enqueue_script('jquery');

	/* carousel vertical*/
	//wp_enqueue_script('jscarousel', THEMEROOT . '/assets/js/build/jquery.jcarousellite.min.js', array('jquery'), false , true);

	/* slick carousel */
	wp_enqueue_script('slick', THEMEROOT . '/assets/js/vendor/slick.min.js', array('jquery'), '1.6.0' , true);

	//owl carousel /
	wp_enqueue_script('owl-carousel', THEMEROOT . '/assets/js/vendor/owl.carousel.min.js', array('jquery'), false , true);

	//cargar tether /
	wp_enqueue_script('tether', THEMEROOT . '/assets/js/vendor/tether.min.js', array('jquery'), '1.1.0', true);

	//cargar bootstrap v
	wp_enqueue_script('bootstrap', THEMEROOT . '/assets/js/vendor/bootstrap.min.js', array('jquery'), '3.3.6', true);	

	//cargar fancybox
	wp_enqueue_script('fancybox', THEMEROOT . '/assets/js/vendor/jquery.fancybox.pack.js', array('jquery'), '2.1.5', true);

	//cargar sliderevolution
	wp_enqueue_script('revslidertools', THEMEROOT . '/assets/js/vendor/jquery.themepunch.plugins.min.js', array('jquery'), '1.0', true);	

	//cargar sliderevolution
	wp_enqueue_script('revslider', THEMEROOT . '/assets/js/vendor/jquery.themepunch.revolution.min.js', array('jquery'), '4.3.6', true);	

	//cargar validador
	wp_enqueue_script('parsley', THEMEROOT . '/assets/js/vendor/parsley.min.js', array('jquery'), '2.3.11', true);
	wp_enqueue_script('p_idioma_es', THEMEROOT . '/assets/js/vendor/i18n/es.js', '' , false , true);

  	//cargar isotope
	wp_enqueue_script('isotope', THEMEROOT . '/assets/js/vendor/isotope.pkgd.min.js', array('jquery'), '3.0.0', true);	
  	
  	//cargar sbslidebar js 
	wp_enqueue_script('slidebars', THEMEROOT . '/assets/js/vendor/slidebars.min.js', array('jquery'), '0.10.3', true);	 	 

	//custom script
	wp_enqueue_script('custom_script', THEMEROOT . '/assets/js/build/script.min.js', array('jquery'), false, true);

}

add_action('wp_enqueue_scripts', 'load_custom_scripts');


/*
* Cargar los archivos JS pero del administrador WP
*/

/* Add the media uploader script */
function load_admin_custom_enqueue() {
	//upload media
	wp_enqueue_media();

	//upload gallery banner  
	wp_enqueue_script('upload-banner-page', THEMEROOT . '/admin/js/media-lib-banner.js', array('jquery'), '', true);  
	
	//upload gallery a todas la paginas
	wp_enqueue_script('upload-gallery', THEMEROOT . '/admin/js/metabox-gallery.js', array('jquery'), '', true);	

	//cargar color a esta taxonomía
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script('upload-color', THEMEROOT . '/admin/js/color-for-taxonomy.js', array('jquery' , 'wp-color-picker' ), '', true);

}

add_action('admin_enqueue_scripts', 'load_admin_custom_enqueue');

?>