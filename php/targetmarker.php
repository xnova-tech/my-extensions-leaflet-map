<?php
/**
 * Functions for marker target
 *
 * @package Extensions for Leaflet Map
 */

// Direktzugriff auf diese Datei verhindern.
defined( 'ABSPATH' ) || die();

// interpret shortcode
function leafext_targetmarker_function( $atts, $content, $shortcode ) {
	$text = leafext_should_interpret_shortcode( $shortcode, $atts );
	if ( $text != '' ) {
		return $text;
	} else {
		leafext_enqueue_targetmarker();
		$error = 'error';
		// var_dump($atts);
		$options         = shortcode_atts(
			array(
				'lat'      => '',
				'lng'      => '',
				'property' => '',
				'value'    => '',
				'title'    => '',
				'link'     => '',
				'linktext' => 'Target',
				'popup'    => 'Target',
				'zoom'     => false,
				'debug'    => false,
			),
			leafext_clear_params( $atts )
		);
		$options['zoom'] = $options['zoom'] ? $options['zoom'] : wp_json_encode( $options['zoom'] );
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- no form
		if ( $shortcode == 'targetmarker' ) {
			$error = 'targetmarker error';
			$get   = map_deep( wp_unslash( $_GET ), 'sanitize_text_field' );
			if ( count( $get ) > 0 && count( array_intersect_key( $get, $options ) ) > 0 ) {
				// QUERY_STRING exists
				$options['lat'] = isset( $get['lat'] ) ? filter_var( $get['lat'], FILTER_VALIDATE_FLOAT ) : '';
				$options['lng'] = isset( $get['lng'] ) ? filter_var( $get['lng'], FILTER_VALIDATE_FLOAT ) : '';

				if ( $options['lat'] != '' && $options['lng'] != '' ) {
					// lat and Lng to a target page
					return leafext_target_get_lanlng_script( $options );
				}
				$error = 'GET - lat lng missing';
			} // GET end

			if ( ! empty( $_POST ) && check_admin_referer( 'leafext_targetlink', 'leafext_targetlink_nonce' ) ) {
				// var_dump( $_POST );
				$get              = map_deep( wp_unslash( $_POST ), 'sanitize_text_field' );
				$options['title'] = isset( $get['title'] ) ? wp_strip_all_tags( $get['title'] ) : '';
				if ( $options['title'] != '' ) {
					return leafext_target_post_title_script( $options );
				}
				$options['property'] = isset( $get['property'] ) ? wp_strip_all_tags( $get['property'] ) : '';
				$options['value']    = isset( $get['value'] ) ? wp_strip_all_tags( $get['value'] ) : '';
				if ( $options['property'] != '' && $options['value'] != '' ) {
					return leafext_target_post_geojson_script( $options );
				}
				$error = 'POST - error';
			} // POST end

		} elseif ( $shortcode == 'targetlink' ) {
			$error = 'targetlink error';
			if ( $options['link'] != '' && $options['title'] != '' ) {
				$rand = wp_rand( 1, 2000 );
				$text = '<form id=targetlink_' . $rand . ' style="display: inline-block; method="post" action="' . esc_url( $options['link'] ) . '">';
				$text = $text . '<input type="hidden" name="title" value="' . wp_strip_all_tags( $options['title'] ) . '">';
				$text = $text . wp_nonce_field( 'leafext_targetlink', 'leafext_targetlink_nonce' );
				$text = $text . '<a href="javascript:;" onclick="parentNode.submit();">' . $options['linktext'] . '</a>';
				$text = $text . '</form>';
				$text = $text . '<script>';
				$text = $text . 'if (document.getElementById("targetlink_' . $rand . '").previousElementSibling.nodeName == "P") {
				document.getElementById("targetlink_' . $rand . '").previousElementSibling.style.display="inline-block";}';
				// $text = $text.'leafext_target_href('.$rand.');';
				$text = $text . '</script>';
				return $text;

			} elseif ( $options['link'] != '' && $options['property'] != '' && $options['value'] != '' ) {
				$rand = wp_rand( 1, 2000 );
				$text = '<form id=targetlink_' . $rand . ' style="display: inline-block;" method="post" action="' . esc_url( $options['link'] ) . '">';
				$text = $text . '<input type="hidden" name="property" value="' . wp_strip_all_tags( $options['property'] ) . '">';
				$text = $text . '<input type="hidden" name="value" value="' . wp_strip_all_tags( $options['value'] ) . '">';
				$text = $text . wp_nonce_field( 'leafext_targetlink', 'leafext_targetlink_nonce', true, false );
				$text = $text . '&nbsp;<a href="javascript:;" onclick="parentNode.submit();">' . $options['linktext'] . '</a>';
				$text = $text . '</form>';
				$text = $text . '<script>';
				$text = $text . 'if (document.getElementById("targetlink_' . $rand . '").previousElementSibling.nodeName == "P") {
				document.getElementById("targetlink_' . $rand . '").previousElementSibling.style.display="inline-block";}';
				// $text = $text.'leafext_target_href('.$rand.');';
				$text = $text . '</script>';
				return $text;

			} elseif ( $options['lat'] != '' && $options['lng'] != '' ) {
				// lat and lng same page / post
				$text = '<a href="javascript:leafext_jump_to_map();" onclick="leafext_target_same_lanlng_js('
				. filter_var( $options['lat'], FILTER_VALIDATE_FLOAT ) . ','
				. filter_var( $options['lng'], FILTER_VALIDATE_FLOAT ) . ','
				. '\'' . $options['popup'] . '\','
				. $options['zoom'] . ','
				. wp_json_encode( $options['debug'] )
				. ')">' . $options['linktext'] . '</a>';
				return $text;

			} elseif ( $options['property'] != '' && $options['value'] != '' ) {
				// geojson property and value on the same page / post
				$text = '<a href="javascript:leafext_jump_to_map();" onclick="leafext_target_same_geojson_js('
				. '\'' . $options['property'] . '\','
				. '\'' . $options['value'] . '\','
				. '\'' . $options['popup'] . '\','
				. $options['zoom'] . ','
				. wp_json_encode( $options['debug'] )
				. ')">' . $options['linktext'] . '</a>';
				return $text;

			} elseif ( $options['title'] != '' ) {
				// marker title on the same page / post
				$text = '<a href="javascript:leafext_jump_to_map();" onclick="leafext_target_same_title_js('
				. '\'' . $options['title'] . '\','
				. '\'' . $options['popup'] . '\','
				. $options['zoom'] . ','
				. wp_json_encode( $options['debug'] )
				. ')">' . $options['linktext'] . '</a>';
				return $text;
			}
		}
		// error
		$text = '[' . $shortcode . ' ';
		if ( is_array( $atts ) ) {
			foreach ( $atts as $key => $item ) {
				$text = $text . "$key=$item ";
			}
		}
		$text = $text . ' - something is wrong. ' . $error . ']';
		return '<script>console.log("' . esc_js( $text ) . '");</script>';
	}
}
add_shortcode( 'targetmarker', 'leafext_targetmarker_function' );
add_shortcode( 'targetlink', 'leafext_targetmarker_function' );

// Shortcode: [targetmarker] if lat and lng in QUERY_STRING
function leafext_target_get_lanlng_script( $options ) {
	$text = '<script><!--';
	ob_start();
	?>
	/*<script>*/
	window.WPLeafletMapPlugin = window.WPLeafletMapPlugin || [];
	window.WPLeafletMapPlugin.push(function () {
		let lat = <?php echo wp_json_encode( $options['lat'] ); ?>;
		let lng = <?php echo wp_json_encode( $options['lng'] ); ?>;
		let target = <?php echo wp_json_encode( $options['popup'] ); ?>;
		let zoom =
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $options['zoom'];
		?>
		;
		let debug = <?php echo wp_json_encode( $options['debug'] ); ?>;
		leafext_target_get_lanlng_js(lat,lng,target,zoom,debug);
	});
	<?php
	$javascript = ob_get_clean();
	$text       = $text . $javascript . '//-->' . "\n" . '</script>';
	$text       = \JShrink\Minifier::minify( $text );
	return "\n" . $text . "\n";
}

function leafext_target_post_title_script( $options ) {
	$text = '<script><!--';
	ob_start();
	?>
	/*<script>*/
	window.WPLeafletMapPlugin = window.WPLeafletMapPlugin || [];
	window.WPLeafletMapPlugin.push(function () {
		let title = <?php echo wp_json_encode( $options['title'] ); ?>;
		let popup = <?php echo wp_json_encode( $options['popup'] ); ?>;
		let zoom =
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $options['zoom'];
		?>
		;
		let debug = <?php echo wp_json_encode( $options['debug'] ); ?>;
		leafext_target_post_title_js(title,popup,zoom,debug);
	});
	<?php
	$javascript = ob_get_clean();
	$text       = $text . $javascript . '//-->' . "\n" . '</script>';
	$text       = \JShrink\Minifier::minify( $text );
	return "\n" . $text . "\n";
}

function leafext_target_post_geojson_script( $options ) {
	$text = '<script><!--';
	ob_start();
	?>
	/*<script>*/
	window.WPLeafletMapPlugin = window.WPLeafletMapPlugin || [];
	window.WPLeafletMapPlugin.push(function () {
		let property = <?php echo wp_json_encode( $options['property'] ); ?>;
		let value = <?php echo wp_json_encode( $options['value'] ); ?>;
		let target = <?php echo wp_json_encode( $options['target'] ); ?>;
		let popup = <?php echo wp_json_encode( $options['popup'] ); ?>;
		let zoom =
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $options['zoom'];
		?>
		;
		let debug = <?php echo wp_json_encode( $options['debug'] ); ?>;
		leafext_target_post_geojson_js(property,value,target,popup,zoom,debug);
	});
	<?php
	$javascript = ob_get_clean();
	$text       = $text . $javascript . '//-->' . "\n" . '</script>';
	$text       = \JShrink\Minifier::minify( $text );
	return "\n" . $text . "\n";
}
