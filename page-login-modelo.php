<?php
define('DONOTCACHEPAGE', true);
/*
	Template name: Acesso a loja
	*/
 

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
		

			<?php
			while ( have_posts() ) :
				the_post();

				do_action( 'storefront_page_before' );

				get_template_part( 'content', 'page' );?>

				<div id="wpuf-login-form" style="margin-bottom: 100px; padding:100px 50px">
						<!-- Right sidebar -->
						<?php 
						$login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;
						if ( $login === "failed" ) {
							echo '<p class="login-msg"><strong>ERRO:</strong> Nome de usuário/senha errado.</p>';
						} elseif ( $login === "empty" ) {
							echo '<p class="login-msg"><strong>ERRO:</strong> Usuário e senha vazios.</p>';
						} elseif ( $login === "false" ) {
							echo '<p class="login-msg"><strong>ERRO:</strong> Você Saiu.</p>';
						}
						?>
						<div class="login-branding">
						<br>
						<?php $cliente = $_GET["cliente"];
						if ($cliente == '13945' ){?>		
							<img src="https://yoobe.co/wp-content/uploads/2020/01/sumup-cover-29923i0-1.jpg">
						<?php }?>
						<br>
						<h3>Para acessar, insira seus dados nos campos abaixo:</h3>	
							</div>
							<div class="login-form">
							<?php
							$args = array(
								'redirect' => home_url(), 
								'id_username' => 'user',
								'id_password' => 'pass'
							) 
							;?>
							<?php wp_login_form( $args ); ?>
							
							<a href="<?php echo site_url('/minha-conta/lost-password');?>">Esqueceu sua senha?</a>
						</div>
							
						
 
					</div>
			
			<?php endwhile; // End of the loop.	?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
