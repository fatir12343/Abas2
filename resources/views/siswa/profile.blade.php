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
    <div class="container">
        <h2>Profile Siswa</h2>
        <div class="row">
            <!-- Foto Profil di Kiri -->
            <div class="col-md-4 text-center">
                <div class="profile-picture">
                    @if ($siswa->foto)
                        <img src="{{ asset('storage/defaultuser/' . $siswa->foto) }}" alt="Foto Profil" width="150" class="img-thumbnail">
                    @else
                        <img src="{{ asset('images/vault.png') }}" alt="Foto Profil" width="150" class="img-thumbnail">
                    @endif
                </div>
                <!-- Upload Foto di Bawah Foto Profil -->
                <form action="{{ route('update-profile') }}" method="PUT" enctype="multipart/form-data" class="mt-3">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="foto">Ganti Foto Profil</label>
                        <input type="file" class="form-control-file" id="foto" name="foto">
                    </div>
                    <button type="submit" class="btn btn-secondary btn-sm">Upload Foto</button>
                </form>
            </div>

            <!-- Form di Kanan -->
            <div class="col-md-8">
                <form action="{{ route('update-profile') }}" method="PUT">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $siswa->name }}" disabled>
                    </div>

                    <!-- NIS -->
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" class="form-control" id="nis" name="nis" value="{{ $siswa->nis }}" disabled>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $siswa->email }}">
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-group">
                        <label for="kPassword">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="kPassword" name="kPassword">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Profil</button>
                </form>
            </div>
        </div>

        <!-- Notifikasi -->
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session('failed'))
            <div class="alert alert-danger mt-3">
                {{ session('failed') }}
            </div>
        @endif
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
