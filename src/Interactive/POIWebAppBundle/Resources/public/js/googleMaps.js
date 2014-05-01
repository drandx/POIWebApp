//Google Maps Code
var map;
var center = null;
var markersArray = [];
var currentPopup;
var bounds = null;
var Mylat = 4.559997795432589;
var Mylong = -74.52481269836426;
//Global Variables
var myMarker;
var myInfowindow;


/**
 * 
 * @returns {undefined}
 */
function setUpAutoComplete(myCallBack)
{
    var options = {
        types: ['(cities)'],
        componentRestrictions: {country: "co"}};

    var input = document.getElementById('googleAutoComplete');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    addAutocompleteListener(autocomplete, false, myCallBack);
}

/**
 * 
 * @param {type} autocomplete
 * @param {type} showMarker
 * @returns {undefined}
 */
function addAutocompleteListener(autocomplete, showMarker, myCallBack)
{
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29),
        animation: google.maps.Animation.DROP
    });
        
    var infowindow = new google.maps.InfoWindow();

    myMarker = marker;
    myInfowindow = infowindow;

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        clearOverlays();
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


        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }

        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address + '</br>' + place.geometry.location.lat() + ',' + place.geometry.location.lng());
        if (showMarker)
        {
            marker.setVisible(true);
            infowindow.open(map, marker);
        }
        if(myCallBack)  
            myCallBack.execute();
        
        document.getElementById("interactive_poiwebappbundle_pointofinterest_latitude").value = place.geometry.location.lat();
        document.getElementById("interactive_poiwebappbundle_pointofinterest_longitude").value = place.geometry.location.lng();

    });
}

/*
 * 
 * @param {type} lat
 * @param {type} long
 * @returns {undefined}
 */
function initializeSearchMap(point,setMarker)
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


    //Adds the click event to add markers on the map at any click
    google.maps.event.addListener(map, 'click', function(e) {
        clearOverlays();
        placeMarker(e.latLng, map);
        document.getElementById("interactive_poiwebappbundle_pointofinterest_latitude").value = e.latLng.lat();
        document.getElementById("interactive_poiwebappbundle_pointofinterest_longitude").value = e.latLng.lng();
    });

    //Adds changed event to automplete object
    addAutocompleteListener(autocomplete, true, null);

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
    
    if(setMarker){
        placeMarker(point,map);
        map.setZoom(17);
    }
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
        zoom: 7,
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
function addMarker(location, info, pinColor) {
    var marker;
    
    if(pinColor !== null)
    {
        var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_spin&chld=0.75|0|" + pinColor +'|13|b',
        new google.maps.Size(60, 102),
        new google.maps.Point(0,0),
        new google.maps.Point(10, 34)); 
        marker = new google.maps.Marker({position: location, map: map, icon: pinImage}); 
    }
    else
      marker = new google.maps.Marker({position: location, map: map});  

    var popup = new google.maps.InfoWindow({content: info, maxWidth: 600});

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
 * @returns {undefined}
 */
//Removes the overlays from the map, but keeps them in the array
function clearOverlays() {
    //Hides the marker added by automcomplete
    myInfowindow.close();
    myMarker.setVisible(false);
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
        addMarker(pt, info, null);


    });
    center = bounds.getCenter();
}

/**
 * 
 * @returns {undefined}
 */
function getMarkersbyQuery()
{
    //Creates the query as a json object
    
    //gets checked categories
    var catValues = [];
     $('#categoriesContainer :checked').each(function() {
       catValues.push($(this).val());
     });
     
    var Query = new Object();
    Query.cityQuery = document.getElementById("googleAutoComplete").value;
    Query.categories = catValues;
    $('#loader').show();
    $.ajax({
        data: JSON.stringify(Query),
        type: 'POST',
        dataType: 'json',
        url: 'api/pointsQuery',
        contentType: 'application/json',
        success: function(data) {
            clearOverlays();
            $('#loader').hide();
            if(data != null)
                restults_markers_v2(data);
        }
    });
}

/*
 * 
 * @param {type} data
 * @returns {undefined}
 * 
 */
function restults_markers_v2(data) {
    $.each(data, function(i, point) {
        validateEmptyString(point.phone);
        
        var pt = new google.maps.LatLng(point.latitude, point.longitude);
//        var content = '<div><strong>' + point.name + '</strong><br>' + point.address + '</br>' + '<img border="0" align="Left" src="http://bestiariodelbalon.com/wp-content/uploads/Cafam-127x150.jpg">';
        var content = '<div>'+'<strong>' + point.category + '</strong>'+'<br><strong>' + validateEmptyString(point.name) + '</strong></br><strong>' + validateEmptyString(point.address) +'</strong>' 
                +'<br>'+validateEmptyString(point.description) +'</br>'+'<strong>' + 'Teléfono: </strong>'
                + validateEmptyString(point.phone_ext) + ' - ' + validateEmptyString(point.phone) +'<br><strong>' + 'Horario: </strong>'+validateEmptyString(point.schedule)+'</br></div>';
        addMarker(pt, content, point.pincolor);
    });
    
}

/**
 * 
 * @returns {undefined}
 */
function validateEmptyString(field){
 if(field === null)
     return"-";
 else
     return field;
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
        addMarker(pt, info, null);


    });
    center = bounds.getCenter();
}