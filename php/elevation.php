<?php
// Direktzugriff auf diese Datei verhindern:
defined( 'ABSPATH' ) or die();

include LEAFEXT_PLUGIN_DIR . '/php/elevation_functions.php';

//Shortcode: [elevation gpx="...url..."]

function leafext_elevation_script($gpx,$theme,$settings){
	$text = '
	<script>
	window.WPLeafletMapPlugin = window.WPLeafletMapPlugin || [];
	window.WPLeafletMapPlugin.push(function () {
		var map = window.WPLeafletMapPlugin.getCurrentMap();
		var elevation_options = {
		//lime-theme (default), magenta-theme, steelblue-theme, purple-theme, yellow-theme, lightblue-theme
			theme: '.json_encode($theme).',
		';

		foreach ($settings as $k => $v) {
			$text = $text. "$k: ";
			var_dump($k,$v);
			switch ($v) {
				case "false":
				case "0": $value = "false"; break;
				case "true":
				case "1": $value = "true"; break;
				case "null": $value = "null"; break;
				default: $value = '"'.$v.'"';
			}
			switch ($k) {
				case "polyline": $value = $v; break;
			}
			//old settings
			if ( $settings['summary'] == "1" ) {
				switch ($k) {
					case "summary": $value = '"inline"'; break;
					case "slope": $value = '"summary"'; break;
					case "speed": $value = "false"; break;
					case "acceleration": $value = "false"; break;
					case "time": $value = "false"; break;
					case "downloadLink": $value = "false"; break;
					case "polyline": $value = "{ weight: 3, }"; break;
				}
			}
			//old settings end
			$text = $text.$value;
			$text = $text.",\n";
		}

	$text = $text.'	};
		var mylocale = {
			"Altitude"	: "'.__("Altitude", "extensions-leaflet-map").'",
			"Total Length: "	: "'.__("Total Length", "extensions-leaflet-map").': ",
			"Max Elevation: "	: "'.__("Max Elevation", "extensions-leaflet-map").': ",
			"Min Elevation: "	: "'.__("Min Elevation", "extensions-leaflet-map").': ",
			"Total Ascent: "	: "'.__("Total Ascent", "extensions-leaflet-map").': ",
			"Total Descent: "	: "'.__("Total Descent", "extensions-leaflet-map").': ",
			"Min Slope: "	: "'.__("Min Slope", "extensions-leaflet-map").': ",
			"Max Slope: "	: "'.__("Max Slope", "extensions-leaflet-map").': ",
			"Speed: "	: "'.__("Speed", "extensions-leaflet-map").': ",
			"Min Speed: "	: "'.__("Min Speed", "extensions-leaflet-map").': ",
			"Max Speed: "	: "'.__("Max Speed", "extensions-leaflet-map").': ",
			"Avg Speed: "	: "'.__("Avg Speed", "extensions-leaflet-map").': ",
			"Acceleration: "	: "'.__("Acceleration", "extensions-leaflet-map").': ",
			"Min Acceleration: "	: "'.__("Min Acceleration", "extensions-leaflet-map").': ",
			"Max Acceleration: "	: "'.__("Max Acceleration", "extensions-leaflet-map").': ",
			"Avg Acceleration: "	: "'.__("Avg Acceleration", "extensions-leaflet-map").': ",
		};
		L.registerLocale("wp", mylocale);
		L.setLocale("wp");

		// Instantiate elevation control.
		var controlElevation = L.control.elevation(elevation_options);
		var track_options= { url: "'.$gpx.'" };
		controlElevation.addTo(map);
		// Load track from url (allowed data types: "*.geojson", "*.gpx")
		controlElevation.load(track_options.url);

	});
	</script>';
	//$text = \JShrink\Minifier::minify($text);
	return "\n".$text."\n";
}

function leafext_elevation_function( $atts ) {
	leafext_enqueue_elevation ();
	//
	$atts1=leafext_elevation_case(leafext_clear_params($atts));
	$options = shortcode_atts( array_merge(array('gpx' => false),leafext_elevation_settings()), $atts1);
	if ( ! $options['gpx'] ) wp_die("No gpx track!");
	$track = $options['gpx'];
	unset($options['gpx']);
	if ( array_key_exists('theme', $atts) ) {
		$theme = $atts['theme'];
	} else {
		$theme = leafext_elevation_theme();
	}
	unset($options['theme']);

	return leafext_elevation_script($track,$theme,$options);
}
add_shortcode('elevation', 'leafext_elevation_function' );
