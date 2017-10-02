var distance = 0 ;
var dist;
var i;
var response;
var obj = jQuery.parseJSON(response);
var id_ls, last_lat, last_lng;

var lat = '';
var lng = '';
var address = document.getElementByID("tk").value;

var map, g_marker;

geocoder.geocode( { 'address': address}, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
	lat = results[0].geometry.location.lat();
    lng = results[0].geometry.location.lng();
	};
} 
else {
    alert("Geocode was not successful for the following reason: " + status);
	}
});

function getObjects(obj, key, val) {
    var objects = [];
    for (var i in obj) {
        if (!obj.hasOwnProperty(i)) continue;
        if (typeof obj[i] == 'object') {
            objects = objects.concat(getObjects(obj[i], key, val));
        } else if (i == key && obj[key] == val) {
            objects.push(obj);
        }
    }
    return objects;
}

for(i=0; i<Object.keys(obj).length; i++){
	$.each(obj, function(key, value)){
		var x = obj[i].coord_x;
		var y = obj[i].coord_y;

		dist = sqrt(pow((x-lat,2))+pow((y-lng),2));
		
		if(distance == 0){
		 	distance=dist;
		 	last_lat = x;
		 	last_lng = y;
		}
		else if(distance<dist){
			distance = dist;
			id_ls = obj.i.id;
			last_lat = x;
			last_lng = y;
		}
		else continue;		
	}	
}

function p_c_map(){
	var options = {
		center : new google.maps.LatLng(last_lat, last_lng ),
		zoom : 6,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		width:"auto"
	}

	var bounds = new google.maps.LatLngBounds();

	map = new google.maps.Map(document.getElementById("p_c_map"), mapOptions);

	var infowindow = new google.maps.InfoWindow();
	var infowindowcontent ;

	marker = new google.maps.Marker({
		position: new google.maps.LatLng(last_lat, last_lng),
		map: map,
		title: 
		icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png' 
	});
}