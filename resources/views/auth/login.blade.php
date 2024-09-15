
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>ABAS</title>
    <meta name="description" content="Absensi Sebelas">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('assets/template2/img/icon/icon_abas.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/template2/img/icon/icon_abas.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/template2/css/style.css') }}">
    <link rel="manifest" href="__manifest.json">
</head>

<body class="bg-white">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

    <!-- App Capsule -->
    <div id="appCapsule" class="pt-0">

        <div class="login-form mt-1">
            <div class="section">
                <img src="{{ asset('assets/template2/img/sample/photo/poto_abas1.png') }}" alt="image" class="form-image">
            </div>
            <div class="section mt-1">

                <h4>Fill the form to log in</h4>
            </div>

            <div class="section mt-1 mb-5">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email address">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password" placeholder="Password">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-links mt-2 d-flex justify-content-between">
                        <div>
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                        <div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-muted">Forgot Password?</a>
                            @endif
                            @if (Route::has('register'))
                                {{-- <span class="mx-2">|</span> --}}
                                <a href="{{ route('register') }}" class="text-muted">Register</a>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary btn-login">Log in</button>

                    <div class="form-button-group">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- * App Capsule -->

    <!-- Js Files -->
    <script src="{{ asset('assets/template2/js/lib/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('assets/template2/js/lib/popper.min.js') }}"></script>
    <script src="{{ asset('assets/template2/js/lib/bootstrap.min.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset('assets/template2/js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/template2/js/plugins/jquery-circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/template2/js/base.js') }}"></script>

</body>
</html>
