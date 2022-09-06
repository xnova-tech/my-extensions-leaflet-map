<?php
/**
* Functions for enqueuing Leaflet plugins
* extensions-leaflet-map
*/
// Direktzugriff auf diese Datei verhindern:
defined( 'ABSPATH' ) or die();

// For checking to load awesome (Home character)
function leafext_plugin_stylesheet_installed($array_css) {
  global $wp_styles;
  foreach( $wp_styles->queue as $style ) {
    foreach ($array_css as $css) {
      if (false !== strpos( $style, $css ))
      return 1;
    }
  }
  return 0;
}

function leafext_enqueue_awesome() {
  // Font awesome
  $font_awesome = array('font-awesome', 'fontawesome');
  if (leafext_plugin_stylesheet_installed($font_awesome) === 0) {
    wp_enqueue_style('font-awesome',
    plugins_url('fonts/fontawesome-free-6.2.0-web/css/all.min.css',
    LEAFEXT_PLUGIN_FILE),
    null, null);
  }
}

function leafext_css() {
  wp_enqueue_style( 'leafext_css',
  plugins_url('css/leafext.min.css',
  LEAFEXT_PLUGIN_FILE),
  array('leaflet_stylesheet'),null);
}

function leafext_enqueue_zoomhome () {
  wp_enqueue_script('zoomhome',
  plugins_url('leaflet-plugins/leaflet.zoomhome/leaflet.zoomhome.min.js',
  LEAFEXT_PLUGIN_FILE),
  array('wp_leaflet_map'), null);
  wp_enqueue_style('zoomhome',
  plugins_url('leaflet-plugins/leaflet.zoomhome/leaflet.zoomhome.css',
  LEAFEXT_PLUGIN_FILE),
  array('leaflet_stylesheet'), null);
  leafext_enqueue_awesome();
  leafext_css();
}

function leafext_enqueue_markercluster () {
  wp_enqueue_style( 'markercluster.default',
  plugins_url('leaflet-plugins/leaflet.markercluster-1.5.3/css/MarkerCluster.Default.css',
  LEAFEXT_PLUGIN_FILE),
  array('leaflet_stylesheet'),null);
  wp_enqueue_style( 'markercluster',
  plugins_url('leaflet-plugins/leaflet.markercluster-1.5.3/css/MarkerCluster.css',
  LEAFEXT_PLUGIN_FILE),
  array('leaflet_stylesheet'),null);
  wp_enqueue_script('markercluster',
  plugins_url('leaflet-plugins/leaflet.markercluster-1.5.3/js/leaflet.markercluster.js',
  LEAFEXT_PLUGIN_FILE),
  array('wp_leaflet_map'),null );
}

$params = get_option('leafext_eleparams');
if (is_array($params) && key_exists('testing', $params) && (bool)$params['testing']) {
  define('LEAFEXT_ELEVATION_VERSION',"2.2.6i");
} else {
  define('LEAFEXT_ELEVATION_VERSION',"2.2.6");
}
define('LEAFEXT_ELEVATION_URL', LEAFEXT_PLUGIN_URL . '/leaflet-plugins/leaflet-elevation-'.LEAFEXT_ELEVATION_VERSION.'/');
define('LEAFEXT_ELEVATION_DIR', LEAFEXT_PLUGIN_DIR . '/leaflet-plugins/leaflet-elevation-'.LEAFEXT_ELEVATION_VERSION.'/');
function leafext_enqueue_elevation () {
  if (LEAFEXT_ELEVATION_VERSION == "2.2.6i") {
    wp_enqueue_script( 'elevation_js',
    //plugins_url('leaflet-plugins/leaflet-elevation-'.LEAFEXT_ELEVATION_VERSION.'/dist/leaflet-elevation.min.js',
    plugins_url('leaflet-plugins/leaflet-elevation-'.LEAFEXT_ELEVATION_VERSION.'/dist/leaflet-elevation.js',
    LEAFEXT_PLUGIN_FILE),
    array('wp_leaflet_map'),null);
  } else {
    wp_enqueue_script( 'elevation_js',
    plugins_url('leaflet-plugins/leaflet-elevation-'.LEAFEXT_ELEVATION_VERSION.'/dist/leaflet-elevation.min.js',
    LEAFEXT_PLUGIN_FILE),
    array('wp_leaflet_map'),null);
  }

  //
  wp_enqueue_script( 'Leaflet.i18n',
  plugins_url('leaflet-plugins/Leaflet.i18n/Leaflet.i18n.js',
  LEAFEXT_PLUGIN_FILE),
  array('elevation_js'),null);
  //
  wp_enqueue_style( 'elevation_css',
  plugins_url('leaflet-plugins/leaflet-elevation-'.LEAFEXT_ELEVATION_VERSION.'/dist/leaflet-elevation.min.css',
  LEAFEXT_PLUGIN_FILE),
  array('leaflet_stylesheet'),null);
  //
  leafext_css();
}

function leafext_enqueue_elevation_css () {
  wp_enqueue_style( 'elevation_css_admin',
  plugins_url('leaflet-plugins/leaflet-elevation-'.LEAFEXT_ELEVATION_VERSION.'/dist/leaflet-elevation.min.css',
  LEAFEXT_PLUGIN_FILE),
  null,null);
}

function leafext_enqueue_multielevation () {
  leafext_enqueue_elevation ();
  leafext_enqueue_zoomhome();
  wp_enqueue_script('leaflet.gpxgroup',
  plugins_url('leaflet-plugins/leaflet-elevation-'.LEAFEXT_ELEVATION_VERSION.'/libs/leaflet-gpxgroup.js',
  LEAFEXT_PLUGIN_FILE),
  array('elevation_js'),null);
  wp_enqueue_script('leaflet_ajax_geojson_js');
  wp_enqueue_script('Leaflet.GeometryUtil',
  plugins_url('leaflet-plugins/Leaflet.GeometryUtil/leaflet.geometryutil.js',
  LEAFEXT_PLUGIN_FILE),
  array('elevation_js'),null);
  wp_enqueue_script('leaflet.distanceMarkers',
  plugins_url('leaflet-plugins/leaflet-elevation-'.LEAFEXT_ELEVATION_VERSION.'/libs/leaflet-distance-marker.min.js',
  LEAFEXT_PLUGIN_FILE),
  array('Leaflet.GeometryUtil'),null);
  wp_enqueue_style( 'leaflet.distanceMarkers',
  plugins_url('leaflet-plugins/leaflet-elevation-'.LEAFEXT_ELEVATION_VERSION.'/libs/leaflet-distance-marker.min.css',
  LEAFEXT_PLUGIN_FILE),
  array('elevation_css'),null);
  leafext_css();
  leafext_enqueue_zoomhome();
}

function leafext_enqueue_clustergroup () {
  wp_enqueue_script('leaflet.subgroup',
  plugins_url(
    'leaflet-plugins/Leaflet.FeatureGroup.SubGroup-1.0.2/leaflet.featuregroup.subgroup.js',
    LEAFEXT_PLUGIN_FILE),
    array('markercluster'),null);
  }

  function leafext_enqueue_placementstrategies () {
    wp_enqueue_script('placementstrategies',
    plugins_url('leaflet-plugins/Leaflet.MarkerCluster.PlacementStrategies/leaflet-markercluster.placementstrategies.js',
    LEAFEXT_PLUGIN_FILE),
    array('markercluster'),null );
  }

  function leafext_enqueue_fullscreen () {
    wp_enqueue_style( 'leaflet.fullscreen',
    plugins_url('leaflet-plugins/leaflet.fullscreen/Control.FullScreen.css',
    LEAFEXT_PLUGIN_FILE),
    array('leaflet_stylesheet'),null);
    wp_enqueue_script('leaflet.fullscreen',
    plugins_url('leaflet-plugins/leaflet.fullscreen/Control.FullScreen.js',
    LEAFEXT_PLUGIN_FILE),
    array('wp_leaflet_map'),null);
  }

  define('LEAFEXT_GESTURE_VERSION',"1.4.3");
  define('LEAFEXT_GESTURE_LOCALE_DIR', LEAFEXT_PLUGIN_DIR .
  'leaflet-plugins/leaflet-gesture-handling-'.LEAFEXT_GESTURE_VERSION.'/dist/locales/');
  function leafext_enqueue_gestures() {
    wp_enqueue_script('gestures_leaflet',
    plugins_url('leaflet-plugins/leaflet-gesture-handling-'.LEAFEXT_GESTURE_VERSION.'/dist/leaflet-gesture-handling.min.js',
    LEAFEXT_PLUGIN_FILE),
    array('wp_leaflet_map'), null);
    wp_enqueue_style('gestures_leaflet_styles',
    plugins_url('leaflet-plugins/leaflet-gesture-handling-'.LEAFEXT_GESTURE_VERSION.'/dist/leaflet-gesture-handling.min.css',
    LEAFEXT_PLUGIN_FILE),
    array('leaflet_stylesheet'),null);
  }

  function leafext_enqueue_opacity () {
    wp_enqueue_style( 'Leaflet.Control.Opacity',
    plugins_url('leaflet-plugins/Leaflet.Control.Opacity/L.Control.Opacity.css',
    LEAFEXT_PLUGIN_FILE),
    array('leaflet_stylesheet'),null);
    wp_enqueue_script('Leaflet.Control.Opacity',
    plugins_url('leaflet-plugins/Leaflet.Control.Opacity/L.Control.Opacity.js',
    LEAFEXT_PLUGIN_FILE),
    array('wp_leaflet_map'),null);
  }

  define('LEAFEXT_PROVIDERS_JS_FILE', LEAFEXT_PLUGIN_DIR .
  'leaflet-plugins/leaflet-providers/leaflet-providers.js');
  function leafext_enqueue_providers() {
    wp_enqueue_script('providers',
    plugins_url('leaflet-plugins/leaflet-providers/leaflet-providers.js',LEAFEXT_PLUGIN_FILE),
    array('wp_leaflet_map'),null );
  }

  function leafext_enqueue_extramarker () {
  	wp_enqueue_script('extramarker',
  		plugins_url('leaflet-plugins/Leaflet.ExtraMarkers/dist/js/leaflet.extra-markers.min.js',
  		LEAFEXT_PLUGIN_FILE),
  		array('wp_leaflet_map'), null);
  	wp_enqueue_style('extramarker',
  		plugins_url('leaflet-plugins/Leaflet.ExtraMarkers/dist/css/leaflet.extra-markers.min.css',
  		LEAFEXT_PLUGIN_FILE),
  		array('leaflet_stylesheet'), null);
  	leafext_enqueue_awesome();
  }
