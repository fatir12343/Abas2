@extends('layouts.maon')

@section('content')
<body>
    <!-- Header -->
    <div class="appHeader bg-secondary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
            </a>
        </div>
        <div class="pageTitle">profile</div>
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

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="container flex-grow-1 container-p-y">
            <!-- Spacing for Responsive Design -->
            <div class="d-block d-sm-none" style="min-height: 25px"></div>
            <div class="d-none d-sm-block d-md-none" style="min-height: 30px"></div>
            <div class="d-none d-md-block d-lg-none" style="min-height: 50px"></div>
            <div class="d-none d-lg-block d-xl-none" style="min-height: 60px"></div>
            <div class="d-none d-xl-block" style="min-height: 60px"></div>

            <!-- Profile Form -->
            <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $siswa->id }}">
                <h4 class="card-title mb-2">
                    Profil
                </h4>

                <!-- Alert Messages -->
                @if (Session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ Session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(Session('failed'))
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        {{ Session('failed') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Profile Details -->
                <div class="row mb-2">
                    <div class="col">
                        <div class="card">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="d-flex align-items-start gap-4">
                                    {{-- {{ dd($siswa->foto) }} --}}
                                    <img src="{{ asset('/storage/defaultuser/' . ($siswa->foto ? $siswa->foto : 'vault.png')) }}" alt="Profile Picture" class="d-block rounded" height="100" width="100">
                                    <div class="button-wrapper">`
                                        <label for="upload" class="btn btn-absen me-2 mb-4" tabindex="0">
                                           <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" class="account-file-input" hidden name="foto" accept="image/png, image/jpeg, image/jpg">
                                        </label>
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG.</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="Nama" class="form-label">Nama Panjang</label>
                                        <input class="form-control" type="text" id="Nama" value="{{ $siswa->name }}" disabled>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="NIS" class="form-label">NIS</label>
                                        <input class="form-control" type="text" id="NIS" value="00{{ $siswa->nis }}" disabled>
                                        <input type="hidden" name="nis" value="00{{ $siswa->nis }}">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="Email" class="form-label">Email</label>
                                        <input class="form-control" type="email" id="Email" name="email" value="{{ $siswa->email }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="password" class="form-label">Ganti Password</label>
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Masukkan password baru">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="kpassword" class="form-label">Konfirmasi Password</label>
                                        <input class="form-control" type="password" id="kpassword" name="kPassword" placeholder="Masukkan password baru">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-secondary me-2">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Footer -->
            <div>
                <i class='bx bx-copyright'></i> Aplikasi Absensi Sebelas, 2024
                <div class="d-md-none" style="height:60px;"></div>
            </div>
        </div>
    </div>

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
@endsection
