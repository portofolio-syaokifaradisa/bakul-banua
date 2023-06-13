@extends('templates.app', [
    'title' => 'Halaman Produk',
    'titlePage' => 'Manajemen Produk',
    'sectionTitle' => 'Halaman Produk',
    'sectionSubTitle' => 'Memanajemen data-data produk yang dimiliki UMKM'
])

@section('page-header-actions')
    <a href="{{ route('product.create') }}" class="btn btn-primary">
      <i class="fas fa-plus mr-1"></i>
      Tambah Produk
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
            <h4>Tabel Produk</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100" id="product-datatable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 30px">No.</th>
                            <th class="text-center" style="width: 30px">Aksi</th>
                            @if(Auth::guard('web')->check())
                                <th class="text-center">UMKM</th>
                            @endif
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
                        @if(Auth::guard('web')->check())
                            <th id="umkm">UMKM</th>
                        @endif
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
    @if(Auth::guard('web')->check())
        <script src="{{ asset('js/product/admin_index.js') }}"></script>
    @else
        <script src="{{ asset('js/product/index.js') }}"></script>
    @endif
@endsection