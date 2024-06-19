/**
 * Javascript function for Shortcodes parentgroup
 *
 * @package Extensions for Leaflet Map
 */

/**
 * Create Javascript code for parentgroup
 */

function leafext_parentgroup_js(parent, childs, grouptext, visible) {
	var map    = window.WPLeafletMapPlugin.getCurrentMap();
	var map_id = map._leaflet_id;

	console.log( "parent " + parent + " on map " + map_id + "; childs:",childs,"; visible:",visible );

	if (typeof layerControl == "undefined" ) {
		layerControl = [];
	}
	if (typeof layerControl[map_id] == "undefined" ) {
		layerControl[map_id] = L.control.groupedLayers();
	}

	for (key in childs) {
		featGroups[map_id][childs[key]].remove();
		control[map_id].removeLayer( featGroups[map_id][childs[key]] );
		layerControl[map_id].addOverlay( featGroups[map_id][childs[key]], '__' + leafext_unescapeHTML( [grouptext[childs[key]]] ), '<b>' + parent + '</b>' );
	}

	for (key in childs) {
		if (visible[childs[key]] == "1") {
			featGroups[map_id][childs[key]].addTo( map );
		}
	}

	if (typeof layerControl[map_id]._map == "undefined") {
		map.removeControl( control[map_id] );
		layerControl[map_id].options.collapsed = control[map_id].options.collapsed;
		layerControl[map_id].options.position  = control[map_id].options.position;
		map.addControl( layerControl[map_id] );
	}
}
