var watchId;
var map;
var ourCoords = {
	latitude: 37.383116,
	longitude: -121.971931
};
var options = {
	enableHighAccuracy: true, 
	timeout:300000, 
	maximumAge:0	
};

// when window loads, call getMyLocation function
window.onload = getMyLocation;

// check to see if device supports navigator.geolocation, if so call displayLocation
function getMyLocation() {
	if(navigator.geolocation) {
		//navigator.geolocation.watchPosition(displayLocation, displayError, options);	
		var watchButton = document.getElementById("watch");
		watchButton.onclick = watchLocation;
		var clearWatchbutton = document.getElementById("clearWatch");
		clearWatchButton.onlick = clearWatch;
	}
	else {
		alert("Sorry, there is no geolocation support");	
	}
}
// Create clearWatch
function clearWatch () {
	if(watchID) {
		navigator.geolocation.clearWatch(watchId);
		watchId = null;	
	}
}
// Create watchLocation
function watchLocation(){
	watchId = navigator.geolocation.watchPosition(displayLocation, displayError, options);
}



//  getMyLocation function calls displayLocation if device supports Geolocation Obejct
// displayLocation function gets lat/long info using position.coords property
function displayLocation(position) {
	var latitude = position.coords.latitude;
	var longitude = position.coords.longitude;
	
	var div = document.getElementById("location");
	div.innerHTML = "You are at Latitude: "+ latitude + ", Longitude: " + longitude;
	div.innerHTML += " (with " + position.coords.accuracy+ " meters accuracy)";
	
	var km = computeDistance(position.coords, ourCoords);
	var distance = document.getElementById("distance");
	distance.innerHTML = "You are " +km+ " km from UCSC Extension";	
	
	if (map == null) {
		showMap(position.coords);
	}
	else {
		scrollMapToPosition(position.coords);
	}
}

// Error Messages - if user "Denies" or some other issue occurs...
function displayError(error) {
	var errorTypes = {
		0: "Unknown error",
		1: "Permission denied by user",
		2: "Position is not available",
		3: "Request timed out"	
	}
	var errorMessage = errorTypes[error.code];
	if (error.code == 0 || error.code == 2) {
		errorMessage = errorMessage +" " + error.message;	
	}
	var div = document.getElementById("location");
	div.innerHTML = errorMessage;
}

// Calculating Distance: 
function computeDistance(startCoords, destCoords) {
	var startLatRads = degreesToRadians(startCoords.latitude);
	var startLongRads = degreesToRadians(startCoords.longitude);	
	var destLatRads = degreesToRadians(destCoords.latitude);
	var destLongRads = degreesToRadians(destCoords.longitude);
	
	var Radius = 6371; // radius of the earth in km 
	var distance = Math.acos(Math.sin(startLatRads) * Math.sin(destLatRads) + Math.cos(startLatRads) * Math.cos(destLatRads) * Math.cos(startLongRads-destLongRads)) * Radius;
	
	return distance;
}

function degreesToRadians(degrees) {
	var radians = (degrees * Math.PI)/180;
	return radians;	
}

// Use Google Maps JavaScript API to bring up Road, Satellite map
function showMap(coords) {
	var googleLatAndLong = new google.maps.LatLng(coords.latitude, coords.longitude);
	var mapOptions = {
		zoom: 18,
		center: googleLatAndLong,
		mapTypeId: google.maps.MapTypeId.ROADMAP	
	};
	var mapDiv = document.getElementById("map");
	map = new google.maps.Map(mapDiv, mapOptions);
	
	// add marker
	var title = "Your Location";
	var content = "Your are here " + coords.latitude + " , " + coords.longitude;
	addMarker(map, googleLatAndLong, title, content);
}

function addMarker(map, latlong, title, content) {
	var markerOptions = {
		position: latlong, 
		map: map, 
		title: title, 
		clickable: true	
	};
	var marker = new google.maps.Marker(markerOptions);
	
	var infoWindowOptions = {
		content: content,
		position: latlong
	};
	
	var infoWindow = new google.maps.InfoWindow(infoWindowOptions);
	
	google.maps.event.addListener(marker, "click", function() {
		infoWindow.open(map);
	})
};

function scrollMapToPosition(coords) {
	var latitude = coords.latitude;
	var longitude = coords.longitude;

	var latlong = new google.maps.LatLng(latitude, longitude);
	map.panTo(latlong);

	// add the new marker
	addMarker(map, latlong, "Your new location", "You moved to: " + 
								latitude + ", " + longitude);
}
