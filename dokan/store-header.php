<?php
$store_user               = dokan()->vendor->get( get_post_field( 'post_author', get_the_id()) );
$store_info               = $store_user->get_shop_info();
$social_info              = $store_user->get_social_profiles();
$store_tabs               = dokan_get_store_tabs( $store_user->get_id() );
$social_fields            = dokan_get_social_profile_fields();

$dokan_appearance         = get_option( 'dokan_appearance' );
$profile_layout           = empty( $dokan_appearance['store_header_template'] ) ? 'default' : $dokan_appearance['store_header_template'];
$store_address            = dokan_get_seller_short_address( $store_user->get_id(), false );

$dokan_store_time_enabled = isset( $store_info['dokan_store_time_enabled'] ) ? $store_info['dokan_store_time_enabled'] : '';
$store_open_notice        = isset( $store_info['dokan_store_open_notice'] ) && ! empty( $store_info['dokan_store_open_notice'] ) ? $store_info['dokan_store_open_notice'] : __( 'Store Open', 'dokan-lite' );
$store_closed_notice      = isset( $store_info['dokan_store_close_notice'] ) && ! empty( $store_info['dokan_store_close_notice'] ) ? $store_info['dokan_store_close_notice'] : __( 'Store Closed', 'dokan-lite' );
$show_store_open_close    = dokan_get_option( 'store_open_close', 'dokan_appearance', 'on' );

$general_settings         = get_option( 'dokan_general', [] );
$banner_width             = dokan_get_option( 'store_banner_width', 'dokan_appearance', 625 );

if ( ( 'default' === $profile_layout ) || ( 'layout2' === $profile_layout ) ) {
    $profile_img_class = 'profile-img-circle';
} else {
    $profile_img_class = 'profile-img-square';
}

if ( 'layout3' === $profile_layout ) {
    unset( $store_info['banner'] );

    $no_banner_class      = ' profile-frame-no-banner';
    $no_banner_class_tabs = ' dokan-store-tabs-no-banner';

} else {
    $no_banner_class      = '';
    $no_banner_class_tabs = '';
}

?>

<div class="profile-frame">

    <div class="profile-info-box profile-layout-<?php echo esc_attr( $profile_layout ); ?>">
        

        <div class="profile-info-summery-wrapper dokan-clearfix">
            <div class="profile-info-summery">
                <div class="profile-info-head">
                    <div class="profile-img <?php echo esc_attr( $profile_img_class ); ?>">
                        <img src="<?php echo esc_url( $store_user->get_avatar() ) ?>"
                            alt="<?php echo esc_attr( $store_user->get_shop_name() ) ?>"
                            size="250">
                    </div>
                    <?php if ( ! empty( $store_user->get_shop_name() ) && 'default' === $profile_layout ) { ?>
                        <h1 class="store-name"><?php echo esc_html( $store_user->get_shop_name() ); ?></h1>
                    <?php } ?>
                </div>

                <div class="carrinho_topo align-middle">
                    <a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
                        <i class="ico_carrinho"></i>
                        <span><?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span>
                    </a>  
                </div>
                <a class="conta-topo float-right" href="<?php echo home_url(); ?>/minha-conta"><i class="fas fa-user"></i>&nbsp;Minha Conta</a>    
            </div><!-- .profile-info-summery -->
        </div><!-- .profile-info-summery-wrapper -->
    </div> <!-- .profile-info-box -->
</div> <!-- .profile-frame -->
<?php $banner = $store_user->get_banner() ;
    if ( $banner != ''){?>
<div class="banner">
    <div class="row">
        <img src="<?php echo esc_url( $store_user->get_banner() ); ?>">
    </div>
</div>
<?php }?>

