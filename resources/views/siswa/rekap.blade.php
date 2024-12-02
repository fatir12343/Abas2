@extends('layouts.maon')

@section('content')
<!-- Header -->
<div class="appHeader bg-secondary text-light">
    <div class="left">
        <a href="javascript:history.back();" class="headerButton goBack">
            <ion-icon name="arrow-back-outline" style="font-size: 24px; color: #ffffff;"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Rekap Absensi</div>
    <div class="right"></div>

    <div style="margin-left: auto; position: relative;">
        <button id="dropdownButton" style="background: none; border: none; cursor: pointer; display: flex; align-items: center; color: #cacaca;">
            <ion-icon name="person-circle-outline" style="font-size: 24px;"></ion-icon>
            <strong style="margin-left: 5px; font-size: 16px;">{{ Auth::user()->name }}</strong>
            <ion-icon name="chevron-down-outline" style="margin-left: 5px; font-size: 16px;"></ion-icon>
        </button>
        <div id="dropdownMenu" style="display: none; position: absolute; right: 0; background: white; border: 1px solid #ccc; border-radius: 4px; box-shadow: 0 8px 16px rgba(0,0,0,0.2); width: 200px;">
            <a href="{{route('profile')}}" class="item" style="display: flex; align-items: center; text-decoration: none; padding: 10px 20px; color: #6c757d;">
                <ion-icon name="person-outline" style="font-size: 18px;"></ion-icon>
                <span style="margin-left: 10px; font-size: 16px;">Profile</span>
            </a>
            <a href="{{ route('logout') }}" class="item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="display: flex; align-items: center; text-decoration: none; padding: 10px 20px; color: #dc3545;">
                <ion-icon name="log-out-outline" style="font-size: 18px;"></ion-icon>
                <span style="margin-left: 10px; font-size: 16px;">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>

<!-- Add margin-top to separate the header from the content -->
<section class="statisticrekap p-t-20 mt-5">
    <div class="container">
        <div class="row">
            <!-- Rekap Kehadiran Card -->
            <div class="col-lg-7 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">laporan absensi</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
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
                                                <span class="badge badge-{{ strtolower($a->status) }}">{{ $a->status }}</span>
                                            </td>
                                            <td>
                                                <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#DetailModal{{ $a->id_absensi }}">
                                                    Lihat
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center">
                                {{ $absensi->links('pagination::bootstrap-4') }}
                            </div>

                            <!-- Modal for Absensi Details -->
                            @foreach ($absensi as $a)
                                <div class="modal fade" id="DetailModal{{ $a->id_absensi }}" tabindex="-1" role="dialog" aria-labelledby="DetailModalLabel{{ $a->id_absensi }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Kehadiran {{ $a->date }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-borderless">
                                                    <tr><th>Status:</th><td>{{ $a->status }}</td></tr>
                                                    <tr><th>Jam Masuk:</th><td>{{ $a->jam_masuk ?? 'Tidak tersedia' }}</td></tr>
                                                    <tr><th>Jam Pulang:</th><td>{{ $a->jam_pulang ?? 'Tidak tersedia' }}</td></tr>
                                                    <tr><th>Menit Keterlambatan:</th><td>{{ $a->menit_keterlambatan ? $a->menit_keterlambatan . ' menit' : 'Tidak tersedia' }}</td></tr>
                                                    <tr><th>Keterangan:</th><td>{{ $a->keterangan ?? 'Tidak tersedia' }}</td></tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Kehadiran Anda Card -->
            <div class="col-lg-5 mb-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('rekap') }}" method="GET" class="d-flex flex-column flex-md-row justify-content-between">
                            <div class="form-group">
                                <label for="from-date">From</label>
                                <input type="date" id="from-date" name="start_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="to-date">To</label>
                                <input type="date" id="to-date" name="end_date" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg mt-md-0 mt-3">
                                <i class="zmdi zmdi-search"></i> Cari
                            </button>
                        </form>

                        <h4 class="card-title text-center my-4">Jumlah Kehadiran Anda</h4>
                        <div class="progress mb-2" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $persentaseHadir }}%;">
                                {{ $persentaseHadir }}%
                            </div>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <i class="fas fa-check-circle text-success"></i> Hadir:
                                <span class="badge badge-success badge-pill">{{ $jumlahHadir }}</span>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-user-md text-info"></i> Sakit/Izin:
                                <span class="badge badge-info badge-pill">{{ $jumlahIzin }}</span>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-clock text-warning"></i> Terlambat:
                                <span class="badge badge-warning badge-pill">{{ $jumlahTerlambat }}</span>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-times-circle text-danger"></i> Alfa:
                                <span class="badge badge-danger badge-pill">{{ $jumlahAlfa }}</span>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-bell text-primary"></i> TAP:
                                <span class="badge badge-primary badge-pill">{{ $jumlahTap }}</span>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-user-clock text-secondary"></i> Total Keterlambatan:
                                <span class="badge badge-secondary badge-pill">{{ $totalKeterlambatan }} Menit</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>







<div class="appBottomMenu">
    <a href="/siswa" class="item">
        <div class="col">
            <ion-icon name="home-outline" class="icon"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    <a href="{{ route('rekap') }}" class="item">
        <div class="col">
            <ion-icon name="albums-outline" class="icon"></ion-icon>
            <strong>Rekap</strong>
        </div>
    </a>
</div>

<!-- Scripts -->
<script src="{{ asset('assets/template2/js/lib/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/template2/js/lib/popper.min.js') }}"></script>
<script src="{{ asset('assets/template2/js/lib/bootstrap.min.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
<script src="{{ asset('assets/template2/js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/template2/js/plugins/jquery-circle-progress/circle-progress.min.js') }}"></script>
<script src="{{ asset('assets/template2/js/base.js') }}"></script>
<script src="{{ asset('assets/template2/js/profile.js') }}"></script>

<!-- Dropdown Menu Toggle Script -->
<script>
    document.getElementById('dropdownButton').addEventListener('click', function() {
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.style.display = dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '' ? 'block' : 'none';
    });
</script>
</body>
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

        document.getElementById('dropdownButton').addEventListener('click', function() {
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });
    </script>
@endpush
@endsection
