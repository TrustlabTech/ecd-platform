function initMap() {
    var southAfrica = {lat: -28.970902, lng: 24.741211};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 5,
        center: southAfrica
    });

    var centreMarker = '/img/markers/green-dot.png';
    var attendanceMarker = '/img/markers/blue-dot.png';

    $.getJSON('/gmaps', function(data){
        var centres = data.centres;
        var attendance = data.attendance;

        $(centres).each(function(key, value) {
            var latLng = new google.maps.LatLng(value.latitude, value.longitude);
            var currentMarker = addMarker(latLng, map, value.name, centreMarker);

            google.maps.event.addListener(currentMarker , 'click', function(){
                var infoWindow = new google.maps.InfoWindow({
                    content: 'Centre: ' + value.name,
                    position: latLng,
                });
                infoWindow.open(map);
            });
        });

        $(attendance).each(function(key, value) {
            var latLng = new google.maps.LatLng(value.latitude, value.longitude);
            var currentMarker = addMarker(latLng, map, value.class_name, attendanceMarker);

            google.maps.event.addListener(currentMarker , 'click', function(){
                var infoWindow = new google.maps.InfoWindow({
                    content: 'Attendance: ' + value.centre_name + ' - ' + value.class_name,
                    position: latLng,
                });
                infoWindow.open(map);
            });
        });

        var legendIcons = {
            centres: {
                name: 'Centres',
                icon: centreMarker
            },
            attendance: {
                name: 'Attendance',
                icon: attendanceMarker
            }
        };

        var legend = document.getElementById('legend');
        for (var key in legendIcons) {
            var type = legendIcons[key];
            var name = type.name;
            var icon = type.icon;
            var div = document.createElement('div');
            div.innerHTML = '<img src="' + icon + '"> ' + name;
            legend.appendChild(div);
        }

        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);
    });
}

function addMarker(position, map, title, markerColor) {
    var marker = new google.maps.Marker({
        position: position,
        map: map,
        title: title,
        icon: markerColor
    });

    return marker;
}
