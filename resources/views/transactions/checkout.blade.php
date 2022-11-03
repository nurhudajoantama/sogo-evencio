@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Checkout Page</h1>
    <p>
        {{ $product->name }}
    </p>
    <p>
        Rp. {{ $product->price }}
    </p>
    <p>
        {{ $product->description }}
    </p>

    <h3 id="shipment_price"></h3>

    <select class="form-control" id="province-field">
        <option selected disabled>Pilih provinsi</option>
    </select>

    <select class="form-control" id="city-field">
        <option selected disabled value="">Pilih kota</option>
    </select>

    <select class="form-control" id="courier-field">
        <option selected disabled value="">Pilih kurir</option>
        <option value="jne">JNE</option>
        <option value="pos">POS</option>
        <option value="tiki">Tiki</option>
    </select>

    <select class="form-control" id="service-field">
        <option selected disabled value="">Pilih layanan</option>
    </select>
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
        serviceField.innerHTML = '<option selected disabled value="">Pilih layanan</option>';
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