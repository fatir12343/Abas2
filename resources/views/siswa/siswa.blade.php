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
                    <img src="{{ asset('assets/template2/img/sample/avatar/avatar1.jpg') }}" alt="avatar" class="imaged w64 rounded-circle shadow-sm">
                </div>
                <div id="user-info" class="d-flex flex-column align-items-center text-center">
                    <h2 id="user-name" style="font-size: 18px; font-weight: bold; margin-bottom: 0.5rem;">{{ Auth::user()->name }}</h2>
                    <span id="user-role" style="color: #6c757d; font-size: 15px;">siswa</span>
                </div>
            </div>
            <div style="position: absolute; top: 10px; right: 10px;">
                <button id="dropdownButton" style="background: none; border: none; cursor: pointer; display: flex; align-items: center; color: #cacaca;">
                    <ion-icon name="person-circle-outline" role="img" class="md hydrated" aria-label="profile icon" style="font-size: 24px;"></ion-icon>
                    <strong style="margin-left: 5px; font-size: 16px;">{{ Auth::user()->name }}</strong>
                    <ion-icon name="chevron-down-outline" role="img" class="md hydrated" aria-label="chevron down" style="margin-left: 5px; font-size: 16px;"></ion-icon>
                </button>
                <div id="dropdownMenu" style="display: none; position: absolute; right: 0; background: white; border: 1px solid #ccc; border-radius: 4px; box-shadow: 0 8px 16px rgba(0,0,0,0.2); width: 200px; z-index: 1000;">
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
    </div>

        <div class="section mt-2" id="presence-section">
            <div class="todaypresence">
                <div class="container mt-2">
                    <div class="row d-flex-row">
                        <!-- Jam -->
                        <div class="col-6 col-md-3 mb-3">
                            <div class="d-flex align-items-center p-3 bg-white border rounded shadow-sm">
                                <ion-icon name="time-outline" style="font-size: 24px;"></ion-icon>
                                <div>
                                    <h6 class="mb-0">Jam</h6>
                                    <span>10:00</span>
                                </div>
                            </div>
                        </div>

                        <!-- Radius -->
                        <div class="col-6 col-md-3 mb-3">
                            <div class="d-flex align-items-center p-3 bg-white border rounded shadow-sm">
                                <ion-icon name="location-outline" class="icon-radius"></ion-icon>
                                <div>
                                    <h6 class="mb-0">Lokasi dan Radius</h6>
                                    <span id="distance">Menghitung...</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kalender -->
                        <div class="col-6 col-md-3 mb-3">
                            <div class="d-flex align-items-center p-3 bg-white border rounded shadow-sm">
                                <ion-icon name="calendar-outline" class="icon-calendar"></ion-icon>
                                <div>
                                    <h6 class="mb-0">Kalender</h6>
                                    <span id="current-date">2024-08-06</span>
                                </div>
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div class="col-6 col-md-3 mb-3">
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


                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 mb-1">
                                <div class="card gradasigreen">
                                    <div class="card-body">
                                        <div class="presencecontent">
                                            <div class="iconpresence">
                                                @if ($statusAbsen == 'Sudah Absen Masuk')
                                                    <ion-icon name="camera"></ion-icon>
                                                @else
                                                    <a href="{{ url('/absen') }}" class="href">
                                                        <ion-icon name="camera"></ion-icon>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="presencedetail">
                                                <h4 class="presencetitle">Masuk</h4>
                                                <span>{{ $jam_masuk }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mb-1">
                                <div class="card gradasired {{ $statusAbsen != 'Sudah Absen Pulang' ? 'disabled' : '' }}">
                                    <div class="card-body">
                                        <div class="presencecontent">
                                            <div class="iconpresence">
                                                @if ($statusAbsen != 'Sudah Absen Pulang')
                                                    <ion-icon name="camera" style="color: #ccc;"></ion-icon>
                                                @else
                                                    <a href="{{ url('/absen') }}" class="href">
                                                        <ion-icon name="camera"></ion-icon>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="presencedetail">
                                                <h4 class="presencetitle">Pulang</h4>
                                                <span>{{ $jam_pulang }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 mb-1">
                        <div class="card gradasiblue" data-toggle="modal" data-target="#FormulirModal" data-status="izin">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        <ion-icon name="paper-plane-outline"></ion-icon>
                                    </div>
                                    <div class="presencedetail">
                                        <h4 class="presencetitle">Izin</h4>
                                        <span>Isi form izin</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 mb-1">
                        <div class="card gradasipurple" data-toggle="modal" data-target="#FormulirModal" data-status="sakit">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        <ion-icon name="medkit-outline"></ion-icon>
                                    </div>
                                    <div class="presencedetail">
                                        <h4 class="presencetitle">Sakit</h4>
                                        <span>Isi form sakit</span>
                                    </div>
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
                                <input type="file" class="form-control" name="photo_file" required>
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
    <!-- * Popup Formulir Sakit -->

    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <a href="index.html" class="item">
            <div class="col">
                <ion-icon name="home-outline" class="icon"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="#" class="item">
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
