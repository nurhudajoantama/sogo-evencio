@extends('layouts.main')

@section('content')
{{-- JUMBOTRON --}}
<div class="container-fluid" style="--bs-gutter-x: 0;">
    <div class="content" style="height:750px;background: url({{ asset('/assets/img/bg.png') }}) no-repeat;
  background-size: cover;">
        <div class="info container" style="padding: 10% 0">
            <h2 class="align-middle">Tentang Kami</h2>
            <p style="text-align:justify;width:50%">Pencemaran lingkungan yang semakin hari semakin meningkat seiring
                sikap manusia yang konsumtif namun,
                tidak peduli akan dampak buruk tersebut. Hal ini menjadi awal bagi perusahaan kami untuk memberikan
                upaya-upaya agar manusia lebih sadar akan lingkungan sekitar. SOGO Evencio dengan singkatan Save
                Ours Green Eco mencoba menciptakan ide dengan produk positif yang tetap memenuhi kebutuhan manusia
                akan suatu produk dan tetap seimbang untuk menjaga dan memelihara lingkungan agar kembali hijau dan
                asri. Karena dengan lingkungan yang sehat, manusia pun akan merasakan dampak positif tersebut. </p>
            <a href="#" class="info-btn">More info</a>
        </div>
    </div>
    <div class="media-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
</div>

{{-- NEWS --}}
<div class="container">
    <div class="row mb-5 mt-5">
        <h2 class="amiri mt-5 text-center">Informasi dan Berita</h2>
        <hr style="width:20%;margin:20px auto">
        <div class="scrolling-wrapper row flex-row flex-nowrap mt-4 pb-4 pt-2">
            {{-- LOOP POSITION NEWS --}}
            @foreach ($informations as $inf)
            <div class="col-md-4">
                <div class="card card-block" style="position: relative;">
                    <div
                        style="position: absolute; top:50%; text-align: center; transform: translatey(-50%); padding: 4px; background-color:rgba(0, 0, 0, 0.2); width:100%">
                        <h1 class="text-white amiri fw-bold">{{ $inf->title }}</h1>
                        <a href="{{route('information.show', $inf)}}" class="text-white text-right"
                            style="text-decoration: none;">Lebih Lanjut</a>
                    </div>
                    <img src="{{ $inf->image ? asset('storage/' . $inf->image) : asset('images/blank-image.jpg') }}"
                        alt="{{ $inf->title }}" class="img-fluid card-img"
                        style="width: 100%; height: 200px;object-fit:cover;">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- PRODUCT --}}
<div class="container" id="service">
    <h2 class="text-center mb-4" style="padding-top:80px">Pilih Paket Layanan</h2>
    <hr style="width:20%;margin:20px auto">
    <div class="row justify-content-center">
        {{-- LOOP POSITION PRODUCT --}}
        @for ($i = 0; $i < 3; $i++) <div class="col-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body text-center">
                    <h5 class="card-title">Filter Air<br><span style="font-size:15px">Ideal untuk skala kecil</span>
                    </h5>
                    <p style="font-size:40px" class="card-text">Rp 13.900</p>
                    <button class="btn btn-primary">Tambah ke Keranjang</button>
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
            </div>
    </div>
    @endfor

</div>
</div>
@endsection