@extends('layouts.maon')

@section('content')
    <div class="appHeader bg-secondary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
            </a>
        </div>
        <div class="pageTitle">Absen Masuk</div>
        <div class="right"></div>
        <div style="margin-left: auto; position: relative;">
            <button id="dropdownButton" style="background: none; border: none; cursor: pointer; display: flex; align-items: center; color: #cacaca;">
                <ion-icon name="person-circle-outline" role="img" class="md hydrated" aria-label="profile icon" style="font-size: 24px;"></ion-icon>
                <strong style="margin-left: 5px; font-size: 16px;">{{ Auth::user()->name }}</strong>
                <ion-icon name="chevron-down-outline" role="img" class="md hydrated" aria-label="chevron down" style="margin-left: 5px; font-size: 16px;"></ion-icon>
            </button>
            <div id="dropdownMenu" style="display: none; position: absolute; right: 0; background: white; border: 1px solid #ccc; border-radius: 4px; box-shadow: 0 8px 16px rgba(0,0,0,0.2); width: 200px;">
                <a href="/profile" class="item" style="display: flex; align-items: center; text-decoration: none; padding: 10px 20px; color: #6c757d;">
                    <ion-icon name="person-outline" role="img" class="md hydrated" aria-label="profile outline" style="font-size: 18px;"></ion-icon>
                    <span style="margin-left: 10px; font-size: 16px;">Profile</span>
                </a>
                <a href="{{ route('logout') }}" class="item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="display: flex; align-items: center; text-decoration: none; padding: 10px 20px; color: #dc3545;">
                    <ion-icon name="log-out-outline" role="img" class="md hydrated" aria-label="log out outline" style="font-size: 18px;"></ion-icon>
                    <span style="margin-left: 10px; font-size: 16px;">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
          <div class="col-md-4 col-lg-7 mb-2">
            <p class="mb-1 text-center">Tampilan Kamera / Hasil</p>
            <div class="ambilfotowrapper">
              <div class="webcam-container">
                <div class="webcam-capture" id="webcamCapture"></div>
                <img id="result" class="foto">
                <canvas id="faceCanvas" style="position: absolute; top: 0; left: 0;"></canvas>
              </div>
            </div>
            <div class="d-flex justify-content-center mt-2">
              <button class="buttonfoto bg-info col-md-4 col-lg-4 mx-1" id="takeSnapshot">
                <div class="button-content">
                  <ion-icon name="camera-outline"></ion-icon>
                  <h2>Ambil Gambar</h2>
                </div>
              </button>
              <button class="buttonfoto bg-info col-md-4 col-lg-4 mx-1" id="resetCamera">
                <div class="button-content">
                  <ion-icon name="refresh-outline"></ion-icon>
                  <h2>Ambil Ulang Gambar</h2>
                </div>
              </button>
            </div>
          </div>
          <div class="col-md-6 col-lg-5 mb-2">
            <div class="d-flex justify-content-center align-items-center">
              <div id="map" style="height: 400px; width: 100%;"></div>
            </div>
            <p><i>*Pastikan kamu berada di dalam radius yang diizinkan (< {{ $koordinat_sekolah->radius }}M)</i></p>
            <form action="{{ route('ambil-absen') }}" method="POST">
              @csrf
              <div class="d-flex justify-content-between align-items-center mt-2">
                <input type="hidden" id="faceConfidence" name="faceConfidence">
                <input id="lokasi" name="lokasi" type="hidden">
                <input id="image" name="image" type="hidden">
                <button id="ambilabsen" class="buttonfoto bg-success col-md-10 col-lg-12">
                  <div class="button-content">
                    <ion-icon name="cloud-upload-outline"></ion-icon>
                    <h2>Submit Bukti Absen</h2>
                  </div>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

    <!-- Tampilkan pesan error atau sukses -->
    @if (session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <a href="/siswa" class="item">
            <div class="col">
                <ion-icon name="home-outline" class="icon"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="#" class="item">
            <div class="col">
                <ion-icon name="albums-outline" class="icon"></ion-icon>
                <strong>Riwayat</strong>
            </div>
        </a>

    <!-- Jquery -->
    <script src="{{ asset('assets/template2/js/lib/jquery-3.4.1.min.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/template2/js/lib/popper.min.js') }}"></script>
    <script src="{{ asset('assets/template2/js/lib/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/template2/js/peta.js') }}"></script>
    <script src="{{ asset('assets/template2/js/profile.js') }}"></script>
    {{-- <script src="{{ asset('assets/template2/js/faceDTC_and_coordinat.js')}}"></script> --}}

    <!-- Custom Script -->

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <script src="{{ asset('assets/template2/js/faceDTC_and_coordinat.js') }}"></script>
@endsection


@push('myscript')
    <script>
        // lokasi
        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }

        function successCallback(position) {
            lokasi.value = position.coords.latitude + ", " + position.coords.longitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 15);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            // Custom icon for user
            var userIcon = L.icon({
                iconUrl: '{{ asset('assets/template2/img/icon/markersiswa.png') }}',
                iconSize: [45, 45], // size of the icon
                iconAnchor: [19, 38], // point of the icon which will correspond to marker's location
                popupAnchor: [0, -38] // point from which the popup should open relative to the iconAnchor
            });

            // Custom icon for school
            var schoolIcon = L.icon({
                iconUrl: '{{ asset('assets/template2/img/icon/markerschool.png') }}',
                iconSize: [45, 45], // size of the icon
                iconAnchor: [19, 38], // point of the icon which will correspond to marker's location
                popupAnchor: [0, -38] // point from which the popup should open relative to the iconAnchor
            });

            var markerUser = L.marker([position.coords.latitude, position.coords.longitude], {
                icon: userIcon
            }).addTo(map);
            var markerSchool = L.marker([{{ $koordinat_sekolah->titik_koordinat }}], {
                icon: schoolIcon
            }).addTo(map);
            var circle = L.circle([{{ $koordinat_sekolah->titik_koordinat }}], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: {{ $koordinat_sekolah->radius }}
            }).addTo(map);
        }

        function errorCallback(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    lokasi.innerHTML = "Izin untuk mendapatkan lokasi tidak diberikan oleh pengguna.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    lokasi.innerHTML = "Informasi lokasi tidak tersedia.";
                    break;
                case error.TIMEOUT:
                    lokasi.innerHTML = "Waktu permintaan lokasi habis.";
                    break;
                case error.UNKNOWN_ERROR:
                    lokasi.innerHTML = "Terjadi kesalahan yang tidak diketahui.";
                    break;
            }
        }
    </script>
@endpush
