@extends('layouts.maon')

@section('content')
<body>
    <!-- Header -->
    <div class="appHeader bg-secondary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack"></a>
        </div>
        <div class="pageTitle">Profile</div>
        <div class="right"></div>
        <div style="margin-left: auto; position: relative;">
            <button id="dropdownButton" style="background: none; border: none; cursor: pointer; display: flex; align-items: center; color: #cacaca;">
                <ion-icon name="person-circle-outline" style="font-size: 24px;"></ion-icon>
                <strong style="margin-left: 5px; font-size: 14px;">{{ Auth::user()->name }}</strong>
                <ion-icon name="chevron-down-outline" style="margin-left: 5px; font-size: 15px;"></ion-icon>
            </button>
            <div id="dropdownMenu" style="display: none; position: absolute; right: 0; background: white; border: 1px solid #ccc; border-radius: 4px; box-shadow: 0 8px 15px rgba(0,0,0,0.2); width: 200px;">
                <a href="/profile" class="item" style="display: flex; align-items: center; text-decoration: none; padding: 10px 20px; color: #6c757d;">
                    <ion-icon name="person-outline" style="font-size: 18px;"></ion-icon>
                    <span style="margin-left: 10px; font-size: 15px;">Profile</span>
                </a>
                <a href="{{ route('logout') }}" class="item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="display: flex; align-items: center; text-decoration: none; padding: 10px 20px; color: #dc3545;">
                    <ion-icon name="log-out-outline" style="font-size: 18px;"></ion-icon>
                    <span style="margin-left: 10px; font-size: 15px;">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <!-- Content Wrapper -->
    <div class="container d-flex justify-content-center marginlayout" style="min-height: 80vh; padding-top: 50px;">
        <div class="card w-75">
            <div class="card-header">
                <h2>Profile Siswa</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Foto Profil di Kiri -->
                    <div class="col-md-4 text-center">
                        <div class="profile-picture">
                            @if ($siswa->foto)
                                <img src="{{ asset('storage/defaultuser/' . $siswa->foto) }}" alt="Foto Profil" width="150" class="img-thumbnail">
                            @else
                                <img src="{{ asset('assets/template2/img/sample/avatar/avatar1.jpg') }}" alt="Foto Profil" width="150" class="img-thumbnail">
                            @endif
                        </div>
                        <!-- Upload Foto di Bawah Foto Profil -->
                        <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data" class="mt-3">
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
                        <form action="{{ route('update-profile') }}" method="POST" id="profileForm">
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
            </div>
        </div>

        <!-- Notifikasi -->
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                });
            </script>
        @elseif (session('failed'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('failed') }}',
                });
            </script>
        @endif
    </div>

    <div class="appBottomMenu">
        <a href="/siswa" class="item">
            <div class="col">
                <ion-icon name="home-outline" class="icon"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="/rekap" class="item">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Dropdown Menu Toggle Script -->
    <script>
        document.getElementById('dropdownButton').addEventListener('click', function() {
            const dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.style.display = dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '' ? 'block' : 'none';
        });

        // Notifikasi dengan SweetAlert untuk form submit
        document.getElementById('profileForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form from submitting

            Swal.fire({
                title: 'Apakah Anda yakin ingin memperbarui profil?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, perbarui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if confirmed
                    event.target.submit();
                }
            });
        });
    </script>
</body>
@endsection
