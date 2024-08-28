function updateClock() {
    const clockElement = document.querySelector('.col-6 .bg-white div span'); // Ganti selector sesuai kebutuhan
    const now = new Date();
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');
    clockElement.textContent = `${hours}:${minutes}:${seconds}`;
}

// Memanggil fungsi updateClock setiap detik
setInterval(updateClock, 1000);

// Panggil langsung agar tidak ada jeda satu detik sebelum jam pertama kali tampil
updateClock();

function updateCalendarDate() {
    // Buat objek Date baru untuk mendapatkan tanggal saat ini
    const today = new Date();

    // Format tanggal menjadi YYYY-MM-DD
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0, jadi tambahkan 1
    const day = String(today.getDate()).padStart(2, '0'); // Tambahkan 0 di depan jika tanggal kurang dari 10

    const formattedDate = `${year}-${month}-${day}`;

    // Setel teks elemen span dengan id "current-date" menjadi tanggal yang diformat
    document.getElementById('current-date').textContent = formattedDate;
}

// Panggil fungsi untuk mengupdate kalender saat halaman dimuat
document.addEventListener('DOMContentLoaded', updateCalendarDate);


