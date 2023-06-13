@extends('templates.app', [
    'title' => 'Halman Home',
    'titlePage' => 'Halaman Home',
    'sectionTitle' => 'Bakul Banua',
    'sectionSubTitle' => 'Bisnis Akselerator UMKM Unggulan Banua, Mari belajar dan bangkit bersama-sama'
])

@section('content')
<div class="card">
    <div class="card-body text-center pt-5">
        <h4 class="mt-3">Selamat Datang di Bakul Banua</h4>

        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_1pxqjqps.json" background="transparent" speed="1" style="width: 100%; height: 300px;" loop autoplay></lottie-player>
    </div>
</div>
@endsection