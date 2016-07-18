<!-- Header -->
<?php 
	get_header(); 
	$theme_mod = get_theme_mod('theme_custom_settings'); 
?>

<!-- Incluir Slider de Portada -->
<?php include(locate_template('partials/slider-home-revolution.php')); ?>

<!-- Separador --> <p></p>

<?php  
/**
* Sección Categorías de Productos
**/
include(locate_template('partials/section-category-products.php'));
?>

<?php  
/**
* Sección Acerca de Nostros
**/
?>

<section class="pageInicio__nosotros">
	<div class="container">
		<div class="row">
			<!-- CONTENIDO O INFORMACION -->
			<div class="col-xs-6">
				<!-- Titulo --> <h2 class="text-uppercase"><?php _e( "nosotros" , LANG ); ?></h2>
				<!-- Contenido -->
				<?php 
					if( isset($theme_mod['widget_nosotros']) && !empty($theme_mod['widget_nosotros']) ) : echo apply_filters('the_content' , $theme_mod['widget_nosotros'] );
					endif;
				?>

			</div> <!-- /.col-xs-6 -->
			<!-- IMAGEN -->
			<div class="col-xs-6">
				<figure class="">
					<img src="<?= IMAGES ?>/inicio_baner_nosotros_la_dorita_frutas_pulpas_lima_peru.jpg" alt="inicio_baner_nosotros_la_dorita_frutas_pulpas_lima_peru" class="img-fluid" />
				</figure> <!-- /.figure -->
			</div> <!-- /.col-xs-6 -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section>  <!-- /.pageInicio__nosotros -->

<?php  
/**
* Sección Miscelaneo
**/
?>
<section class="pageInicio__miscelaneo">
	<div class="container">
		<div class="row">
			
			<!-- SECCION BLOG -->
			<div class="col-xs-7">
				
				<section class="pagePreview_post">
					<!-- Titulo Común de sección --> <h2 class="pageSectionCommon__title pageSectionCommon__title--orange text-uppercase"> <?php _e( "Blog" , LANG ); ?></h2>
					
					<!-- Carousel de Post -->
					<!-- Wrapper para sliders -->
					<?php  
						/*
						*  Attributos disponibles 
						* data-items = number , data-items-responsive = number_mobile ,
						* data-margins = margin_in_pixels , data-dots = true or false
						*/
					?>
					<div id="carousel-last-post" class="pageInicio_gal_post js-carousel-gallery" data-items="2" data-items-responsive="1" data-margins="57">
						<?php /** EXTRAEMOS LOS 6 ULTIMOS POSTS **/
							$args = array(
								'order'          => 'DESC',
								'orderby'        => 'modified',
								'post_status'    => 'publish',
								'post_type'      => 'post',
								'posts_per_page' => 6,
							);
							$articulos = get_posts( $args );

							if( !empty($articulos) ) : foreach($articulos as $articulo) :
						?> <!-- Articulos -->
							<article class="articles-item">
								<!-- Imagen -->
								<figure class="center-block">
									<?php  
										/* Extract image */
										$image = get_the_post_thumbnail( $articulo->ID , 'full' , array('class'=>'img-fluid center-block imgNotBlur') ); 
										if( !empty($image) ) : echo $image; else:
									?>
										<img src="https://placeimg.com/980/672/any" alt="lorempixel" class="img-fluid center-block imgNotBlur" />
									<?php endif; ?>
									</figure><!-- /figure -->

									<!-- Título de artículo -->
									<h3 class="articles-item-title text-xs-center">
										<?php _e( $articulo->post_title , LANG ); ?>
									</h3>

									<!-- Botón leer más -->
									<div class="text-xs-center">
										<a href="<?= get_permalink( $articulo->ID ); ?>" class="btnCommon__show-more text-uppercase"><?php _e( "ver más" , LANG ); ?></a>
									</div> <!-- /.text-xs-center -->

								</article><!-- /.sectionPage__articles__item -->

						<?php endforeach; endif; //fin de recorrido ?>
						
					</div> <!-- /.#carousel-last-post -->

					<!-- EXTRA IMAGEN NOSOTROS - DISTRIBUCIÓN -->
					<figure class="">
						<?php 
							$img_extra_nosotros = isset($theme_mod['image_extra_data_nosotros']) && !empty($theme_mod['image_extra_data_nosotros']) ? $theme_mod['image_extra_data_nosotros'] : IMAGES . "/baner_distribucion_dorita_frutas_pulpas_lima_peru.jpg";
						?>
						<img src="<?= $img_extra_nosotros; ?>" alt="baner_distribucion_dorita_frutas_pulpas_lima_peru" class="img-fluid" />
					</figure> <!-- /. -->

				</section> <!-- /.pagePreview_post -->

			</div> <!-- /.col-xs-7 -->

			<!-- SECCION FACEBOOK -->
			<div class="col-xs-5">
				
				<section class="pageInicio__facebook">

					<!-- Titulo Común de sección --> <h2 class="pageSectionCommon__title pageSectionCommon__title--blue text-uppercase"> <?php _e( "facebook" , LANG ); ?></h2>

					<!-- Contenedor facebook -->
					<?php
						if( isset( $theme_mod['red_social_fb'] ) && !empty( $theme_mod['red_social_fb'] ) ) :
					?>
						<section class="container__facebook">
							<!-- Contebn -->
							<div id="fb-root" class=""></div>

							<!-- Script -->
							<script>(function(d, s, id) {
								var js, fjs = d.getElementsByTagName(s)[0];
								if (d.getElementById(id)) return;
								js = d.createElement(s); js.id = id;
								js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5";
								fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));</script>

							<div class="fb-page" data-href="<?= $theme_mod['red_social_fb']; ?>" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-width="445" data-height="456" data-hide-cover="false" data-show-facepile="true">
							</div> <!-- /. fb-page-->
						</section> <!-- /.container__facebook -->
					<?php else: ?>
						<p class="text-xs-center">Opcion no habilitada temporalmente</p>
					<?php endif; ?>

				</section> <!-- /. -->

			</div> <!-- /.col-xs-7 -->
			
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section> <!-- /.pageInicio__miscelaneo-->

<!-- Footer -->
<?php get_footer(); ?>