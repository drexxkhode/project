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

 
  <script>
    const map = L.map('map').setView([0, 0], 2);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let isTracking = false;
    let watchId = null;
    let currentMarker = null;
    let currentLatLng = null;
    let destinationMarker = null;
    let routeLine = null;

    // Geocoder with custom event handling
    const geocoder = L.Control.geocoder({
      defaultMarkGeocode: false
    })
    .on('markgeocode', function(e) {
      const destinationLatLng = e.geocode.center;

      if (destinationMarker) {
        destinationMarker.setLatLng(destinationLatLng);
      } else {
        destinationMarker = L.marker(destinationLatLng, { title: "Destination" }).addTo(map);
      }

      destinationMarker.bindPopup(e.geocode.name).openPopup();
      map.setView(destinationLatLng, 14);

      drawRoute(currentLatLng, destinationLatLng);
    })
    .addTo(map);

    function toggleTracking() {
      const button = document.getElementById("tracker-btn");

      if (!isTracking) {
        if ('geolocation' in navigator) {
          watchId = navigator.geolocation.watchPosition(position => {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            currentLatLng = [lat, lng];

            if (currentMarker) {
              currentMarker.setLatLng(currentLatLng);
            } else {
              currentMarker = L.marker(currentLatLng).addTo(map).bindPopup("You are here").openPopup();
            }

            map.setView(currentLatLng, 16);

            // Redraw route if destination exists
            if (destinationMarker) {
              drawRoute(currentLatLng, destinationMarker.getLatLng());
            }
          }, error => {
            alert("Location error: " + error.message);
          }, {
            enableHighAccuracy: true,
            maximumAge: 10000,
            timeout: 5000
          });

          isTracking = true;
          button.textContent = "Stop Tracking";
        
        } else {
          alert("Geolocation not supported in this browser.");
        }
      } else {
        navigator.geolocation.clearWatch(watchId);
        watchId = null;
        isTracking = false;
        button.textContent = "Start Tracking";
      }
    }

    function drawRoute(fromLatLng, toLatLng) {
      if (!fromLatLng || !toLatLng) return;

      const latlngs = [fromLatLng, toLatLng];

      if (routeLine) {
        routeLine.setLatLngs(latlngs);
      } else {
        routeLine = L.polyline(latlngs, { color: 'blue', weight: 4 }).addTo(map);
      }
    }
  </script>

