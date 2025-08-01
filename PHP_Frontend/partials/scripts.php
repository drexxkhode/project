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

 <!--Leaflet JS Libraries -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>


<script>
  const map = L.map('map').setView([5.6037, -0.1870], 13); // Ghana center

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  // Company Marker
  const companyLatLng = [5.7037, -0.1680];
  const companyMarker = L.marker(companyLatLng)
    .addTo(map)
    .bindPopup("<b>Nananom Farms Ltd.</b><br>Accra, Ghana")
    .openPopup();

  // Variables
  let userMarker = null, accuracyCircle = null, watchId = null;
  let destinationLatLng = companyLatLng; // Default: Company
  let destinationMarker = null;
  let userLatLng = null;

  let trailCoordinates = []; // path from user to destination
  let trailPolyline = null;

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

        // User marker
        if (!userMarker) {
          userMarker = L.marker(userLatLng).addTo(map).bindPopup("Your Location").openPopup();
        } else {
          userMarker.setLatLng(userLatLng);
        }

        // Accuracy circle
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

        map.setView(userLatLng, 15);

        // Add to trail
        trailCoordinates.push(userLatLng);
        if (!trailPolyline) {
          trailPolyline = L.polyline(trailCoordinates, {
            color: 'green',
            weight: 4
          }).addTo(map);
        } else {
          trailPolyline.setLatLngs([...trailCoordinates, destinationLatLng]);
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
    if (trailPolyline) { map.removeLayer(trailPolyline); trailPolyline = null; }
    if (destinationMarker) { map.removeLayer(destinationMarker); destinationMarker = null; }

    trailCoordinates = [];
    userLatLng = null;
    destinationLatLng = companyLatLng; // Reset to company by default

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

  // Geocoder (Search bar)
  L.Control.geocoder({
    defaultMarkGeocode: false
  })
  .on('markgeocode', function(e) {
    const latlng = e.geocode.center;

    if (destinationMarker) {
      map.removeLayer(destinationMarker);
    }

    destinationLatLng = latlng;

    destinationMarker = L.marker(latlng).addTo(map).bindPopup("Destination").openPopup();
    map.setView(latlng, 15);

    // Reset trail so new trail goes to new destination
    trailCoordinates = [];
    if (trailPolyline) {
      map.removeLayer(trailPolyline);
      trailPolyline = null;
    }

    if (!userLatLng) {
      alert("Start tracking first to draw trail.");
    }
  })
  .addTo(map);
</script>
