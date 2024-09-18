@extends('layouts.maon')

@section('content')
    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="section" id="user-section" style="position: relative;">
            <div id="user-detail" class="d-flex justify-content-center align-items-center flex-column text-center">
                <div class="avatar mb-2">
                    @if (Auth::user()->foto)
                        <img src="{{ asset('storage/defaultuser/' . Auth::user()->foto) }}" alt="Foto Profil" class="imaged w64 rounded-circle shadow-sm">
                    @else
                        <img src="{{ asset('assets/template2/img/sample/avatar/avatar1.jpg') }}" alt="Foto Profil" class="imaged w64 rounded-circle shadow-sm">
                    @endif
                    {{-- <img src="{{ asset('') }}" alt="avatar" class="imaged w64 rounded-circle shadow-sm"> --}}
                </div>
                <div id="user-info" class="d-flex flex-column align-items-center text-center">
                    <h2 id="user-name" style="font-size: 18px; font-weight: bold; margin-bottom: 0.5rem;">{{ Auth::user()->name }}</h2>
                    <span id="user-role" style="color: #6c757d; font-size: 17px;">siswa</span>
                </div>
            </div>
            <div style="position: absolute; top: 10px; right: 10px;">
                <button id="dropdownButton" style="background: none; border: none; cursor: pointer; display: flex; align-items: center; color: #cacaca;">
                    <ion-icon name="person-circle-outline" role="img" class="md hydrated" aria-label="profile icon" style="font-size: 24px;"></ion-icon>
                    <strong style="margin-left: 5px; font-size: 10px;">{{ Auth::user()->name }}</strong>
                    <ion-icon name="chevron-down-outline" role="img" class="md hydrated" aria-label="chevron down" style="margin-left: 5px; font-size: 15px;"></ion-icon>
                </button>
                <div id="dropdownMenu" style="display: none; position: absolute; right: 0; background: white; border: 1px solid #ccc; border-radius: 4px; box-shadow: 0 8px 16px rgba(0,0,0,0.2); width: 200px; z-index: 1000;">
                    <a href="/profile" class="item" style="display: flex; align-items: center; text-decoration: none; padding: 10px 20px; color: #6c757d;">
                        <ion-icon name="person-outline" role="img" class="md hydrated" aria-label="profile outline" style="font-size: 18px;"></ion-icon>
                        <span style="margin-left: 10px; font-size: 10px;">Profile</span>
                    </a>
                    <a href="{{ route('logout') }}" class="item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="display: flex; align-items: center; text-decoration: none; padding: 10px 20px; color: #dc3545;">
                        <ion-icon name="log-out-outline" role="img" class="md hydrated" aria-label="log out outline" style="font-size: 18px;"></ion-icon>
                        <span style="margin-left: 10px; font-size: 10px;">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

        <div class="section mt-2" id="presence-section">
            <div class="todaypresence">
                <div class="container-fluid mt-2">
                    <div class="row d-flex-row">
                        <!-- Jam -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="d-flex align-items-center p-3 bg-white border rounded shadow-sm">
                                <ion-icon name="time-outline" class="icon-time"></ion-icon>
                                <div>
                                    <h6 class="mb-0">Jam</h6>
                                    <span>10:00</span>
                                </div>
                            </div>
                        </div>

                        <!-- Radius -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="d-flex align-items-center p-3 bg-white border rounded shadow-sm">
                                <ion-icon name="location-outline" class="icon-radius"></ion-icon>
                                <div>
                                    <h6 class="mb-0">Lokasi dan Radius</h6>
                                    <span id="distance">Menghitung...</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kalender -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="d-flex align-items-center p-3 bg-white border rounded shadow-sm">
                                <ion-icon name="calendar-outline" class="icon-calendar"></ion-icon>
                                <div>
                                    <h6 class="mb-0">Kalender</h6>
                                    <span id="current-date">2024-08-06</span>
                                </div>
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="d-flex align-items-center p-3 bg-white border rounded shadow-sm">
                                <ion-icon name="document-text-outline" class="icon-keterangan"></ion-icon>
                                <div>
                                    <h6 class="mb-0">Keterangan</h6>
                                    <span>{{$statusAbsen}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row">
                            <!-- Form Absen Masuk/Pulang -->
                            <div class="col-md-6 col-sm-12 mb-2">
                                <form action="{{ url('/absen') }}" method="POST">
                                    @csrf
                                    <!-- Tentukan jenis absen berdasarkan status absen -->
                                    <input type="hidden" name="jenis_absen" value="{{ $statusAbsen == 'Sudah Absen Masuk' ? 'pulang' : 'masuk' }}">

                                    <!-- Kondisi card warna berdasarkan status absen -->
                                    <div class="card card-hover h-100 text-center {{ $statusAbsen == 'Sudah Absen Masuk' ? ($statusAbsen == 'Sudah Absen Pulang' ? 'gradasigrey' : 'gradasired') : 'gradasigreen' }} shadow-sm">
                                        <div class="card-body d-flex flex-column justify-content-center align-items-center p-3">
                                            <div class="iconpresence mb-2">
                                                <!-- Tombol absen masuk/pulang: disable jika sudah absen pulang atau sedang izin -->
                                                <button type="submit" class="btn btn-link" {{ $statusAbsen == 'Sudah Absen Pulang' || $izin ? 'disabled' : '' }}>
                                                    <ion-icon name="camera" size="large"></ion-icon>
                                                </button>
                                            </div>
                                            <div class="presencedetail">
                                                <!-- Tampilkan status absen (Masuk/Pulang) -->
                                                <h5 class="presencetitle">{{ $statusAbsen == 'Sudah Absen Masuk' ? 'Pulang' : 'Masuk' }}</h5>
                                                <span>{{ $statusAbsen == 'Sudah Absen Masuk' ? $jam_pulang : $jam_masuk }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Form Izin/Sakit -->
                            <div class="col-md-6 col-sm-12 mb-2">
                                <div class="card card-hover h-100 text-center {{ $statusAbsen == 'Sudah Absen Masuk' || $statusAbsen == 'Sudah Absen Pulang' || $izin ? 'gradasigrey' : 'gradasiblue' }} shadow-sm"
                                     data-toggle="modal" data-target="#FormulirModal" data-status="izin"
                                     style="{{ $statusAbsen == 'Sudah Absen Masuk' || $statusAbsen == 'Sudah Absen Pulang' || $izin ? 'pointer-events: none;' : '' }}">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center p-3">
                                        <div class="iconpresence mb-2">
                                            <ion-icon name="paper-plane-outline" size="large"></ion-icon>
                                        </div>
                                        <div class="presencedetail">
                                            <h5 class="presencetitle">Izin/Sakit</h5>
                                            <span>Isi form izin/sakit</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <!-- * App Capsule -->

    <!-- Popup Formulir Izin -->
    <div class="modal fade" id="FormulirModal" tabindex="-1" role="dialog" aria-labelledby="FormulirModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content shadow-lg" style="border-radius: 15px; overflow: hidden;">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title fw-bold d-flex align-items-center" id="FormulirModalLabel">
                        <ion-icon name="document-text-outline" class="mr-2"></ion-icon>
                        <strong>Formulir Keterangan</strong>
                        <small class="ml-2">Izin/Sakit</small>
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('upload-file') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Status Kehadiran</label>
                            <div class="col-md-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="statusSakit" value="sakit" required>
                                    <label class="form-check-label" for="statusSakit">Sakit</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="statusIzin" value="izin" required>
                                    <label class="form-check-label" for="statusIzin">Izin</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label class="col-md-3 col-form-label">Keterangan</label>
                            <div class="col-md-9">
                                <input type="text" id="keterangan" name="keterangan" placeholder="Tuliskan keterangan Anda" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label class="col-md-3 col-form-label">Upload File</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control" name="photo_in" required>
                                <small class="form-text text-muted">Upload surat keterangan atau bukti pendukung.</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="section mt-4" id="attendance-dashboard">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-lg rounded-lg mb-4">
                        <div class="card-header bg-primary text-white text-center">
                            <h3 class="font-weight-bold mb-0">Riwayat Kehadiran Anda <strong>Minggu Ini</strong></h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Absen Masuk</th>
                                            <th>Absen Pulang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($riwayatmingguini as $riwayatM)
                                            <tr>
                                                <td>{{ $riwayatM->date }}</td>
                                                <td>
                                                    @if ($riwayatM->status == 'Hadir')
                                                        <span class="badge badge-success"><i class="fas fa-check-circle"></i> {{ $riwayatM->status }}</span>
                                                    @elseif ($riwayatM->status == 'Terlambat')
                                                        <span class="badge badge-warning"><i class="fas fa-clock"></i> {{ $riwayatM->status }}</span>
                                                    @elseif ($riwayatM->status == 'TAP')
                                                        <span class="badge badge-primary"><i class="fas fa-bell"></i> {{ $riwayatM->status }}</span>
                                                    @elseif ($riwayatM->status == 'Sakit' || $riwayatM->status == 'Izin')
                                                        <span class="badge badge-info"><i class="fas fa-user-md"></i> {{ $riwayatM->status }}</span>
                                                    @elseif ($riwayatM->status == 'Alfa')
                                                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i> {{ $riwayatM->status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $riwayatM->jam_masuk }}</td>
                                                <td>{{ $riwayatM->jam_pulang }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 marginlayout">
                    <div class="card border-0 shadow-lg rounded-lg">
                        <div class="card-header bg-info text-white text-center">
                            <h3 class="font-weight-bold mb-0">Jumlah Kehadiran Anda</h3>
                        </div>
                        <div class="card-body">
                            <div class="nav nav-tabs mb-4" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
                                    <strong>Bulan Ini</strong>
                                </a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
                                    <strong>Bulan Sebelumnya</strong>
                                </a>
                            </div>
                            <div class="tab-content" id="nav-tabContent">
                                <!-- Tab Bulan Ini -->
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="progress mb-3" style="height: 20px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $persentaseHadirBulanIni }}%;" aria-valuenow="{{ $persentaseHadirBulanIni }}" aria-valuemin="0" aria-valuemax="100">
                                           {{ $persentaseHadirBulanIni }}%
                                        </div>
                                    </div>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <i class="fas fa-check-circle text-success"></i> Hadir
                                            <span class="badge badge-success badge-pill">{{ $dataBulanIni['Hadir'] ?? 0 }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <i class="fas fa-user-md text-info"></i> Sakit/Izin
                                            <span class="badge badge-info badge-pill">{{ $dataBulanIni['Sakit/Izin'] ?? 0 }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <i class="fas fa-clock text-warning"></i> Terlambat
                                            <span class="badge badge-warning badge-pill">{{ $dataBulanIni['Terlambat'] ?? 0 }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <i class="fas fa-times-circle text-danger"></i> Alfa
                                            <span class="badge badge-danger badge-pill">{{ $dataBulanIni['Alfa'] ?? 0 }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <i class="fas fa-bell text-primary"></i> TAP
                                            <span class="badge badge-primary badge-pill">{{ $dataBulanIni['TAP'] ?? 0 }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <i class="fas fa-user-clock text-secondary"></i> Total Keterlambatan
                                            <span>{{ $late }} Menit</span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Tab Bulan Sebelumnya -->
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="progress mb-3" style="height: 20px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $persentaseHadirBulanSebelumnya }}%;" aria-valuenow="{{ $persentaseHadirBulanSebelumnya }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ $persentaseHadirBulanSebelumnya }}%
                                        </div>
                                    </div>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <i class="fas fa-check-circle text-success"></i> Hadir
                                            <span class="badge badge-success badge-pill">{{ $dataBulanSebelumnya['Hadir'] ?? 0 }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <i class="fas fa-user-md text-info"></i> Sakit/Izin
                                            <span class="badge badge-info badge-pill">{{ $dataBulanSebelumnya['Sakit/Izin'] ?? 0 }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <i class="fas fa-clock text-warning"></i> Terlambat
                                            <span class="badge badge-warning badge-pill">{{ $dataBulanSebelumnya['Terlambat'] ?? 0 }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <i class="fas fa-times-circle text-danger"></i> Alfa
                                            <span class="badge badge-danger badge-pill">{{ $dataBulanSebelumnya['Alfa'] ?? 0 }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <i class="fas fa-bell text-primary"></i> TAP
                                            <span class="badge badge-primary badge-pill">{{ $dataBulanSebelumnya['TAP'] ?? 0 }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <i class="fas fa-user-clock text-secondary"></i> Total Keterlambatan
                                            <span>{{ $late2 }} Menit</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




</div>
    <!-- * Popup Formulir Sakit -->

    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <a href="index.html" class="item">
            <div class="col">
                <ion-icon name="home-outline" class="icon"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="{{route('rekap')}}" class="item">
            <div class="col">
                <ion-icon name="albums-outline" class="icon"></ion-icon>
                <strong>Rekap</strong>
            </div>
        </a>

    <!-- * App Bottom Menu -->
     <!-- Jquery -->
     <script src="{{asset ('assets/template2/js/lib/jquery-3.4.1.min.js')}}"></script>
     <!-- Bootstrap-->
     <script src="{{asset ('assets/template2/js/lib/popper.min.js')}}"></script>
     <script src="{{asset ('assets/template2/js/lib/bootstrap.min.js')}}"></script>
     <!-- Ionicons -->
     <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
     <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
     <!-- Owl Carousel -->
     <script src="{{asset ('assets/template2/js/plugins/owl-carousel/owl.carousel.min.js')}}"></script>
     <!-- jQuery Circle Progress -->
     <script src="{{asset ('assets/template2/js/plugins/jquery-circle-progress/circle-progress.min.js')}}"></script>
     <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
     <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
     <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
     <!-- Base Js File -->
     <script src="{{asset ('assets/template2/js/base.js')}}"></script>
     <script src="{{asset ('assets/template2/js/timedate.js')}}"></script>
     <script src="{{asset ('assets/template2/js/radiuslok.js')}}"></script>
     <script src="{{asset('assets/template2/js/demo.js')}}"></script>
     <script src="{{asset('assets/template2/js/profile.js')}}"></script>
     <!-- Include Ionicons -->
     <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>

     <script>
         am4core.ready(function () {

             // Themes begin
             am4core.useTheme(am4themes_animated);
             // Themes end

             var chart = am4core.create("chartdiv", am4charts.PieChart3D);
             chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

             chart.legend = new am4charts.Legend();

             chart.data = [
                 {
                     country: "Hadir",
                     litres: 501.9
                 },
                 {
                     country: "Sakit",
                     litres: 301.9
                 },
                 {
                     country: "Izin",
                     litres: 201.1
                 },
                 {
                     country: "Terlambat",
                     litres: 165.8
                 },
             ];



             var series = chart.series.push(new am4charts.PieSeries3D());
             series.dataFields.value = "litres";
             series.dataFields.category = "country";
             series.alignLabels = false;
             series.labels.template.text = "{value.percent.formatNumber('#.0')}%";
             series.labels.template.radius = am4core.percent(-40);
             series.labels.template.fill = am4core.color("white");
             series.colors.list = [
                 am4core.color("#1171ba"),
                 am4core.color("#fca903"),
                 am4core.color("#37db63"),
                 am4core.color("#ba113b"),
             ];
         }); // end am4core.ready()
     </script>
@endsection
