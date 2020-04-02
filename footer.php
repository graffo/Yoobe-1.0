<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="row">
		
			<div class="rodape">
				<div class="logo">
				<img src="<?php bloginfo('template_directory'); ?>/assets/images/YOOBE-LOGO.png" />
				</div>
				<div class="politica float-right">
					<a href="https://yoobe.co/politica-de-devolucao/" target="_blank">Política de Devolução</a>
				</div>
			</div>
		
		</div>

		<div class="row">
			
			<div class="copyright">
				<div class="col-1 float-left">
					© All rights reserved
				</div>	
				<div class="col-1 float-right">
					Made with <span>❤</span> by Yoobe
				</div>
			</div><!-- .container -->
		</div>

		<button type="button" class="btn btn-primary ajuda" data-toggle="modal" data-target="#exampleModalCenter">
  			Precisa de Ajuda? Clique Aqui!
		</button>
		
		
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Pedido de Suporte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  
	  <iframe src="https://app.pipefy.com/public_form/1231351?embedded=true" width="640" height="680" frameborder="0"></iframe>
      </div>
    </div>
  </div>
</div>
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
