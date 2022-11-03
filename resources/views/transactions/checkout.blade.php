@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Checkout Page</h1>
    <div class="card pb-3 mx-auto mb-5" style="width: 18rem;">
        <div class="card-body text-center">
            <h5 class="card-title text-capitalize">{{ $product->name }}
                <br />
                <span style="font-size:15px">{{ $product->description }}</span>
            </h5>
            <p style="font-size:40px" class="card-text">Rp {{ $product->price }}</p>
        </div>
    </div>
    <form action="">
        @csrf
        @if ($product->is_service)
        <input type="hidden" name="service_id" value="{{ $product->id }}">
        @else
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="form-group mb-2">
            <label for="layan">Selakian layanannya?</label>
            <select class="form-control" id="layan" name="service_id">
                <option selected value="0">gak dulu</option>
                <option disabled>&nbsp;&nbsp;&nbsp;List Layanan</option>
                @foreach ($services as $service)
                <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="form-group mb-2">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" placeholder="Nama penerima"
                value="{{ auth()->user()->name }}">
        </div>
        <div class="form-group mb-2">
            <label for="phone">Nomor Telepon</label>
            <input type="text" class="form-control" id="phone" placeholder="Nomor telepon penerima">
        </div>

        <div class="row form-group mb-2">
            <div class="col-6">
                <label for="province">Provinsi</label>
                <select class="form-control" id="province-field">
                    <option selected disabled>Pilih provinsi</option>
                </select>
            </div>
            <div class="col-6">
                <label for="city">Kota</label>
                <select class="form-control" id="city-field">
                    <option selected disabled value="">Pilih kota</option>
                </select>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="address">Alamat</label>
            <textarea class="form-control" id="address" placeholder="Alamat lengkap penerima"></textarea>
        </div>

        <div class="form-group mb-2">
            <label for="courier-field">Kurir</label>
            <select class="form-control" id="courier-field">
                <option selected disabled value="">Pilih kurir</option>
                <option value="jne">JNE</option>
                <option value="pos">POS</option>
                <option value="tiki">Tiki</option>
            </select>
        </div>

        <div class="form-group mb-2">
            <label for="service-field">Layanan Pengiriman</label>
            <select class="form-control" id="service-field">
                <option selected disabled value="">Pilih layanan pengiriman</option>
            </select>
        </div>
        <div class="form-group mb-2">
            <button type="submit" class="btn btn-success">Buy</button>
        </div>
    </form>
</div>

<script>
    const getProvince = async () => {
        const response = await fetch(`{{ route('rajaongkir.provinces') }}`, {
            method: 'GET',
        });
        const data = await response.json();
        return data;
    }

    const getCity = async (provinceId) => {
        const response = await fetch(`{{ route('rajaongkir.cities') }}?province=${provinceId}`, {
            method: 'GET',
        });
        const data = await response.json();
        return data;
    }

    const getCost = async ({origin, destination, weight, courier}) => {
        const response = await fetch(`{{ route('rajaongkir.cost') }}?`, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                origin,
                destination,
                weight,
                courier,
            }),
            
        });
        const data = await response.json();
        return data;
    }

    const provinceField = document.getElementById('province-field');
    const cityField = document.getElementById('city-field');
    const courierField = document.getElementById('courier-field');
    const serviceField = document.getElementById('service-field');

    addEventListener('DOMContentLoaded', async () => {
        const provinces = await getProvince();
        provinces.forEach(province => {
            const option = document.createElement('option');
            option.value = province.province_id;
            option.innerText = province.province;
            provinceField.appendChild(option);
        });
    });

    provinceField.addEventListener('change', async (e) => {
        const cities = await getCity(e.target.value);
        cityField.innerHTML = '<option selected disabled value="">Pilih kota</option>';
        cities.forEach(city => {
            const option = document.createElement('option');
            option.value = city.city_id;
            option.innerText = city.city_name;
            cityField.appendChild(option);
        });
    });

    const costCheck = async () => {
        if (cityField.value == "" || courierField.value == "") return
        const cost = await getCost({
            destination: cityField.value,
            weight: '{{ $product->weight ?? 1000 }}',
            courier: courierField.value,
        })
        serviceField.innerHTML = '<option selected disabled value="">Pilih layanan pengiriman</option>';
        cost[0].costs.forEach(cost => {
            const option = document.createElement('option');
            option.value = cost.cost[0].value;
            option.innerText = `${cost.service} - Rp. ${cost.cost[0].value}`;
            serviceField.appendChild(option);
        });
    }

    cityField.addEventListener('change', async (e) => {
        await costCheck();
    });
    courierField.addEventListener('change', async (e) => {
        await costCheck();
    });
</script>
@endsection