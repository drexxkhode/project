const map = L.map('map').setView([7.9465, -1.0232], 7); // Center on Ghana

  // Add OSM tile layer
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  // Add search control
  L.Control.geocoder({
    defaultMarkGeocode: true
  }).addTo(map);

  let userMarker = null;
  let accuracyCircle = null;
  let watchId = null;

  const trackerBtn = document.getElementById("tracker-btn");

  function startTracking() {
    if (!navigator.geolocation) {
      alert("Geolocation not supported");
      return;
    }

    watchId = navigator.geolocation.watchPosition(
      position => {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;
        const accuracy = position.coords.accuracy;

        if (!userMarker) {
          userMarker = L.marker([lat, lng]).addTo(map).bindPopup("You are here").openPopup();
          map.setView([lat, lng], 15);
        } else {
          userMarker.setLatLng([lat, lng]);
        }

        if (!accuracyCircle) {
          accuracyCircle = L.circle([lat, lng], {
            radius: accuracy,
            color: 'blue',
            fillColor: '#30f',
            fillOpacity: 0.2
          }).addTo(map);
        } else {
          accuracyCircle.setLatLng([lat, lng]);
          accuracyCircle.setRadius(accuracy);
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
    trackerBtn.style.backgroundColor = "#dc3545"; // red
  }

  function stopTracking() {
    if (watchId !== null) {
      navigator.geolocation.clearWatch(watchId);
      watchId = null;
    }

    if (userMarker) {
      map.removeLayer(userMarker);
      userMarker = null;
    }

    if (accuracyCircle) {
      map.removeLayer(accuracyCircle);
      accuracyCircle = null;
    }

    trackerBtn.textContent = "Start Tracking";
    trackerBtn.style.backgroundColor = "#007bff"; // blue
  }

  trackerBtn.addEventListener("click", () => {
    if (watchId === null) {
      startTracking();
    } else {
      stopTracking();
    }
  });
