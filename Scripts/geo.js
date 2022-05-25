var posspeed;
var outSpeed
var view = new ol.View({
  center: [0, 0],
  zoom: 2,
});

var map = new ol.Map({
  target: 'map',
        layers: [
          new ol.layer.Tile({
            source: new ol.source.OSM()
          }) ],
  target: 'map',
  view: view,
});

var geolocation = new ol.Geolocation({
  // enableHighAccuracy must be set to true to have the heading value.
  projection:map.getView().getProjection(),
  trackingOptions: {
    enableHighAccuracy: true,
    maximumAge: 2000
  },
  projection: view.getProjection(),
});

function el(id) {
  return document.getElementById(id);
}

// el('track').addEventListener('change', function () {
//   geolocation.setTracking(this.checked);
// });


// update the HTML page when the position changes.
geolocation.on('change', function () {
  // el('accuracy').innerText = geolocation.getAccuracy() + ' [m]';
  // el('altitude').innerText = geolocation.getAltitude() + ' [m]';
  // el('altitudeAccuracy').innerText = geolocation.getAltitudeAccuracy() + ' [m]';
  // el('heading').innerText = geolocation.getHeading() + ' [rad]';
  // el('speed').innerText = geolocation.getSpeed() + ' [m/s]';
      document.getElementById('speed').innerHTML=(Math.round(geolocation.getSpeed()*10)/10)*3.6;
      outSpeed=(geolocation.getSpeed())*3.6;
  // el('coords').innerText = geolocation.getPosition();

});

// handle geolocation error.
geolocation.on('error', function (error) {
  var info = document.getElementById('info');
  info.innerHTML = error.message;
  info.style.display = '';
});

var accuracyFeature = new ol.Feature();
geolocation.on('change:accuracyGeometry', function () {
  accuracyFeature.setGeometry(geolocation.getAccuracyGeometry());
});

var iconStyle = new ol.style.Style({
  image: new ol.style.Circle({
    radius: 6,
      fill: new ol.style.Fill({
        color: '#3399CC',
      }),
      stroke: new ol.style.Stroke({
        color: '#fff',
        width: 2,
      }),
     })
    });

// add an empty iconFeature to the source of the layer
var iconFeature = new ol.Feature();   
var iconSource = new ol.source.Vector({
  features: [iconFeature]
});    
var iconLayer = new ol.layer.Vector({
  source: iconSource,
  style : iconStyle
});    
map.addLayer(iconLayer); 

geolocation.on('change', function() {
  var pos = geolocation.getPosition();
  iconFeature.setGeometry(new ol.geom.Point(pos));
  view.setCenter(pos);
  view.setZoom(18); 
});