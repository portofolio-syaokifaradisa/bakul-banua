@extends('templates.app', [
    'title' => 'Halaman Produk',
    'titlePage' => 'Manajemen Produk',
    'sectionTitle' => 'Halaman Tambah Produk',
    'sectionSubTitle' => 'Memanajemen data-data produk yang dimiliki UMKM',
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
    <form action="{{ URLHelper::has('edit') ? route('product.update', ['id' => $product->id]) : route('product.store') }}" method="post"
      enctype='multipart/form-data'>
      <div class="card-body">
        @csrf
        @if (URLHelper::has('edit'))
          @method('PUT')
        @endif

        <div class="form-group">
          @if (Auth::guard('web')->check())
            <label><b>UMKM</b></label>
            <div class="form-group" style="width: 100%">
              <select class="form-control select2 category-select @error('umkm_id') is-invalid @enderror" name="umkm_id">
                <option value="-" selected hidden>Pilih UMKM</option>
                @foreach ($umkm as $data)
                  <option value="{{ $data->id }}" @if ($data->id === ($product->umkm->id ?? '')) selected @endif>{{ $data->name }}</option>
                @endforeach
              </select>
              @error('umkm_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          @endif
          <div class="form-group">
            <label><b>Foto-foto Produk</b></label>
            <div class="custom-file">
              <input type="file" name="picture[]" class="custom-file-input @error('umkm_id') is-invalid @enderror" id="uploaded-file-form" multiple>
              <label class="custom-file-label" for="uploaded-file-form" id="uploaded-file-label">Pilih File</label>
            </div>
            @if (URLHelper::has('edit'))
              <small>
                Foto-foto produk anda sebelumnya bisa dilihat pada link berikut <br>
                @foreach ($product->product_picture as $index => $picture)
                  <a href="{{ asset($picture->path) }}" target="_blank">
                    Foto {{ $index + 1 }}
                  </a>,
                @endforeach
              </small>
            @endif
            @error('picture')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="form-group col">
            <label><b>Nama Produk</b></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
              value="{{ old('name') ?? ($product->name ?? '') }}">
            @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group col">
            <label><b>Harga Produk</b></label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
              value="{{ old('price') ?? ($product->price ?? '') }}">
            @error('price')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
        <div class="form-group">
          <label><b>Deskripsi Produk</b></label>
          <textarea class="form-control" name="description">{{ old('description') ?? ($product->description ?? '') }}</textarea>
          @error('description')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
      <div class="card-footer text-right">
        <a href="{{ route('product.index') }}" class="btn btn-secondary px-3 mr-1"><i class="fas fa-times mr-1"></i> Batal</a>
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
