var actionUrl = "";

/**
 * 
 * @returns {undefined}
 */
function getRoutePointsbyRouteId(id)
{
    var url = actionUrl+'/'+id;
    if (id != -1)
    {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: url,
            success: function (data) {
                if (data != null)
                    route_points_handler(data);
            }
        });

    }

}
/*
 * 
 * 
 */
function route_points_handler(data) {
   /* var newOptions = {"Option 1": "value1",
  "Option 2": "value2",
  "Option 3": "value3"
};

var $el = $("#selectId");
$el.empty(); // remove old options
$.each(newOptions, function(value,key) {
  $el.append($("<option></option>")
     .attr("value", value).text(key));
});*/
    var el = $("#interactive_poiwebappbundle_pointofinterest_near_route_point");
    el.empty();
    el.append($("<option>").attr('value',"").text("Seleccione Punto de Ruta Cercano"));
    $.each(data, function (i, point) {
        el.append($("<option>").attr('value',point.id).text(point.name));
    });
   
}

