function leafext_elevation_locale_js() {
  const { __, _x, _n, sprintf } = wp.i18n;
	var mylocale = {
		"Acceleration"		: _x("Acceleration", "In Frontend", "extensions-leaflet-map"),
		"Altitude"				: _x("Altitude", "In Frontend", "extensions-leaflet-map"),
		"Slope"						: _x("Slope", "In Frontend", "extensions-leaflet-map"),
		"Speed"						: _x("Speed", "In Frontend", "extensions-leaflet-map"),
		"Total Time: "		: _x("Total Time", "In Frontend", "extensions-leaflet-map")+": ",
		"Total Length: "	: _x("Total Length", "In Frontend", "extensions-leaflet-map")+": ",
		"Max Elevation: "	: _x("Max Elevation", "In Frontend", "extensions-leaflet-map")+": ",
		"Min Elevation: "	: _x("Min Elevation", "In Frontend", "extensions-leaflet-map")+": ",
		"Avg Elevation: "	: _x("Avg Elevation", "In Frontend", "extensions-leaflet-map")+": ",
		"Total Ascent: "	: _x("Total Ascent", "In Frontend", "extensions-leaflet-map")+": ",
		"Total Descent: "	: _x("Total Descent", "In Frontend", "extensions-leaflet-map")+": ",
		"Min Slope: "			: _x("Min Slope", "In Frontend", "extensions-leaflet-map")+": ",
		"Max Slope: "			: _x("Max Slope", "In Frontend", "extensions-leaflet-map")+": ",
		"Avg Slope: "			: _x("Avg Slope", "In Frontend", "extensions-leaflet-map")+": ",
		"Min Speed: "			: _x("Min Speed", "In Frontend", "extensions-leaflet-map")+": ",
		"Max Speed: "			: _x("Max Speed", "In Frontend", "extensions-leaflet-map")+": ",
		"Avg Speed: "			: _x("Avg Speed", "In Frontend", "extensions-leaflet-map")+": ",
		"Min Acceleration: "	: _x("Min Acceleration", "In Frontend", "extensions-leaflet-map")+": ",
		"Max Acceleration: "	: _x("Max Acceleration", "In Frontend", "extensions-leaflet-map")+": ",
		"Avg Acceleration: "	: _x("Avg Acceleration", "In Frontend", "extensions-leaflet-map")+": ",
		"Pace"						: _x("Pace", "In Frontend", "extensions-leaflet-map"),
		"Min Pace: "			: _x("Min Pace", "In Frontend", "extensions-leaflet-map")+": ",
		"Max Pace: "			: _x("Max Pace", "In Frontend", "extensions-leaflet-map")+": ",
		"Avg Pace: "			: _x("Avg Pace", "In Frontend", "extensions-leaflet-map")+": ",
		"Download" 				: _x("Download", "In Frontend", "extensions-leaflet-map"),
		"Elevation" 			: _x("Elevation", "In Frontend", "extensions-leaflet-map"),

		"a: " 			: _x("a",    "In Frontend: Abbreviation for acceleration in the chart", "extensions-leaflet-map")+": ",
		"cad: " 		: _x("cad",  "In Frontend: Abbreviation for cadence in the chart", "extensions-leaflet-map")+": ",
		"hr: " 			: _x("hr",   "In Frontend: Abbreviation for heart rate in the chart", "extensions-leaflet-map")+": ",
		"m: " 			: _x("m",    "In Frontend: Abbreviation for slope in the chart", "extensions-leaflet-map")+": ",
		"pace: " 		: _x("pace", "In Frontend: Abbreviation for pace in the chart", "extensions-leaflet-map")+": ",
		"t: " 			: _x("t",    "In Frontend: Abbreviation for time in the chart", "extensions-leaflet-map")+": ",
		"T: " 			: _x("T",    "In Frontend: Abbreviation for duration in the chart", "extensions-leaflet-map")+": ",
		"v: " 			: _x("v",    "In Frontend: Abbreviation for speed in the chart", "extensions-leaflet-map")+": ",
		"x: " 			: _x("x",    "In Frontend: Abbreviation for length in the chart", "extensions-leaflet-map")+": ",
		"y: " 			: _x("y",    "In Frontend: Abbreviation for altitude in the chart", "extensions-leaflet-map")+": ",
	};
	L.registerLocale("wp", mylocale);
	L.setLocale("wp");
}
