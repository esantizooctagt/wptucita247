function initMap() {
  var lat="18.2151152";
  var lng="-66.487384";

  $("#coordenadasLat").val(lat);
  $("#coordenadasLng").val(lng);

  var myLatLng = new google.maps.LatLng(lat, lng),
    myOptions = {
      draggable: true,
      zoom: 9,
      center: myLatLng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    },
    map = new google.maps.Map( document.getElementById( 'map-selector' ), myOptions ),
    marker = new google.maps.Marker( {position: myLatLng, map: map} );

  marker.setMap( map );
  map.addListener('click', function(mapsMouseEvent) {
    marker.setPosition( new google.maps.LatLng(mapsMouseEvent.latLng.lat(), mapsMouseEvent.latLng.lng()) );
    $("#coordenadasLat").val(mapsMouseEvent.latLng.lat());
    $("#coordenadasLng").val(mapsMouseEvent.latLng.lng());
  });
}