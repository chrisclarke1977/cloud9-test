<?php
/**
 * Theme Options page
 *
 * @package Very Simple Start
 */

//Add the theme page
add_action('admin_menu', 'verysimplestart_add_theme_info');
function verysimplestart_add_theme_info(){
	$theme_info = add_theme_page( __('Theme Options','verysimplestart'), __('Theme Options','verysimplestart'), 'manage_options', 'verysimplestart-theme-options.php', 'verysimplestart_theme_options' );
}

//Callback
function verysimplestart_theme_options() {
	$customize_theme_url = add_query_arg( 'return', urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ), 'customize.php' );
?>
<div class="wrap">
<h1><?php _e('Theme Options','verysimplestart'); ?></h1>

<div id="welcome-panel" class="welcome-panel">
	<div class="welcome-panel-content">
		<h3><?php _e('Welcome to the Theme Options page!','verysimplestart'); ?></h3>
	<div class="welcome-panel-column-container">
	<div class="welcome-panel-column">
		<h4><?php _e('Here you may begin with the site customizations.','verysimplestart'); ?></h4>
	<p><?php _e('Please click on the big blue button below to get started.','verysimplestart'); ?></p>
			<a class="button button-primary button-hero load-customize hide-if-no-customize" href="<?php echo admin_url($customize_theme_url); ?>"><?php _e('Customize Your Site','verysimplestart'); ?></a>
			</div>
	<div class="welcome-panel-column">
		<h4><?php _e('Documentation and Demo','verysimplestart'); ?></h4>
		<ul>
					<li><a href="http://dessky.com/documentation/verysimplestart" target="_blank" class="welcome-icon welcome-learn-more"><?php _e('Theme Documentation','verysimplestart'); ?></a></li>
			<li><a href="http://demo.dessky.com/verysimplestart" target="_blank" class="welcome-icon welcome-view-site"><?php _e('Theme Demo','verysimplestart'); ?></a></li>
			<li><a href="http://dessky.com/theme/very-simple-start-pro" target="_blank" class="welcome-icon dashicons-cart"><?php _e('Order PRO Theme','verysimplestart'); ?></a></li>
		</ul>
	</div>
	<div class="welcome-panel-column">
		<h4><?php _e('Does this theme works with WooCommerce?','verysimplestart'); ?></h4>
		<p><?php _e('WooCommerce is supported only in the <a target="_blank" href="http://dessky.com/theme/very-simple-start-pro">PRO theme version</a>. By purchasing PRO theme you will also get Theme Support for One Year. You can purchase PRO theme on <a target="_blank" href="http://dessky.com/theme/very-simple-start-pro">this page</a>.','verysimplestart'); ?></p>
		<h4><?php _e('How to get Theme Support?','verysimplestart'); ?></h4>
		<p><?php _e('Unfortunately we are a small team of developers and right now we do not have necessary resources to provide free and high quality support on the WordPress.org forums. In order to get support from Dessky Team please purchase <a href="http://dessky.com/shop/one-year-support/" target="_blank">One Year Theme Support package</a> and <a href="http://dessky.com/tickets/" target="_blank">post a ticket</a> afterwards. We would be more than happy to help you.','verysimplestart'); ?></p>
	</div>
	</div>
	</div>
		</div>
		
		<h4><?php _e('If you like this theme, please don&rsquo;t forget to rate it!','verysimplestart'); ?> &#9733;&#9733;&#9733;&#9733;&#9733;</h4>

</div>	
<?php
}