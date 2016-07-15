<?php  
/**
* Sección Categorías de Productos
**/
?>
<section class="pageInicio__product-categories">
	<div class="container">
		<div class="row container-flex align-content">
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

				/* Hacemos el recorrido por cada una de estas taxonomías con los id de los terminos 
				* de la taxonomia producto_category
				 */
				if( !empty( $new_terms_cat_product ) ) : 
				foreach ( $new_terms_cat_product as $key_term => $value_term ) :
				/* Seteamos el termino de esta taxonomia con la llave key_term y obtenemos el OBJETO
				* del termino
				*/
				$term_category_product = get_term( $key_term , $cat_taxonomy );

				/* Obtenemos los campos personalizados del termino*/
				$term_option = get_option( 'taxonomy_' . $term_category_product->term_id );
			?>
				<!-- Columnas -->
				<div class="col-xs-4">
					<article class="itemCatProduct">
						<!-- Imagen -->
						<figure>
							<img src="<?= $term_option['theme_tax_img']; ?>" alt="dorita-frutas-pulpas-mejor-<?= $term_category_product->slug ?>" class="img-fluid center-block imgNotBlur" />
						</figure> <!-- /.figure -->
						<!-- Título -->
						<div class="text-xs-center">
							<h2 class="text-capitalize relative"> 
								<?= $term_category_product->name ?> 
							<!-- Span --> <span style="color: <?= $term_option['theme_tax_color'] ?>"> <?= $term_category_product->name ?> </span>
							</h2>
						</div> <!-- /.text-xs-center -->
						<!-- Meta info 1 - Slogan -->
						<p><?= $term_option['theme_tax_extra_info']; ?> </p>
						<!-- Meta info 2 -->
						<span class="meta-description"> <?= $term_option['theme_tax_extra_info2']; ?> </span>

						<!-- Botón ver más -->
						<div class="text-xs-center">
							<a href="<?= get_term_link( $term_category_product->term_id ); ?>" class="btnCommon__show-more text-uppercase"> <?= __( "ver más" , LANG ) ?></a>
						</div> <!-- /.text-xs-center -->

					</article> <!-- /.itemCatProduct -->
				</div> <!-- /.col-xs-4 -->

			<?php endforeach; endif; //fin del recorrido y la condicional  ?>
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section> <!-- /.pageInicio__product-categories -->