 <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
<script> document.getElementById("year").textContent= new Date().getFullYear();</script>

 <!-- JS Libraries -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
  const map = L.map('map').setView([5.6037, -0.1870], 13); // Ghana center

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  // Add your company marker
  const companyLat = 5.6037, companyLng = -0.1870;
  const companyMarker = L.marker([companyLat, companyLng])
    .addTo(map)
    .bindPopup("<b>Nanamon Farms Ltd.</b><br>Accra, Ghana")
    .openPopup();

  // User and route variables
  let userMarker = null, accuracyCircle = null, watchId = null;
  let routingControl = null, destinationMarker = null;
  let userLatLng = null;

  const trackerBtn = document.getElementById("tracker-btn");

  function startTracking() {
    if (!navigator.geolocation) {
      alert("Geolocation not supported.");
      return;
    }

    watchId = navigator.geolocation.watchPosition(
      position => {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;
        const accuracy = position.coords.accuracy;
        userLatLng = [lat, lng];

        if (!userMarker) {
          userMarker = L.marker(userLatLng).addTo(map).bindPopup("Your Location").openPopup();
        } else {
          userMarker.setLatLng(userLatLng);
        }

        if (!accuracyCircle) {
          accuracyCircle = L.circle(userLatLng, {
            radius: accuracy,
            color: 'blue',
            fillColor: '#30f',
            fillOpacity: 0.2
          }).addTo(map);
        } else {
          accuracyCircle.setLatLng(userLatLng);
          accuracyCircle.setRadius(accuracy);
        }

        map.setView(userLatLng, 14);

        // If a destination was selected, recalculate route
        if (destinationMarker && routingControl) {
          routingControl.setWaypoints([L.latLng(userLatLng), destinationMarker.getLatLng()]);
        }
      },
      error => alert("Error: " + error.message),
      {
        enableHighAccuracy: true,
        maximumAge: 1000,
        timeout: 10000
      }
    );

    trackerBtn.textContent = "Stop Tracking";
    trackerBtn.style.backgroundColor = "#dc3545";
  }

  function stopTracking() {
    if (watchId !== null) {
      navigator.geolocation.clearWatch(watchId);
      watchId = null;
    }

    if (userMarker) { map.removeLayer(userMarker); userMarker = null; }
    if (accuracyCircle) { map.removeLayer(accuracyCircle); accuracyCircle = null; }
    if (routingControl) { map.removeControl(routingControl); routingControl = null; }
    if (destinationMarker) { map.removeLayer(destinationMarker); destinationMarker = null; }

    userLatLng = null;
    trackerBtn.textContent = "Start Tracking";
    trackerBtn.style.backgroundColor = "#007bff";
  }

  trackerBtn.addEventListener("click", () => {
    if (watchId === null) {
      startTracking();
    } else {
      stopTracking();
    }
  });

  // Add search bar
  L.Control.geocoder({
    defaultMarkGeocode: false
  })
  .on('markgeocode', function(e) {
    const latlng = e.geocode.center;

    if (destinationMarker) {
      map.removeLayer(destinationMarker);
    }

    destinationMarker = L.marker(latlng).addTo(map).bindPopup("Destination").openPopup();
    map.setView(latlng, 15);

    if (userLatLng) {
      // Show route from user to searched location
      if (routingControl) {
        routingControl.setWaypoints([L.latLng(userLatLng), latlng]);
      } else {
        routingControl = L.Routing.control({
          waypoints: [L.latLng(userLatLng), latlng],
          routeWhileDragging: false,
          addWaypoints: false,
          draggableWaypoints: false,
          createMarker: () => null // prevent auto-marker
        }).addTo(map);
      }
    } else {
      alert("Start tracking first to enable route generation.");
    }
  })
  .addTo(map);
</script>
