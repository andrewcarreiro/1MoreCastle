<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'onemorecastle_options', 'onemorecastle_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'onemorecastletheme' ), __( 'Theme Options', 'onemorecastletheme' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create the options page
 */
function theme_options_do_page() {

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'onemorecastletheme' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'onemorecastletheme' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'onemorecastle_options' ); ?>
			<?php $options = get_option( 'onemorecastle_theme_options' ); ?>
			<table class="form-table">
				<tr valign="top"><th scope="row">Green box (largest)</th>
					<td>
						<input id="onemorecastle_theme_options[promo_box1]" class="regular-text" type="text" name="onemorecastle_theme_options[promo_box1]" value="<?php echo $options['promo_box1'] ; ?>" />
					</td>
				</tr>
				<tr valign="top"><th scope="row">Yellow box (top small)</th>
					<td>
						<input id="onemorecastle_theme_options[promo_box2]" class="regular-text" type="text" name="onemorecastle_theme_options[promo_box2]" value="<?php echo $options['promo_box2'] ; ?>" />
					</td>
				</tr>
				<tr valign="top"><th scope="row">Blue box (bottom small)</th>
					<td>
						<input id="onemorecastle_theme_options[promo_box3]" class="regular-text" type="text" name="onemorecastle_theme_options[promo_box3]" value="<?php echo $options['promo_box3'] ; ?>" />
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'onemorecastletheme' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $select_options, $radio_options;

	// Say our text option must be safe text with no HTML tags
	$input['promo_box1'] = wp_filter_nohtml_kses( $input['promo_box1'] );
	$input['promo_box2'] = wp_filter_nohtml_kses( $input['promo_box2'] );
	$input['promo_box3'] = wp_filter_nohtml_kses( $input['promo_box3'] );


	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/