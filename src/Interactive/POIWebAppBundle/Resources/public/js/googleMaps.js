//Google Maps Code
var map;
var center = null;
var categoryMarkeryLayer = [];
var pozosMarkeryLayer = [];

var waypts = [];
var currentPopup;
var bounds = null;
var Mylat = 4.559997795432589;
var Mylong = -74.52481269836426;
var myMarker;
var myInfowindow;
var PozosProduccionId = 17;

//Google routes properties
var destinationPoint;
var originPoint;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();

//Google adjacent routes
var adjacentDirectionsDisplay = [];

//Pozos de Produccion
var pozosDeProduccionbyRoute = [];


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

    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        clearOverlays(categoryMarkeryLayer);
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
        if (myCallBack)
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
function initializeSearchMap(point, setMarker)
{
    var mapOptions = {
        center: new google.maps.LatLng(Mylat, Mylong),
        zoom: 7
    };

    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    var input = /** @type {HTMLInputElement} */(
            document.getElementById('pac-input'));

    var types = document.getElementById('type-selector');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);


    //Adds the click event to add markers on the map at any click
    google.maps.event.addListener(map, 'click', function (e) {
        clearOverlays(categoryMarkeryLayer);
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
        google.maps.event.addDomListener(radioButton, 'click', function () {
            autocomplete.setTypes(types);
        });
    }

    setupClickListener('changetype-all', []);
    setupClickListener('changetype-establishment', ['establishment']);
    setupClickListener('changetype-geocode', ['geocode']);

    if (setMarker) {
        placeMarker(point, map);
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
    categoryMarkeryLayer.push(marker);
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
    directionsDisplay = new google.maps.DirectionsRenderer();
    var mapOptions = {
        zoom: 7,
        center: new google.maps.LatLng(Mylat, Mylong)
    };
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    directionsDisplay.setMap(map);
}

/*
 * 
 * @param {type} location
 * @param {type} info
 * @returns {undefined}
 */
function addMarker(location, info, pinColor, markerLayer) {
    var marker;

    if (pinColor !== null)
    {
        var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_spin&chld=0.75|0|" + pinColor + '|13|b',
                new google.maps.Size(60, 102),
                new google.maps.Point(0, 0),
                new google.maps.Point(10, 34));
        marker = new google.maps.Marker({position: location, map: map, icon: pinImage});
    }
    else
        marker = new google.maps.Marker({position: location, map: map});

    var popup = new google.maps.InfoWindow({content: info, maxWidth: 600});

    google.maps.event.addListener(marker, "click", function () {
        if (currentPopup != null) {
            currentPopup.close();
            currentPopup = null;
        }
        popup.open(map, this);
        currentPopup = popup;
    });
    //google.maps.event.addListener(popup, "closeclick", function() {map.panTo(center);currentPopup = null;});

    markerLayer.push(marker);
}

/*
 * 
 * @returns {undefined}
 */
//Removes the overlays from the map, but keeps them in the array
function clearOverlays(arrayLayer) {
    //Hides the marker added by automcomplete
    myInfowindow.close();
    myMarker.setVisible(false);
    if (arrayLayer) {
        for (i in arrayLayer) {
            //marker.infowindow.close();
            arrayLayer[i].setMap(null);
        }
    }
}

/**
 * 
 * @returns {undefined}
 */
function getMarkersbyQuery()
{
    //Creates the query as a json object
    var selectedRoute = $('#routesSelect').val();
    //gets checked categories
    var catValues = [];
    $('#categoriesContainer :checked').each(function () {
        catValues.push($(this).val());
    });
    var Query = new Object();
    Query.cityQuery = document.getElementById("googleAutoComplete").value;
    Query.categories = catValues;
    Query.route = selectedRoute;
    $('#loader').show();
    $.ajax({
        data: JSON.stringify(Query),
        type: 'POST',
        dataType: 'json',
        url: 'api/pointsQuery',
        contentType: 'application/json',
        success: function (data) {
            clearOverlays(categoryMarkeryLayer);
            $('#loader').hide();
            if (data != null){
                restults_markers_v2(data);
            }
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
    $.each(data, function (i, point) {
        validateEmptyString(point.phone);

        var pt = new google.maps.LatLng(point.latitude, point.longitude);
//        var content = '<div><strong>' + point.name + '</strong><br>' + point.address + '</br>' + '<img border="0" align="Left" src="http://bestiariodelbalon.com/wp-content/uploads/Cafam-127x150.jpg">';
        var content = '<div>' + '<strong>' + point.category + '</strong>' + '<br><strong>' + point.name + '</strong></br>' +'<br>' + validateEmptyString(point.description) + '</br>' + '<br> <img src="'+point.img_path+'" style="height: 150px; width: 150px; margin-bottom: 20px"> </br>' +'</div>';
        addMarker(pt, content, point.pincolor, categoryMarkeryLayer);
    });

}

/**
 * 
 * @returns {undefined}
 */
function validateEmptyString(field) {
    if (field === null)
        return"-";
    else
        return field;
}


/**
 * 
 * @returns {undefined}
 */
function getRoutesbyQuery()
{
    var selectedRote = $('#routesSelect').val();
    if (selectedRote != -1)
    {
        $('#loader').show();
        $.ajax({
            type: 'GET',
            dataType: 'json',
            //TODO - Get real selected route
            url: 'api/routePoints/' + selectedRote,
            success: function (data) {
                $('#loader').hide();
                if (data != null)
                    route_markers(data);
            }
        });

    }

}


/*
 * 
 * @param {type} data
 * @returns {undefined}
 * 
 */
function route_markers(data) {
    waypts = [];
    $.each(data, function (i, point) {
        validateEmptyString(point.phone);
        var pt = new google.maps.LatLng(point.latitude, point.longitude);
        if ((point.IsOrigin != null) && (point.IsOrigin == 1))
            originPoint = pt;
        else if ((point.IsDestination != null) && (point.IsDestination == 1))
            destinationPoint = pt;
        else
        {
            waypts.push({
                location: pt,
                stopover: true});
        }
    });
    route_calculations();
}


/**
 * 
 * @returns {undefined}
 */
function getPozosdeProduccionbyQuery()
{
    //Creates the query as a json object
    var selectedRoute = $('#routesSelect').val();
    
    //Queryies only for Pozos de Producción.
    var catValues = [];
    catValues.push(PozosProduccionId);
    
    var Query = new Object();
    Query.cityQuery = document.getElementById("googleAutoComplete").value;
    Query.categories = catValues;
    Query.route = selectedRoute;
    $('#loader').show();
    $.ajax({
        data: JSON.stringify(Query),
        type: 'POST',
        dataType: 'json',
        url: 'api/pointsQuery',
        contentType: 'application/json',
        success: function (data) {
            clear_adjacent_routes();
            clearOverlays(pozosMarkeryLayer);
            $('#loader').hide();
            if (data != null){
                populatePozosProduccionBox(data);
            }
        }
    });
}

function populatePozosProduccionBox(data)
{
    var container = document.getElementById("pozosProduccionContainer");
    pozosDeProduccionbyRoute = [];
    container.innerHTML = '';

    $.each(data, function (i, point) {
        validateEmptyString(point.phone);
        pozosDeProduccionbyRoute.push(point);

        var divElement = document.createElement('div');
        divElement.className = "checkbox form-inline";
        
        var checkbox = document.createElement('input');
        checkbox.type = "checkbox";
        checkbox.name = point.name;
        checkbox.value = point.id;
        checkbox.id = point.id;

        var label = document.createElement('label');
        label.htmlFor = point.id;
        label.appendChild(document.createTextNode(point.name));

        divElement.appendChild(checkbox);
        divElement.appendChild(label);
        
        container.appendChild(divElement);
        
        
    });
    
}

/**
 * 
 * 
 */
function drawPozosdeProduccion()
{
    var pozosValues = [];
    
    $('#pozosProduccionContainer :checked').each(function () {
        pozosValues.push($(this).val());
    });
    for (var i = 0; i < pozosValues.length; i++) 
    {
        for (var j = 0; j < pozosDeProduccionbyRoute.length; j++) 
        {
            var point = pozosDeProduccionbyRoute[j];

            if(point.id == pozosValues[i])
            {
                var pt = new google.maps.LatLng(point.latitude, point.longitude);
                var content = '<div>' + '<strong>' + point.category + '</strong>' + '<br><strong>' + point.name + '</strong></br>' + '<br>' + validateEmptyString(point.description) + '</br>' + '<br> <img src="' + point.img_path + '" style="height: 150px; width: 150px; margin-bottom: 20px"> </br>' + '</div>';
                addMarker(pt, content, point.pincolor, pozosMarkeryLayer);
                near_points_route_calculations(point.rp_latitude,point.rp_longitude,point.latitude, point.longitude);
                
                break;
            }
        }
    }
}


/**
 * 
 * 
 */
function route_calculations() {
    //var start = document.getElementById('start').value;
    //var end = document.getElementById('end').value;
    //var waypts = [];
    //var checkboxArray = document.getElementById('waypoints');
    var originPosition = new google.maps.LatLng('41.962394', '-87.675923');
    var destinationPosition = new google.maps.LatLng('41.878368', '-87.625311');



    var request = {
        origin: originPoint,
        destination: destinationPoint,
        waypoints: waypts,
        optimizeWaypoints: true,
        travelMode: google.maps.TravelMode.DRIVING
    };

    directionsService.route(request, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
            var summaryPanel = document.getElementById('directions_panel');
            summaryPanel.innerHTML = '';
            var totalDistance = 0;
            var totalDuration = 0;            
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
                var segmentInitPoint = String.fromCharCode(97 + i);
                var segmentEndPoint = String.fromCharCode(97 + (i +1));
                
                summaryPanel.innerHTML += '<b>Segmento : ' + segmentInitPoint.toUpperCase() + ' - ' + segmentEndPoint.toUpperCase() + '</b><br>';
                summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
                summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
                summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
                totalDistance += route.legs[i].distance.value;
                totalDuration += route.legs[i].duration.value;
            }
            totalDistance = totalDistance/1000;
            summaryPanel.innerHTML += '<b>Distacia Total : ' + totalDistance.toFixed(1) + ' Km</b><br>';
            //summaryPanel.innerHTML += '<b>Duración Total : ' + totalDuration + '</b><br>';
        }
    });
}


/**
 * 
 * 
 */
function near_points_route_calculations(initLat, initLng, finishLat, finishLng) {
    var directions = new google.maps.DirectionsRenderer();
    adjacentDirectionsDisplay.push(directions);
    
    directions.setMap(map);
    
    //Google routes properties
    var rendererOptions = {suppressMarkers : true, preserveViewport : true, polylineOptions : {strokeColor:"#DEB887",strokeWeight:8}};
    directions.setOptions(rendererOptions);
    
    
    var originPosition = new google.maps.LatLng(initLat, initLng);
    var destinationPosition = new google.maps.LatLng(finishLat, finishLng);

    var request = {
        origin: originPosition,
        destination: destinationPosition,
        optimizeWaypoints: true,
        travelMode: google.maps.TravelMode.DRIVING
    };

    directionsService.route(request, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directions.setDirections(response);
        }
    });
   
}


function clear_adjacent_routes()
{
    //adjacentDirectionsDisplay = [];
    for (i = 0; i < adjacentDirectionsDisplay.length; i++) 
    { 
        var routeDirection = adjacentDirectionsDisplay[i];
        routeDirection.setMap(null);
    }
    adjacentDirectionsDisplay = [];
}