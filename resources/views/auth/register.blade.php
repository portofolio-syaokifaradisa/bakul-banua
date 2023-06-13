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
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <div class="card card-primary">
                        <div class="card-header"><h4>Pendaftaran Akun</h4></div>
                        <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success mb-2">{{ Session::get('success') }}</div>
                        @elseif(Session::has('error'))
                            <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
                        @endif
                        <form action="{{ route('registration') }}" method="post"
                            enctype='multipart/form-data'>
                            <div class="card-body">
                              @csrf
                      
                              <div class="row">
                                <div class="form-group col">
                                  <label><b>Nama UMKM</b></label>
                                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') ?? ($umkm->name ?? '') }}">
                                  @error('name')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                                </div>
                                <div class="form-group col">
                                  <label><b>Tahun Berdiri</b></label>
                                  <input type="number" class="form-control @error('since') is-invalid @enderror" name="since"
                                    value="{{ old('since') ?? ($umkm->since ?? '') }}">
                                  @error('since')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                                </div>
                              </div>
                              <div class="row">
                                <div class="form-group col">
                                  <label><b>NIB</b></label>
                                  <input type="text" class="form-control @error('nib') is-invalid @enderror" name="nib" value="{{ old('nib') ?? ($umkm->nib ?? '') }}">
                                  @error('nib')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                                </div>
                                <div class="form-group col">
                                  <label><b>Legalitas</b></label>
                                  <div class="row align-middle px-4 pt-2">
                                    <div class="custom-control custom-checkbox col">
                                      <input type="checkbox" class="custom-control-input" name="has_bpom" id="option-bpom" @if ($umkm->has_bpom ?? false) checked @endif>
                                      <label class="custom-control-label" for="option-bpom">BPOM</label>
                                    </div>
                                    <div class="custom-control custom-checkbox col">
                                      <input type="checkbox" class="custom-control-input" name="has_pirt" id="option-pirt" @if ($umkm->has_pirt ?? false) checked @endif>
                                      <label class="custom-control-label" for="option-pirt">PIRT</label>
                                    </div>
                                    <div class="custom-control custom-checkbox col">
                                      <input type="checkbox" class="custom-control-input" name="has_halal" id="option-halal" @if ($umkm->has_halal ?? false) checked @endif>
                                      <label class="custom-control-label" for="option-halal">Halal</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label><b>Alamat UMKM</b></label>
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address') ?? ($umkm->address ?? '') }}</textarea>
                                @error('address')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="row">
                                <div class="form-group col">
                                  <label><b>Nama Lengkap Owner</b></label>
                                  <input type="text" class="form-control @error('owner') is-invalid @enderror" name="owner"
                                    value="{{ old('owner') ?? ($umkm->owner ?? '') }}">
                                  @error('owner')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                                </div>
                                <div class="form-group col">
                                  <label><b>Nomor Telepon Owner</b></label>
                                  <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    value="{{ old('phone') ?? ($umkm->phone ?? '') }}">
                                  @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                                </div>
                              </div>
                              <div class="row">
                                <div class="form-group col">
                                  <label><b>Email</b></label>
                                  <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') ?? ($umkm->email ?? '') }}">
                                  @error('email')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                                </div>
                                <div class="form-group col">
                                  <label><b>Password</b></label>
                                  <input type="password" class="form-control" name="password">
                                </div>
                              </div>
                            </div>
                            <div class="card-footer text-center">
                              <button class="btn btn-primary w-100">
                                Daftar
                              </button>
                              <p class="mt-1">
                                Sudah memiliki akun? Silahkan <a href="{{ route('login') }}">login disini</a>
                              </p>
                            </div>
                          </form>
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