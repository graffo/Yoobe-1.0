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



// Async load para os scripts enfileirados
function ikreativ_async_scripts($url)
{
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
	return str_replace( '#asyncload', '', $url )."' async='async"; 
    }
add_filter( 'clean_url', 'ikreativ_async_scripts', 11, 1 );


// Css e Scripts enfileirados do Boostratp e Sjquery
wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );

wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery-3.4.1.slim.min.js#asyncload');
wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.min.js#asyncload');
wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js#asyncload');
wp_enqueue_script( 'bootstrapbundle', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js#asyncload');




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
add_action( 'wp_head', 'reposition_sf_messages' );
function reposition_sf_messages(){
    if( is_product() ) {
        remove_action( 'storefront_content_top','storefront_shop_messages',15 );
    }
    remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 ); /*Single Product*/
    add_action('woocommerce_product_meta_end', 'storefront_shop_messages', 1 );
    
}


// Campos extras do perfil de usuários no wp-admin
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

add_action( 'admin_enqueue_scripts', 'mytheme_backend_scripts');

if ( ! function_exists( 'mytheme_backend_scripts' ) ){
    function mytheme_backend_scripts( $hook ) {
        wp_enqueue_style( 'wp-color-picker');
        wp_enqueue_script( 'wp-color-picker');
    }
}

function extra_user_profile_fields( $user ) { ?>

<script>
        jQuery(document).ready(function($){
            $('.jscolor').each(function(){
                $(this).wpColorPicker();
                });
        });
        </script>   
    <h3><?php _e("Extra profile information", "blank"); ?></h3>
  
    <table class="form-table">
    <tr>
        <th><label for="header"><?php _e("Teste"); ?></label></th>
        <td>
        
      <input type="text" class="jscolor" >
      
    </div>
        </td>
    </tr>
    <tr>
        <th><label for="city"><?php _e("City"); ?></label></th>
        <td>
            <input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text jscolor" /><br />
            <span class="description"><?php _e("Please enter your city."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="postalcode"><?php _e("Postal Code"); ?></label></th>
        <td>
            <input type="text" name="postalcode" id="postalcode" value="<?php echo esc_attr( get_the_author_meta( 'postalcode', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your postal code."); ?></span>
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
    update_user_meta( $user_id, 'address', $_POST['address'] );
    update_user_meta( $user_id, 'city', $_POST['city'] );
    update_user_meta( $user_id, 'postalcode', $_POST['postalcode'] );
}

// Menu extra no vendor dashbpard do dokan
add_filter( 'dokan_query_var_filter', 'dokan_load_document_menu' );
function dokan_load_document_menu( $query_vars ) {
    $query_vars['customizacao'] = 'customizacao';
    return $query_vars;
}
add_filter( 'dokan_get_dashboard_nav', 'dokan_add_help_menu' );
function dokan_add_help_menu( $urls ) {
    $urls['customizacao'] = array(
        'title' => __( 'Customização', 'dokan'),
        'icon'  => '<i class="fa fa-user"></i>',
        'url'   => dokan_get_navigation_url( 'customizacao' ),
        'pos'   => 51
    );
    return $urls;
}
add_action( 'dokan_load_custom_template', 'dokan_load_template' );
function dokan_load_template( $query_vars ) {
    if ( isset( $query_vars['customizacao'] ) ) {
        require_once dirname( __FILE__ ). 'dokan/customizacao.php';
       }
}

// Ocultar notificações de atualizações do wordpress, temas e plugins
function remove_core_updates(){
global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates'); //hide updates for WordPress itself
add_filter('pre_site_transient_update_plugins','remove_core_updates'); //hide updates for all plugins
add_filter('pre_site_transient_update_themes','remove_core_updates'); //hide updates for all themes