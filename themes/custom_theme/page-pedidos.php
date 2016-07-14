<?php /* Template Name: Página Pedidos en Línea Plantilla */ ?>

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
	<section class="pageWrapper__content pageNosotros">

		<!-- Sección con Padding -->
		<section class="sectionCommonPadding">
			<!-- Título de Página --> <h2 class="pageSectionCommon__title pageSectionCommon__title--orange text-uppercase"> <?= __(  $post->post_title , LANG ); ?> </h2>

			<!-- SECCION CONTENIDO PEDIDO -->
			<div class="row">
				
				<!-- SECCION CATEGORIAS DE PRODUCTOS -->
				<div class="col-xs-5">
					<aside class="sidebarProducts">
						<?php #Extraer todas las categorias de productos  
							$cat_taxonomy = "producto_category";
							$product_cats = get_terms( $cat_taxonomy , array( 'hide_empty' => false ) );

							//Ordenamos en un nuevo arreglo mediante el meta campo 
							//custom_term_meta
							$new_terms_cat_product = array();
							//hacemos un ciclo y seteamos con los ids de los terminos
							foreach( $product_cats as $term_cat_product )
							{	
								//Obtenemos la opcion custom term meta de esta categoría si 
								//esta vacia la seteamos a cero
								$this_option = get_option('taxonomy_' . $term_cat_product->term_id );
								$this_option = !empty($this_option['theme_tax_order']) ? $this_option['theme_tax_order'] : 0 ;
								$new_terms_cat_product[ $term_cat_product->term_id ] = intval( $this_option );
							}

							#Ordenamos el nuevo arreglo en orden ascendente;
							asort($new_terms_cat_product);

							if( !empty($new_terms_cat_product) ) : foreach ( $new_terms_cat_product as $key_term => $value_term ) :
							/* Seteamos el termino de esta taxonomia con la llave key_term y obtenemos 	
							*  el OBJETOdel termino
							*/
							$term_category_product = get_term( $key_term , $cat_taxonomy );

						?> <!-- SECCION -->
							<section class="productSection">
								<!-- Titulo de Seccion -->
								<h3 class="text-capitalize"><?= $term_category_product->name; ?></h3>

								<!-- Contenedor -->
								<div class="productSection__content">
									<!-- Hacer un recorrido de los productos asociados a esta categoría -->
									<?php  
										/** Argumentos */
										$args = array(
											'post_type'      => 'producto-dorita',
											'post_status'    => 'publish',
											'posts_per_page' => -1,
											'order'          => 'ASC',
											'orderby'        => 'menu_order',
											'tax_query'      => array(
												array(
													'taxonomy' => $cat_taxonomy,
													'field'    => 'slug',
													'terms'    => $term_category_product->slug,
												),
											),		
										);
										//Obtener productos
										$products = get_posts( $args );

										foreach( $products as $product ) :
									?> <!-- Item Checkbox -->
										<div class="item-product">
											<input type="checkbox" class="js-checkbox-product" name="product[<?= $term_category_product->slug ?>][<?= $product->post_name; ?>]" value="<?= $product->post_title; ?>" /> 
											<?= $product->post_title; ?>

											<!-- VALOR OCULTO SE MUESTRA AL HACER HOVER-->
											<div class="container-pedido pull-xs-right">
												<input type="text" class="js-input-only-num" name="product[<?= $term_category_product->slug ?>][<?= $product->post_name; ?>][value]" /> Kg
											</div> <!-- /.container-pedido -->

											<!-- Limpiar Float --> <div class="clearfix"></div>
										</div> <!-- / -->
									<?php endforeach; ?>
								</div> <!-- /.productSection__content -->
							</section> <!-- /.productSection -->
						<?php endforeach; endif; ?>
					</aside> <!-- /.sidebarProducts -->
				</div> <!-- /.col-xs-5 -->
				
				<!-- MENSAJE -->
				<div class="col-xs-7">
					<section class="pageContacto__formulary center-block">
						<!-- Titulo --> <h2 class="text-capitalize"><?php _e( "Pedido" , LANG ); ?></h2>

						<!-- Formulario -->
						<form id="form-contacto" action="" class="pageContacto__form" method="POST">

							<!-- Nombre -->
							<div class="pageContacto__form__group">
								<label for="input_name" class="sr-only"></label>
								<input type="text" id="input_name" name="input_name" placeholder="<?php _e( 'Nombre', LANG ); ?>" required />
							</div> <!-- /.pageContacto__form__group -->

							<!-- Email -->
							<div class="pageContacto__form__group">
								<label for="input_email" class="sr-only"></label>
								<input type="email" id="input_email" name="input_email" placeholder="<?php _e( 'E-mail', LANG ); ?>" data-parsley-trigger="change" required="" data-parsley-type-message="Escribe un email válido"/>
							</div> <!-- /.pageContacto__form__group -->						

							<!-- Mensaje -->
							<div class="pageContacto__form__group">
								<label for="input_consulta" class="sr-only"></label>
								<textarea name="input_consulta" id="input_consulta" placeholder="<?php _e( 'Escríbenos un mensaje', LANG ); ?>" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Necesitas más de 20 caracteres" data-parsley-validation-threshold="10"></textarea>
							</div> <!-- /.pageContacto__form__group -->

							<!-- Boton Centrado -->
							<div class="center-block text-xs-center">
								<button type="submit" id="send-form" class="btnCommon__show-more btnCommon__show-more--reverse text-uppercase">
									<?php _e( 'pedir' , LANG ); ?>
								</button> <!-- /.btn__send-form -->
								
							</div> <!-- /.center-block text-xs-center -->

							<!-- Limpiar Floats  --> <div class="clearfix"></div>

						</form> <!-- /.pageContacto__form -->

					</section> <!-- /.pageContacto__formulary -->
				</div>		
	
			</div> <!-- /.row -->

			<!-- SECCION CONTENIDO DE LA PAGINA O IMAGE -->
			<?php if( !empty($post->post_content) ) : ?>
			<section class="pagePedido__content">
				<?= apply_filters("the_content" , $post->post_content ); ?>
			</section> <!-- /.pagePedido__content -->
			<?php endif; ?>

	</section> <!-- /.pageWrapper__content -->

</main> <!-- /.pageWrapper -->


<!-- Footer -->
<?php get_footer(); ?>