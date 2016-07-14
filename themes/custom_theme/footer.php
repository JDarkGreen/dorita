
<!-- Extraer opciones  -->
<?php $theme_mod = get_theme_mod('theme_custom_settings'); ?>

	<?php /* Web */ ?>
	<div class="container">
		<a class="pull-xs-right textWeb" href="<?= site_url(); ?>"> 
			<strong>www.LaDorita.com</strong> 
		</a>
	</div> <!-- /.container -->
	
	<!-- Footer -->
	<footer class="mainFooter">

		<!-- Seccion de Informacion  -->
		<section class="mainFooter__information">
			<div class="container">
				<div class="row">

					<!-- Item Footer -->
					<div class="col-xs-12 col-md-4">
						<div class="mainFooter__item">
							<!-- Logo Footer -->
							<h1 class="mainFooter__logo text-xs-center">
								<?= isset($theme_mod['title_info_footer']) && !empty($theme_mod['title_info_footer']) ? $theme_mod['title_info_footer'] : "La Dorita";
								?>
							</h1> <!-- /.lgoo -->
							<!-- Informacion -->
							<?php  
								if( isset($theme_mod['info_footer']) && !empty($theme_mod['info_footer']) ) : echo apply_filters('the_content' , $theme_mod['info_footer'] );
								endif;
							?>
						</div> <!-- /.mainFooter__item -->
					</div> <!-- /.col-xs-12 col-md-3 -->

					<!-- Item Footer -->
					<div class="col-xs-12 col-md-4">
						<div class="mainFooter__item">
							<!-- Titulo -->
							<h2 class="mainFooter__subtitle text-xs-center"><?php _e('Encuéntranos' , LANG ); ?></h2>

							<!-- Ubicación -->
							<ul class="pageCommon__list-data">
								<?php if( isset($theme_mod['contact_address']) && !empty($theme_mod['contact_address']) ) : ?>
								<li> 
									<!-- Imagen --> <i> <img src="<?= IMAGES ?>/icon/iconos_contacto_direccion.png" alt="" class="img-fluid" /></i>
									<?= apply_filters("the_content" , $theme_mod['contact_address'] ); ?>
								</li>
								<?php endif; ?>
							</ul> <!-- /.pageCommon__list-data -->

							<!-- Redes Sociales -->
							<div class="center-block text-xs-center">
								<ul class="social-links">
									<!-- Facebook -->
									<?php if( isset($theme_mod['red_social_fb']) && !empty($theme_mod['red_social_fb']) ): ?>
										<li> 
											<a href="<?= $theme_mod['red_social_fb']; ?>" target="_blank">
												<!-- Icon -->  
												<i class="fa fa-facebook" aria-hidden="true"></i>
											</a>
										</li>
									<?php endif; ?>								
									<!-- Twitter -->
									<?php if( isset($theme_mod['red_social_twitter']) && !empty($theme_mod['red_social_twitter']) ): ?>
										<li> 
											<a href="<?= $theme_mod['red_social_twitter']; ?>" target="_blank">
												<!-- Icon -->  
												<i class="fa fa-twitter" aria-hidden="true"></i>
											</a>
										</li>
									<?php endif; ?>								
									<!-- Youtube -->
									<?php if( isset($theme_mod['red_social_ytube']) && !empty($theme_mod['red_social_ytube']) ): ?>
										<li> 
											<a href="<?= $theme_mod['red_social_ytube']; ?>" target="_blank">
												<!-- Icon -->  
												<i class="fa fa-youtube" aria-hidden="true"></i>
											</a>
										</li>
									<?php endif; ?>
								</ul> <!-- /.social-links -->
							</div> <!-- /.center-block  -->

						</div> <!-- /.mainFooter__item -->
					</div> <!-- /.col-xs-12 col-md-3 -->

					<!-- Item Footer -->
					<div class="col-xs-12 col-md-4">
						<div class="mainFooter__item text-xs-center">
							<!-- Titulo -->
							<h2 class="mainFooter__subtitle"><?php _e('Comunícate en:' , LANG ); ?></h2>
							
							<!-- Saparación --> 
							<p></p>
							
							<!-- List data -->
							<ul class="pageCommon__list-data text-xs-left">
								<!-- Teléfonos -->
								<?php if( isset($theme_mod['contact_tel']) && !empty($theme_mod['contact_tel']) ) : ?>
									<li> <!-- Imagen --> 
										<i> <img src="<?= IMAGES ?>/icon/iconos_contacto_telefono.png" alt="" class="img-fluid" /></i>

										<?php 
											/* Extraer todos los teléfonos y convertirlos en array*/ 
											$telefonos  = explode(",", $theme_mod['contact_tel'] );
											for( $i = 0 ; $i < count($telefonos) ; $i++ )
											{
												$separacion = $i != count($telefonos) -1 ? " / " : "";
												echo $telefonos[$i] . $separacion;
											} 
										?>
									</li>
								<?php endif; ?>								
								<!-- Celular -->
								<?php if( isset($theme_mod['contact_cel']) && !empty($theme_mod['contact_cel']) ) : ?>
									<li> <!-- Imagen --> 
										<i> <img src="<?= IMAGES ?>/icon/iconos_contacto_rpm.png" alt="" class="img-fluid" /></i>

										<?php 
											/* Extraer todos los celulares y convertirlos en array*/ 
											$celulares  = explode(",", $theme_mod['contact_cel'] );
											for( $i = 0 ; $i < count($celulares) ; $i++ )
											{
												$separacion = $i != count($celulares) -1 ? " / " : "";
												echo $celulares[$i] . $separacion;
											} 
										?>
									</li>
								<?php endif; ?>								
								<!-- Email -->
								<?php if( isset($theme_mod['contact_email']) && !empty($theme_mod['contact_email']) ) : ?>
									<li> <!-- Imagen --> 
										<i> <img src="<?= IMAGES ?>/icon/iconos_contacto_mail.png" alt="" class="img-fluid" /></i>
										<?=  $theme_mod['contact_email']; ?>
									</li>
								<?php endif; ?>
							</ul> <!-- /.mainFooter__list-data -->

						</div> <!-- /.mainFooter__item -->
					</div> <!-- /.col-xs-12 col-md-3 -->
				</div> <!-- /.row -->
			</div> <!-- /.container -->
		</section> <!-- /.mainFooter__information -->

		<!-- Seccion de Desarrollo -->
		<section class="mainFooter__develop">
			<div class="container">
				<div class="text-xs-center"> &copy; <?= date("Y"); ?> La Dorita. Derechos reservados Design by <a target="_blank" href="http://www.ingenioart.com/">INGENIOART</a></div>
			</div> <!-- /.container -->
		</section> <!-- /.mainFooter__develop -->

	</footer><!-- /.mainFooter -->

	</div> <!-- /#sb-slidebar -->

	<?php wp_footer(); ?>

	<script> var url = "<?= THEMEROOT ?>"; </script>
</body>
</html>

