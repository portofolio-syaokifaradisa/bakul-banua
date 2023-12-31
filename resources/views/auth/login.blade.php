<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Halaman Login | Bakul Banua</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free-5.7.2/css/all.min.css') }}" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('vendor/stisla/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/stisla/css/components.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('img/logo_bakul_banua.png') }}" />
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="d-flex flex-wrap align-items-stretch ">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white float-right">
          <div class="p-4 m-3">
            <div class="text-center">
                <img src="{{ asset('img/logo_bakul_banua.png') }}" alt="logo" width="80" class="mb-5 mt-2 mr-2">
            </div>
            <h4 class="text-dark font-weight-normal text-center">Selamat Datang di <br><span class="font-weight-bold">Bakul Banua</span></h4>
            <p class="text-muted text-center">Mari belajar dan bangkit bersama-sama</p>
            @if (Session::has('success'))
                <div class="alert alert-success mb-2">{{ Session::get('success') }}</div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
            @endif
            <form method="POST" action="{{ route('verify') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" tabindex="1" value="{{ old('email') }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" tabindex="2">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right px-3 text-center w-100" tabindex="4">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                  </button>
                  <p class="mt-1">
                    Belum memiliki akun? Silahkan <a href="{{ route('register') }}">daftar disini</a>
                  </p>
                </div>
            </form>
            <div class="text-center mt-5 pt-5 text-small">
              Developed <a href="https://erabits-indonesia.com/">Era Bits Indonesia 2023</a>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="{{ asset("img/login-bg.jpg") }}" >
          <div class="absolute-bottom-left index-2">
            <div class="text-light p-5">
              <div class="mb-5 pb-3">
                <h3 class="mb-2 display-4 font-weight-bold" style="filter: blur(0px)">Bakul Banua</h3>
                <h5 class="font-weight-normal text-muted-transparent" style="filter: blur(0px)">Bisnis Akselerator UMKM Unggulan Banua</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  
  <script src="{{ asset('vendor/stisla/js/stisla.js') }}"></script>
  <script src="{{ asset('vendor/stisla/js/scripts.js') }}"></script>
</body>