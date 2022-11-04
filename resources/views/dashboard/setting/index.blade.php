@extends('layouts.dashboard.main')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Produk dan Layanan</h1>
<p class="mb-4">Halaman ini berisi produk dan layanan yang terdaftar pada aplikasi.</p>

@if(session()->has('success'))
<div class="alert alert-success fade show" role="alert">
    {{ session('success') }}
</div>
@endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div>
            <h3>Alamat Asal Pengiriman</h3>
            <p>{{ $address->value }}</p>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addressModal">
                Ubah Alamat
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addressModalLabel">Ubah Alamat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('dashboard.setting.updateAddress') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="address" id="address">
                                <div class="row form-group mb-2">
                                    <div class="col-6">
                                        <label for="province">Provinsi</label>
                                        <select class="form-control" id="province-field">
                                            <option selected disabled>Pilih provinsi</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="city">Kota</label>
                                        <select class="form-control" id="city-field" name="origin">
                                            <option selected disabled value="">Pilih kota</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    const provinceField = document.getElementById('province-field');
    const cityField = document.getElementById('city-field');
    const addressField = document.getElementById('address');

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

    cityField.addEventListener('change', (e) => {
        addressField.value = cityField.options[cityField.selectedIndex].text + ', ' + provinceField.options[provinceField.selectedIndex].text;
    });
</script>
@endsection