function initAutocomplete() {
    var autocomplete = new google.maps.places.Autocomplete(
        (document.getElementById('autocomplete')),
        {types: ['(cities)']});
    autocomplete.addListener('place_changed', function () {
        var place = autocomplete.getPlace();
        if (typeof(place.id) == "undefined") {
            return;
        }
        var data = {
            id: place.id,
            name: place.name,
            latitude: place.geometry.location.lat(),
            longitude: place.geometry.location.lng()
        };
        document.querySelector('#send').addEventListener('click', function () {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", 'city/add', true);
            xhr.setRequestHeader("Content-type", "application/json");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    window.location.href = 'map';
                }
            };
            xhr.send(JSON.stringify(data));
        });
    });
}

function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: new google.maps.LatLng(50.4501, 30.523400000000038),
        zoom: 3
    });
    var infoWindow = new google.maps.InfoWindow;
    getCities('cities', function (data) {
        var xml = data.responseText;
        var markers = JSON.parse(xml);
        Array.prototype.forEach.call(markers, function (markerElem) {
            var name = markerElem.name;
            var point = new google.maps.LatLng(
                parseFloat(markerElem.latitude),
                parseFloat(markerElem.longitude));
            var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');
            strong.textContent = name;
            infowincontent.appendChild(strong);
            var marker = new google.maps.Marker({
                map: map,
                position: point
            });
            marker.addListener('click', function () {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
            });
        });
    });
}

function getCities(url, callback) {
    var request = new XMLHttpRequest;
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            callback(request, request.status);
        }
    };
    request.open('GET', url, true);
    request.send();
}
