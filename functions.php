<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version'    => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';
require 'inc/wordpress-shims.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce            = require 'inc/woocommerce/class-storefront-woocommerce.php';
	$storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

	require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
	require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';

	if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.0.0', '>=' ) ) {
		require 'inc/nux/class-storefront-nux-starter-content.php';
	}
}


function yoobe_enqueue_styles() {
    // Css e Scripts enfileirados do Boostratp e Sjquery
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
  }
add_action( 'wp_enqueue_scripts', 'yoobe_enqueue_styles');


function yoobe_enqueue_scripts() {
    wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.3.1.slim.min.js',3.31, true);
    wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.min.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js',array ( 'jquery' ), 4.1, true);
    wp_enqueue_script( 'bootstrapbundle', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js',array ( 'jquery' ), 4.1, true);

}
add_action( 'wp_enqueue_scripts', 'yoobe_enqueue_scripts');

/* Botões de  Mais e Menos no Produto */
add_action( 'woocommerce_after_add_to_cart_quantity', 'display_quantity_plus' );

function display_quantity_plus() {
     echo '<button type="button" class="plus" >+</button>';
}

add_action( 'woocommerce_before_add_to_cart_quantity', 'display_quantity_minus' );

function display_quantity_minus() {
     echo '<button type="button" class="minus" >-</button>';
}

add_action( 'wp_footer', 'add_cart_quantity_plus_minus' );

function add_cart_quantity_plus_minus() {
 // Only run this on the single product page
 if ( ! is_product() ) return;
 ?>
  <script type="text/javascript">

  jQuery(document).ready(function($){   

     $('form.cart').on( 'click', 'button.plus, button.minus', function() {

        // Get current quantity values
        var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
        var val   = parseFloat(qty.val());
        var max = parseFloat(qty.attr( 'max' ));
        var min = parseFloat(qty.attr( 'min' ));
        var step = parseFloat(qty.attr( 'step' ));

        // Change the value if plus or minus
        if ( $( this ).is( '.plus' ) ) {
           if ( max && ( max <= val ) ) {
              qty.val( max );
           } else {
              qty.val( val + step );
           }
        } else {
           if ( min && ( min >= val ) ) {
              qty.val( min );
           } else if ( val > 1 ) {
              qty.val( val - step );
           }
        }

     });
  });


  </script>
   <?php
}

// Mudança do local de notificações do carrinho do Storefront
add_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
add_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );
add_action( 'woocommerce_before_single_product_summary', 'wc_print_notices', 10 );
remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 ); /*Archive Product*/
remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 ); /*Single Product*/
remove_action( 'storefront_content_top', 'storefront_shop_messages', 1 );
remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );
add_action( 'wp_head', 'customize_notices' );
function customize_notices(){
    if( is_product() )
        remove_action( 'storefront_content_top', 'storefront_shop_messages', 15 );
    remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );
    
}




// add tag support to pages
function tags_support_all() {
	register_taxonomy_for_object_type('post_tag', 'page');
}

// ensure all tags are included in queries
function tags_support_query($wp_query) {
	if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
}

// tag hooks
add_action('init', 'tags_support_all');
add_action('pre_get_posts', 'tags_support_query');

add_action('wp_logout','ps_redirect_after_logout');
function ps_redirect_after_logout(){
         wp_redirect( home_url('/log-in/') );
         exit();
};


add_action( 'wp_login', 'redirect_dropshipper' );

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
    <h3><?php _e("Proteção da Loja", "blank"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="protegida"><?php _e("Loja só estara visível somente para usuários cadastrados?"); ?></label></th>
        <td>
            <?php $protected = get_the_author_meta( 'protegida', $user->ID )?>
            <select name="protegida">
                <option>Selecione</option>
                <option value="0" <?php if($protected == 0) echo 'selected="selected"'; ?>> <?php _e("Não"); ?> </option>
                <option value="1" <?php if($protected == 1) echo 'selected="selected"'; ?>"> <?php _e("Sim"); ?>  </option>
            </select>
        </td>
    </tr>
    </table>
<?php }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'protegida', $_POST['protegida'] );
}


add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );


/* Where to go if a login failed */
function custom_login_failed() {
	$login_page  = home_url('/log-in/');
	wp_redirect($login_page . '?login=failed');
	exit;
}
add_action('wp_login_failed', 'custom_login_failed');

/* Where to go if any of the fields were empty */
function verify_user_pass($user, $username, $password) {
	$login_page  = home_url('/log-in/');
	if($username == "" || $password == "") {
		wp_redirect($login_page . "?login=empty");
		exit;
	}
}
add_filter('authenticate', 'verify_user_pass', 1, 3);

add_filter( 'woocommerce_shipping_package_name', 'custom_shipping_package_name' );
function custom_shipping_package_name( $name ) {
  return 'Frete';
}
add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );



/**
 * Remove product data tabs
 */
 add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

 function woo_remove_product_tabs( $tabs ) {
 
     unset( $tabs['reviews'] ); 			// Remove the reviews tab
     unset( $tabs['additional_information'] );  	// Remove the additional information tab
     unset( $tabs['more_seller_product'] );  	// Remove the additional information tab
 
     return $tabs;
 }
 add_action( 'woocommerce_before_single_product_summary', 'woocommerce_output_all_notices', 10 );
 