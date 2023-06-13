@extends('templates.app', [
    'title' => 'Halaman Produk',
    'titlePage' => 'Manajemen Produk',
    'sectionTitle' => 'Halaman Produk',
    'sectionSubTitle' => 'Memanajemen data-data produk yang dimiliki UMKM',
])

@section('page-header-actions')
  <a href="{{ route('umkm.index') }}" class="btn btn-primary">
    <i class="fas fa-arrow-left mr-1"></i>
    Kembali
  </a>
@endsection

@section('content')
  @if (Session::has('success'))
    <div class="alert alert-success mb-2">{{ Session::get('success') }}</div>
  @elseif(Session::has('error'))
    <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
  @endif
  <div class="card">
    <div class="card-header">
      <h4>Detail UMKM</h4>
    </div>
    <div class="card-body">
      <table class="table table-sm">
        <tr>
          <td style="width: 20%">Nama UMKM</td>
          <td style="width: 10px">:</td>
          <td>{{ $umkm->name }}</td>
        </tr>
        <tr>
          <td style="width: 20%">Tahun Berdiri</td>
          <td style="width: 10px">:</td>
          <td>{{ $umkm->since }}</td>
        </tr>
        <tr>
          <td style="width: 20%">NIB</td>
          <td style="width: 10px">:</td>
          <td>{{ $umkm->nib }}</td>
        </tr>
        <tr>
          <td style="width: 20%">Alamat UMKM</td>
          <td style="width: 10px">:</td>
          <td>{{ $umkm->address }}</td>
        </tr>
        <tr>
          <td style="width: 20%">Legalitas</td>
          <td style="width: 10px">:</td>
          <td>
            {{ $umkm->has_bpom ? 'BPOM, ' : '' }}
            {{ $umkm->has_pirt ? 'PIRT, ' : '' }}
            {{ $umkm->has_halal ? 'Halal' : '' }}
          </td>
        </tr>
        <tr>
          <td style="width: 20%">Owner</td>
          <td style="width: 10px">:</td>
          <td>
            <p class="m-0">{{ $umkm->owner }}</p>
            <p class="m-0">{{ $umkm->phone }}</p>
            <p class="m-0">{{ $umkm->email }}</p>
          </td>
        </tr>
      </table>
    </div>
  </div>
  <div class="card">
    <div class="card-header row">
      <h4 class="col-3">Tabel Produk</h4>
      <div class="col">
        <a href="{{ route('umkm.product.create', ['umkm_id' => $umkm->id]) }}" class="btn btn-primary float-right">
          <i class="fas fa-plus mr-1"></i>
          Tambah Produk
        </a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped w-100" id="product-datatable">
          <thead>
            <tr>
              <th class="text-center" style="width: 30px">No.</th>
              <th class="text-center" style="width: 30px">Aksi</th>
              <th class="text-center" style="width: 100px">Foto Produk</th>
              <th class="text-center">Nama Produk</th>
              <th class="text-center">Harga Produk</th>
              <th class="text-center">Deskripsi</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
            <th id="no"></th>
            <th id="action"></th>
            <th id="picture">Foto Produk</th>
            <th id="name">Nama Produk</th>
            <th id="price">Harga Produk</th>
            <th id="description">Deskripsi Produk</th>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('js-extends')
  <script src="{{ asset('js/utils/alert.js') }}"></script>
  <script src="{{ asset('js/umkm/detail.js') }}"></script>
@endsection
