@extends('layouts.dashboard.main')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Buat Produk / Layanan</h1>
<p class="mb-4">Halaman ini untuk membuat produk atau layanan pada aplikasi.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="user" action="{{ route('dashboard.products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="Name" placeholder="Name"
                    name="name" value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                    placeholder="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                        placeholder="Price" name="price" value="{{ old('price') }}">
                    @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <select class="form-control @error('is_service') is-invalid @enderror" id="is_service"
                        name="is_service">
                        <option selected disabled>Pilih Jenis</option>
                        <option value="1">Layanan</option>
                        <option value="0">Produk</option>
                    </select>
                    @error('is_service')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control @error('shopee_link') is-invalid @enderror" id="shopee_link"
                    placeholder="shopee link" name="shopee_link" value="{{ old('shopee_link') }}">
                @error('shopee_link')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input type=" text" class="form-control @error('tokopedia_link') is-invalid @enderror"
                    id="TokopediaLink" placeholder="Tokopedia Link" name="tokopedia_link"
                    value="{{ old('tokopedia_link')  }}">
                @error('tokopedia_link')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Buat Produk / Layanan
            </button>
        </form>
    </div>
</div>
@endsection