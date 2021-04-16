// For use with only one map on a webpage

window.WPLeafletMapPlugin = window.WPLeafletMapPlugin || [];
window.WPLeafletMapPlugin.push(function () {
	var map = window.WPLeafletMapPlugin.getCurrentMap();
	//console.log(map);
	//console.log(window.WPLeafletMapPlugin);
	if ( WPLeafletMapPlugin.geojsons.length > 0 ) {
		var geojsons = window.WPLeafletMapPlugin.geojsons;
		var geocount = geojsons.length;

		for (var j = 0, len = geocount; j < len; j++) {
			var geojson = geojsons[j];
			//console.log(geojson);
			geojson.layer.on('mouseover', function () {
				//console.log("over");
				this.setStyle({
					fillOpacity: 0.4,
					weight: 5
				});
				this.bringToFront();
			});
			geojson.layer.on('mouseout', function () {
				//console.log("out");
				this.setStyle({
					fillOpacity: 0.2,
					weight: 3
				});
			});
			geojson.layer.on('mouseover', function (e) {
				e.target.eachLayer(function(layer) {
					layer.openPopup();
				});
			});
			geojson.layer.on('mousemove', function (e) {
				e.target.eachLayer(function(layer) {
					layer.getPopup().setLatLng(e.latlng);
				});
            });
			//Klappt irgendwie nicht, arbeitet nicht sauber
			// geojson.layer.on('mouseout', function (e) {
				// //console.log(e);
				// e.target.eachLayer(function(layer) {
					// //console.log(layer.isPopupOpen());
					// layer.closePopup();
				// });
			// });
		}
	}
});
