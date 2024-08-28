function calculateDistance(lat1, lon1, lat2, lon2) {
    const R = 6371e3; // Radius bumi dalam meter
    const φ1 = lat1 * Math.PI/180; // φ, λ dalam radian
    const φ2 = lat2 * Math.PI/180;
    const Δφ = (lat2-lat1) * Math.PI/180;
    const Δλ = (lon2-lon1) * Math.PI/180;

    const a = Math.sin(Δφ/2) * Math.sin(Δφ/2) +
              Math.cos(φ1) * Math.cos(φ2) *
              Math.sin(Δλ/2) * Math.sin(Δλ/2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

    const distance = R * c; // Dalam meter
    return distance;
}

function success(position) {
    const userLat = position.coords.latitude;
    const userLon = position.coords.longitude;

    // Lokasi SMKN Negeri 11 Bandung
    const schoolLat = -6.89027; // Latitude SMKN Negeri 11 Bandung
    const schoolLon = 107.55837; // Longitude SMKN Negeri 11 Bandung

    const distance = calculateDistance(schoolLat, schoolLon, userLat, userLon);

    // Tentukan radius dalam meter
    const radius = 500; // 500 meter

    // Cek apakah pengguna berada dalam radius
    if (distance <= radius) {
        document.getElementById('distance').textContent = ` ${Math.round(distance)} m`;
    } else {
        document.getElementById('distance').textContent = ` ${Math.round(distance)} m`;
    }
}

function error() {
    document.getElementById('distance').textContent = 'Tidak dapat mengambil lokasi';
}

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(success, error);
} else {
    document.getElementById('distance').textContent = 'Geolocation tidak didukung';
}
