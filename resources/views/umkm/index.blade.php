@extends('templates.app', [
    'title' => 'Halaman UMKM',
    'titlePage' => 'Manajemen Data UMKM',
    'sectionTitle' => 'Halaman UMKM',
    'sectionSubTitle' => 'Memanajemen data-data UMKM'
])

@section('page-header-actions')
    <a href="{{ route('umkm.create') }}" class="btn btn-primary">
      <i class="fas fa-plus mr-1"></i>
      Tambah UMKM
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
            <h4>Tabel UMKM</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100" id="umkm-datatable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 30px">No.</th>
                            <th class="text-center" style="width: 30px">Aksi</th>
                            <th class="text-center">Nama UMKM</th>
                            <th class="text-center">Tahun Berdiri</th>
                            <th class="text-center">NIB</th>
                            <th class="text-center">Legalitas</th>
                            <th class="text-center">Owner</th>
                            <th class="text-center">Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                    <tfoot>
                        <th id="no"></th>
                        <th id="action"></th>
                        <th id="name">Nama UMKM</th>
                        <th id="since">Tahun Berdiri</th>
                        <th id="nib">NIB</th>
                        <th id="legalities">Legalitas</th>
                        <th id="owner">Owner</th>
                        <th id="address">Alamat</th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js-extends')
    <script src="{{ asset('js/utils/alert.js') }}"></script>
    <script src="{{ asset('js/umkm/index.js') }}"></script>
@endsection