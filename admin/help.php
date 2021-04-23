<?php
function leafext_help () {
    $text =
	"<p>".
'<h3 id="shortcodes">Shortcodes</h3>
<h4 id="display-a-track-with-elevation-profile">Display a track with elevation profile</h4>
<pre>
[leaflet-map ....]
// at least one marker if you use it with zoomehomemap
[leaflet-marker lat=... lng=... ...]Start[/leaflet-marker]
[elevation gpx="url_gpx_file"]
// or
[elevation gpx="url_gpx_file" summary=1]
</pre>
<h4 id="leaflet.markercluster">Leaflet.markercluster</h4>
<p>Many markers on a map become confusing. That is why they are clustered.</p>
<pre>
[leaflet-map ....]
// many markers
[leaflet-marker lat=... lng=... ...]poi1[/leaflet-marker]
[leaflet-marker lat=... lng=... ...]poi2[/leaflet-marker]
 ...
[leaflet-marker lat=... lng=... ...]poixx[/leaflet-marker]
[cluster]
[zoomhomemap]
</pre>
<h4 id="leaflet.featuregroup.subgroup">Leaflet.FeatureGroup.SubGroup</h4>
<p>dynamically add/remove groups of markers from Marker Cluster.
Parameter:</p>
<ul>
<li>feat - possible meaningful values: iconUrl, title, (other???)</li>
<li>strings - comma separated strings to distinguish the markers, e.g. an unique string in iconUrl or title</li>
<li>groups - comma separated labels appear in the selection menu</li>
<li>The number of strings and groups must match.</li>
</ul>
<pre>
[leaflet-marker title="..." iconUrl="...red..." ... ] ... [/leaflet-marker]
[leaflet-marker title="..." iconUrl="...green..." ... ] ... [/leaflet-marker]
//many markers
[markerClusterGroup feat="iconUrl" strings="red,green" groups="rot,gruen"]
</pre>
<p>Here the groups are differentiated according to the color of the markers.</p>
<h4 id="leaflet.zoomhome">leaflet.zoomhome</h4>
<p>&quot;Home&quot; button to reset the view. A must for clustering markers.</p>
<pre>
[leaflet-map ....]
  ...
[zoomhomemap]
</pre>
<h4 id="fullscreen">Fullscreen</h4>
<pre>
[fullscreen]
</pre>
<h4 id="gesturehandling">GestureHandling</h4>
<pre>
[leaflet-map dragging ... ]
// or
[leaflet-map scrollwheel ... ]
// or
[leaflet-map dragging scrollwheel ... ]
</pre>
<h4 id="hide-markers">Hide Markers</h4>
<pre>
[leaflet-map ...]
[leaflet-gpx src="//url/to/file.gpx" ... ]
[hidemarkers]
</pre>
<h4 id="hovergeojson">hovergeojson</h4>
<p>Use it to highlight a geojson area or line on mouse over.</p>
<pre>
[leaflet-map ...]
[leaflet-geojson src="//url/to/file.geojson" color="..."]...[/leaflet-geojson]
//or / and
[leaflet-gpx src="//url/to/file.gpx" color="..."]...[/leaflet-gpx]
//or / and
[leaflet-kml src="//url/to/file.kml" color="..."]...[/leaflet-kml]
[hover]
</pre>
<h4 id="switching-tile-layers">Switching Tile Layers</h4>
<p>First go to Settings -&gt; Leaflet Map -&gt; Leaflet Map Extensions and configure tile layers.</p>
<pre>
[leaflet-map mapid="..." ...]
[layerswitch]
</pre>
'
."</p>";
	return $text;
}
