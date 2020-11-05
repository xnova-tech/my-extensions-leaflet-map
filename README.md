# wp-leaflet-extensions

**Contributors:** hupe13 \
**Tags:** wordpress, leaflet-map, fullscreen, elevation, markercluster, zoomhome  \
**Requires at least:** 5.5.3 \
**Tested up to:** 5.5.3 \
**Stable tag:** 0.0.1 \
**Requires PHP:** 7.4 \
**License:** GPLv2 or later \
**License URI:** https://www.gnu.org/licenses/gpl-2.0.html

## Description

Plugin to extend the Wordpress Plugin <a href="https://wordpress.org/plugins/leaflet-map/">Leaflet Map</a>, see Bozdoz <a href

### "https://github.com/bozdoz/wp-plugin-leaflet-map#how-can-i-add-another-leaflet-plugin">FAQ</a>.

## Installation

1. Upload the plugin files to the `/wp-content/plugins/wp-leaflet-extensions` directory or use the https://github.com/afragen/github-updater
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Go to Settings - Leaflet Extensions and select the theme for elevation.

## Frequently Asked Questions

### Is this running alone ?

No, you need to install the plugin "Leaflet Map"

## Changelog

### 0.0.1

* First Release (Test)



<h3>Display a track with elevation profile</h3>

Leaflet Plugin: <a href="https://github.com/Raruto/leaflet-elevation">leaflet-elevation</a>.
<pre>
[leaflet-map ....]
// at least one marker if you use it with zoomehomemap
[leaflet-marker lat=... lng=... ...]Start[/leaflet-marker]
[elevation gpx="url_gpx_file"]
// or
[elevation gpx="url_gpx_file" summary=1]
</pre>

<h3>Fullscreen</h3>

Leaflet Plugin: <a href="https://github.com/brunob/leaflet.fullscreen">leaflet.fullscreen</a>

<pre>[fullscreen]</pre>

<h3>GestureHandling</h3>

Leaflet Plugin: <a href="https://github.com/elmarquis/Leaflet.GestureHandling">Leaflet.GestureHandling</a>. Use it for a map whose options are  
<pre>dragging</pre> and/or <pre>scrollwheel</pre>

<h3>Hide Markers</h3>

Use it when a track in a GPX file contains some markers and you don't want to display them on the map.
<pre>
[leaflet-map ...]
[leaflet-gpx src="..." ... ]
[hidemarkers]
</pre>

<h3>hovergeojson</h3>

Use it to highlight a geojson area on mouse over.
<pre>
[leaflet-map ...]
[leaflet-geojson src="...." color="..."]...[/leaflet-geojson]
[hover]
</pre>

<h3>Leaflet.markercluster</h3>

Leaflet Plugin: <a href="https://github.com/Leaflet/Leaflet.markercluster">Leaflet.markercluster</a>.
<pre>
[leaflet-map ....]
// many markers
[leaflet-marker lat=... lng=... ...]poi1[/leaflet-marker]
[leaflet-marker lat=... lng=... ...]poi2[/leaflet-marker]
 ...
[leaflet-marker lat=... lng=... ...]poixx[/leaflet-marker]
[markercluster]
</pre>

<h3>leaflet.zoomhome</h3>

Leaflet Plugin: <a href="https://github.com/torfsen/leaflet.zoomhome">leaflet.zoomhome</a>, the Code is in the directory leflet-plugins.

<pre>
[leaflet-map ....]
  ...
[zoomhomemap]
</pre>

Mehr <a href="https://phw-web.de/doku/leaflet/">Dokumentation</a> auf deutsch.
