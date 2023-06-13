@extends('templates.app', [
    'title' => 'Halaman UMKM',
    'titlePage' => 'Manajemen UMKM',
    'sectionTitle' => 'Halaman Tambah UMKM',
    'sectionSubTitle' => 'Memanajemen data-data UMKM',
])

@section('content')
  @if (Session::has('success'))
    <div class="alert alert-success mb-2">{{ Session::get('success') }}</div>
  @elseif(Session::has('error'))
    <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
  @endif
  <div class="card">
    <div class="card-header">
      <h4>Form Tambah Produk</h4>
    </div>
    <form action="{{ URLHelper::has('edit') ? route('umkm.update', ['umkm_id' => $umkm->id]) : route('umkm.store') }}" method="post"
      enctype='multipart/form-data'>
      <div class="card-body">
        @csrf
        @if (URLHelper::has('edit'))
          @method('PUT')
        @endif

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
      <div class="card-footer text-right">
        <a href="{{ route('umkm.index') }}" class="btn btn-secondary px-3 mr-1"><i class="fas fa-times mr-1"></i> Batal</a>
        <button class="btn btn-primary px-3">
          <i class="fas fa-save mr-1"></i>
          Simpan
        </button>
      </div>
    </form>
  </div>
@endsection

@section('js-extends')
  <script src="{{ asset('js/utils/upload-form.js') }}"></script>
@endsection
