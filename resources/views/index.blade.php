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
    <div class="container" style="">
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
            @foreach ($products as $product)
            <div class="col-3">
                <div class="card pb-3" style="width: 18rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $product->name }}
                            <br />
                            <span style="font-size:15px">{{ $product->description }}</span>
                        </h5>
                        <p style="font-size:40px" class="card-text">Rp {{ $product->price }}</p>
    
                        <a href="{{ route('checkout', $product) }}" class="btn" 
                        style="background: #387C44; color: #fff">Beli Sekarang</a>
                        @if ($product->shopee_link)
                        <a href="{{ $product->shopee_link }}" target="_blank" class="btn mt-1"
                            style="background: #F7482E; color:#fff">Beli
                            di
                            shopee</a>
                        @endif
                        @if ($product->tokopedia_link)
                        <a href="{{ $product->tokopedia_link }}" target="_blank" class="btn mt-1"
                            style="background: #00AA5B; color:#fff">Beli di
                            tokopedia</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
    
        </div>
    </div>
@endsection