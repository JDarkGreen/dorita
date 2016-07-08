<?php  

/* archivo muestra o contiene lois menus del tema en cuestion */

function register_my_menus(){
	register_nav_menus(
		array(
			'left-main-menu'  => __('Left Main Menu', LANG ),
			'right-main-menu' => __('Right Main Menu', LANG ),
			//'main-menu' => __('Main Menu', LANG ),
		)
	);
}
add_action('init', 'register_my_menus');


?>