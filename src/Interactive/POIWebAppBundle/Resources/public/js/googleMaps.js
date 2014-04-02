//Google Maps Code
var map;
var center = null;
var markersArray = [];
var currentPopup;
var bounds = null;
var Mylat = 4.559997795432589;
var Mylong = -74.52481269836426;

/*
 * 
 * @param {type} lat
 * @param {type} long
 * @returns {undefined}
 */
function initializeSearchMap()
{
    var mapOptions = {
        center: new google.maps.LatLng(Mylat, Mylong),
        zoom: 7
    };
    map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);

    var input = /** @type {HTMLInputElement} */(
            document.getElementById('pac-input'));

    var types = document.getElementById('type-selector');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    google.maps.event.addListener(map, 'click', function(e) {
        clearOverlays();
        placeMarker(e.latLng, map);
        document.getElementById("interactive_poiwebappbundle_pointofinterest_latitude").value = e.latLng.lat();
        document.getElementById("interactive_poiwebappbundle_pointofinterest_longitude").value = e.latLng.lng();
    });

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
        }
        marker.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }

        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address + '</br>' + place.geometry.location.lat() + ',' + place.geometry.location.lng());
        infowindow.open(map, marker);

        document.getElementById("interactive_poiwebappbundle_pointofinterest_latitude").value = place.geometry.location.lat();
        document.getElementById("interactive_poiwebappbundle_pointofinterest_longitude").value = place.geometry.location.lng();

    });
    // Sets a listener on a radio button to change the filter type on Places
    // Autocomplete.
    function setupClickListener(id, types) {
        var radioButton = document.getElementById(id);
        google.maps.event.addDomListener(radioButton, 'click', function() {
            autocomplete.setTypes(types);
        });
    }

    setupClickListener('changetype-all', []);
    setupClickListener('changetype-establishment', ['establishment']);
    setupClickListener('changetype-geocode', ['geocode']);
}

/**
 * 
 * @param {type} position
 * @param {type} map
 * @returns {undefined}
 */
function placeMarker(position, map) {
    var marker = new google.maps.Marker({position: position, map: map});
    map.panTo(position);
    markersArray.push(marker);
}

/*
 * 
 * @param {type} lat
 * @param {type} long
 * @returns {undefined}
 */
function initializePoisMap()
{
    /*var latlng = new google.maps.LatLng(Mylat,Mylong);
     var myOptions = {
     zoom: 11,
     center: latlng,
     mapTypeId: google.maps.MapTypeId.ROADMAP
     };
     map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
     bounds = new google.maps.LatLngBounds();*/
    var mapOptions = {
        zoom: 10,
        center: new google.maps.LatLng(Mylat, Mylong)
    };
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}

/*
 * 
 * @param {type} location
 * @param {type} info
 * @returns {undefined}
 */
function addMarker(location, info) {
    marker = new google.maps.Marker({position: location, map: map});

    var popup = new google.maps.InfoWindow({content: info, maxWidth: 300});

    google.maps.event.addListener(marker, "click", function() {
        if (currentPopup != null) {
            currentPopup.close();
            currentPopup = null;
        }
        popup.open(map, this);
        currentPopup = popup;
    });
    //google.maps.event.addListener(popup, "closeclick", function() {map.panTo(center);currentPopup = null;});

    markersArray.push(marker);
}

/*
 * 
 * @param {type} marker
 * @returns {undefined}
 */
function addMarkerExisting(marker) {
    markersArray.push(marker);

}

/*
 * 
 * @returns {undefined}
 */
//Removes the overlays from the map, but keeps them in the array
function clearOverlays() {
    if (markersArray) {
        for (i in markersArray) {
            //marker.infowindow.close();
            markersArray[i].setMap(null);
        }
    }
}


/*
 * 
 * @param {type} idRoute
 * @returns {undefined}
 */
//Setea los marcadores, limpiando el mapa y llamando la funcion de ajax
function setMarkers(idRoute) {
    clearOverlays();
    getMarkersbyRuta(idRoute);
}


/*
 * 
 * @param {type} idRuta
 * @returns {undefined}
 */
//AJAX Code
//Init Geo Points
function getMarkersbyRuta(idRuta) {
    $.ajax({
        data: "idroute=" + idRuta,
        type: "GET",
        dataType: "json",
        url: "includes/get_markers.php",
        success: function(data) {
            restults_markers(data);
        }
    });
}

/*
 * 
 * @param {type} data
 * @returns {undefined}
 * 
 */
function restults_markers(data) {
    if (data['alert']) {
        alert('Se ha enviado una señal de alerta, lat: ' + data['alert'].lat + ', lng: ' + data['alert'].lng + ', fecha y hora: ' + data['alert'].alertTime);
    }

    $.each(data, function(index, value) {

        var lat = data[index].tGeoLat;
        var lng = data[index].tGeoLng;
        var fecha = data[index].dFechaRegistro;
        var idruta = data[index].tIDRoute;

        var activo = "";

        if (data[index].bActivo == 0)
            activo = "Ruta inactiva";
        else
            activo = "Ruta activa";


        var info = "<br>Fecha: " + fecha + " - " + activo + "</br>";



        if (index == 0)
        {
            initialize(lat, lng);
        }

        var pt = new google.maps.LatLng(lat, lng);
        bounds.extend(pt);
        addMarker(pt, info);


    });
    center = bounds.getCenter();
}

/*
 * 
 * @param {type} data
 * @returns {undefined}
 * 
 */
function restults_markers_v2(data) {
    $.each(data.pois, function(i, point) {
        //alert(point.id);
        //alert(point.latitude);
        //alert(point.longitude);
        var pt = new google.maps.LatLng(point.latitude, point.longitude);
        addMarker(pt, point.description);
    });
}

/*
 * 
 * @returns {undefined}
 */
//Update Geo Points
function updateMarkers() {
    var idRoute = document.getElementById("idruta").value;
    clearOverlays();
    getMarkersbyRutaUpdate(idRoute);
}

/*
 * 
 * @param {type} idRuta
 * @returns {undefined}
 * 
 */
function getMarkersbyRutaUpdate(idRuta) {
    $.ajax({
        data: "idroute=" + idRuta,
        type: "GET",
        dataType: "json",
        url: "includes/get_markers.php",
        success: function(data) {
            restults_markersUpdate(data);
        }
    });
}
/**
 * 
 * @param {type} data
 * @returns {undefined}
 */
function restults_markersUpdate(data) {

    if (data != null) {
        if (data[0].bActivo == 0) {
            alert("El usuario ha finalizado la ruta");
            clearInterval(idInterval);

            var cmb = document.getElementById("rutas");
            cmb.options[cmb.selectedIndex].text = " -- Ruta Inactiva -- ";

            var val = cmb.options[cmb.selectedIndex].value;
            var valor_array = val.split("_");

            var newstring = valor_array[0] + "_" + valor_array[1] + "_" + valor_array[2] + "_0";
            cmb.options[cmb.selectedIndex].value = newstring;


        }
    }

    $.each(data, function(index, value) {

        var lat = data[index].tGeoLat;
        var lng = data[index].tGeoLng;
        var fecha = data[index].dFechaRegistro;
        var idruta = data[index].tIDRoute;
        var activo = "";

        if (data[index].bActivo == 0) {
            activo = "Ruta inactiva";
        }
        else
            activo = "Ruta activa";


        var info = "<br>Fecha: " + fecha + " - " + activo + "</br>";

        var pt = new google.maps.LatLng(lat, lng);
        bounds.extend(pt);
        addMarker(pt, info);


    });
    center = bounds.getCenter();
}