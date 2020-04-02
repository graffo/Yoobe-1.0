<?php

if( is_front_page() || is_home() ){
                switch($_SERVER['HTTP_HOST']){
                        case "store.anthor.com.br":
                                header("Location: /store/anthor");
                                die();
                        break;
                        case "anthor.yoobe.co":
                                header("Location: /store/anthor");
                                die();
						break;
                        case "sumup.yoobe.co":
                                header("Location: /store/sumup");
                                die();
						break;
						
                }
        }

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); 
	
	
	if ( ! is_user_logged_in() ) {
		
		global $post;	
		$vendor_id=get_post_field( 'post_author', $post_id );
		$protegida = get_user_meta( $vendor_id, 'protegida', true );
			if ($protegida == '1'){
				header('Location: '.site_url().'/log-in/?cliente='.$vendor_id.''); 
			}
	}
	

	global $post;
	$dono=$post->post_author;
	if ($dono == 18){
	?>
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet"> 
	<style>
		body{
			font-family: 'Lato', sans-serif;
			color: #131b22
		}
		.banner{
			display: none
		}
		h1, h2 , h3, h4, h5, h6{
			font-weight: bold !important;
		}
		span.woocommerce-Price-amount.amount, .woocommerce-Price-currencySymbol{
			color: #96d518 !important
		}
		.product__title a:hover, {
			color: #62dce0
		}
		.woocommerce ul.products li.product .button, .single_add_to_cart_button, .elementor-3166 .elementor-element.elementor-element-12a48272 .cart button,.reset_variations{
			color: #131b22 !important;
			border-color: #131b22 !important;
			background-color: #fff !important; 
		}
		.woocommerce a.button:hover, .woocommerce button.button.alt.disabled:hover, .elementor-3166 .elementor-element.elementor-element-12a48272 .cart button:hover, .reset_variations:hover{
			background-color: #96d518 !important;
			border-color: #96d518 !important;
			color: #131b22 !important;
		}
		.woo-variation-swatches-stylesheet-enabled .variable-items-wrapper .variable-item:not(.radio-variable-item).selected, .woo-variation-swatches-stylesheet-enabled .variable-items-wrapper .variable-item:not(.radio-variable-item).selected:hover{
			box-shadow: 0 0 0 2px rgba(150,213,24,.9);
		}
		.nav-tabs-dafault .nav-tabs .nav-item a.active, .nav-tabs-dafault .nav-tabs .nav-item a:hover,.nav-tabs-dafault .nav-tabs .nav-item a.active::before{
			border-color: #96d518 !important;
			color: #96d518 !important;
		}
		.nav-tabs-dafault .nav-tabs .nav-item a.active::before{
			background-color: #96d518 !important;
		}
		.footer-menu{
			display:none !important
		}
		.footer-bg01, .top-bar__custom-btn{
			background-color: #131b22 !important;
		}
		.btn-cart__badge{
			background-color: #96d518 !important;
		}
	</style>
	

	
	<?php } ?>

</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php do_action( 'storefront_before_site' ); ?>

<div id="page" class="hfeed site">
	<?php do_action( 'storefront_before_header' ); ?>
<?php if ( is_front_page() && is_home() ) {?>
	<header id="masthead" class="site-header" role="banner" style="<?php storefront_header_styles(); ?>">
		<div class="row mx-5">
			<?php
			/**
			 * Functions hooked into storefront_header action
			 *
			 * @hooked storefront_header_container                 - 0
			 * @hooked storefront_skip_links                       - 5
			 * @hooked storefront_social_icons                     - 10
			 * @hooked storefront_site_branding                    - 20
			 * @hooked storefront_secondary_navigation             - 30
			 * @hooked storefront_product_search                   - 40
			 * @hooked storefront_header_container_close           - 41
			 * @hooked storefront_primary_navigation_wrapper       - 42
			 * @hooked storefront_primary_navigation               - 50
			 * @hooked storefront_header_cart                      - 60
			 * @hooked storefront_primary_navigation_wrapper_close - 68
			 */
			do_action( 'storefront_header' );
			?>
            
		</div>

		
	</header><!-- #masthead -->
<?php } ?>
	<?php
	/**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 * @hooked woocommerce_breadcrumb - 10
	 */
	do_action( 'storefront_before_content' );
	?>
	
	<div id="content" class="site-content" tabindex="-1">
		<div class="col-full <?php echo $post->post_name;?>">

		<?php
		do_action( 'storefront_content_top' );
