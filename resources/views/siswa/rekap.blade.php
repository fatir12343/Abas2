@extends('layouts.maon')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="appHeader bg-secondary text-light" style="width: 100%;">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
            </a>
        </div>
        <div class="pageTitle text-center">Rekap Absensi</div>
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

    <section class="statisticrekap p-t-40">
        <div class="container">
            <!-- Filter Section -->
            <div class="filter-section mb-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('rekap') }}" method="GET" class="d-flex justify-content-between">
                            <div class="form-group">
                                <label for="from-date">From</label>
                                <input type="date" id="from-date" name="start_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="to-date">To</label>
                                <input type="date" id="to-date" name="end_date" class="form-control">
                            </div>
                            <div class="form-group align-self-end">
                                <button class="btn btn-primary" type="submit">
                                    <i class="zmdi zmdi-search"></i> Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    
            <!-- Statistik dan Tabel Rekap -->
            <div class="row">
                <!-- Tabel Absensi -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center mb-4">Rekap Kehadiran</h4>
                            <div class="table-responsive table--no-card m-b-30">
                                <table class="table table-borderless table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Detail Kehadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absensi as $a)
                                            <tr>
                                                <td>{{ $a->date }}</td>
                                                <td>
                                                    <span class="status {{ strtolower($a->status) }}">
                                                        {{ $a->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-secondary" data-toggle="modal"
                                                        data-target="#DetailModal{{ $a->id_absensi }}">Lihat</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
    
                                @foreach ($absensi as $a)
                                {{-- Modal Detail Kehadiran --}}
                                <div class="modal fade" id="DetailModal{{ $a->id_absensi }}" tabindex="-1" role="dialog"
                                    aria-labelledby="DetailModalLabel{{ $a->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="DetailModalLabel{{ $a->id }}">
                                                    Detail Kehadiran <strong>{{ $a->date }}</strong>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <th>Status:</th>
                                                        <td>{{ $a->status }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jam Masuk:</th>
                                                        <td>{{ $a->jam_masuk ?? 'Tidak tersedia' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jam Pulang:</th>
                                                        <td>{{ $a->jam_pulang ?? 'Tidak tersedia' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Keterangan:</th>
                                                        <td>{{ $a->keterangan ?? 'Tidak tersedia' }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- Pagination -->
                            <div class="d-flex justify-content-center">
                                {{ $absensi->links() }}
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Statistik Kehadiran -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Jumlah Kehadiran Anda</h4>
                            <div class="progress mb-2">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ $persentaseHadir }}%" aria-valuenow="{{ $persentaseHadir }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                    Persentase Hadir: {{ $persentaseHadir }}%
                                </div>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i> Hadir: {{ $jumlahHadir }}
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-user-md text-info"></i> Sakit/Izin: {{ $jumlahIzin }}
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-clock text-warning"></i> Terlambat: {{ $jumlahTerlambat }}
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-times-circle text-danger"></i> Alfa: {{ $jumlahAlfa }}
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-bell text-primary"></i> TAP: {{ $jumlahTap }}
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-user-clock text-secondary"></i> Total Keterlambatan: {{ $totalKeterlambatan }} Menit
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</div>

<div class="appBottomMenu">
    <a href="{{ url('/siswa')}}" class="item">
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
    document.addEventListener("DOMContentLoaded", function() {
        var dropdownButton = document.getElementById('dropdownButton');
        var dropdownMenu = document.getElementById('dropdownMenu');

        dropdownButton.addEventListener('click', function(event) {
            dropdownMenu.style.display = dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '' ? 'block' : 'none';
        });

        window.addEventListener('click', function(event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.style.display = 'none';
            }
        });
    });
</script>
@push('myscript')
    <script type="text/javascript">
        $(function() {
            // Set tanggal mulai dan akhir ke 29 hari yang lalu dan hari ini
            var start = $('#start').val() ? moment($('#start').val()) : moment().subtract(29, 'days').startOf(
                'day');
            var end = $('#end').val() ? moment($('#end').val()) : moment().endOf('day');

            // Fungsi callback untuk memperbarui teks di tombol dan input hidden
            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D YYYY') + ' - ' + end.format('MMMM D YYYY'));
                // Update input hidden dengan format tanggal YYYY-MM-DD
                $('#start').val(start.format('YYYY-MM-DD'));
                $('#end').val(end.format('YYYY-MM-DD'));
            }

            // Inisialisasi daterangepicker
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Hari Ini': [moment().startOf('day'), moment().endOf('day')],
                    'Kemarin': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days')
                        .endOf('day')
                    ],
                    '7 Hari Terakhir': [moment().subtract(6, 'days').startOf('day'), moment().endOf('day')],
                    '30 Hari Terakhir': [moment().subtract(29, 'days').startOf('day'), moment().endOf(
                        'day')],
                    'Bulan Ini': [moment().startOf('month').startOf('day'), moment().endOf('month').endOf(
                        'day')],
                    'Bulan Sebelumnya': [moment().subtract(1, 'month').startOf('month').startOf('day'),
                        moment().subtract(1, 'month').endOf('month').endOf('day')
                    ]
                }
            }, cb);

            // Panggil callback untuk set teks default dan input hidden
            cb(start, end);
        });
    </script>
@endpush
@endsection
