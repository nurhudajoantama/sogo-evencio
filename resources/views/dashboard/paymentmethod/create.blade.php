@extends('layouts.dashboard.main')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Buat Metode Pembayaran</h1>
<p class="mb-4">Halaman ini untuk membuat metode pembayaran pada aplikasi.</p>

@if(session()->has('success'))
<div class="alert alert-success fade show" role="alert">
    {{ session('success') }}
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger fade show" role="alert">
    {{ session('error') }}
</div>
@endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    @if ($method)
    <div class="card-body">
        <form action="{{ route('dashboard.paymentmethods.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="method" value="{{ $method }}">
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
                <label for="Logo">Logo</label>
                <input type="file" class="form-control-file @error('logo') is-invalid @enderror" id="Logo"
                    placeholder="Logo" name="logo" value="{{ old('logo') }}">
                @error('logo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" class="form-control @error('account_name') is-invalid @enderror" id="account_name"
                    placeholder="Account Name" name="account_name" value="{{ old('account_name')  }}">
                @error('account_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            @switch($method)
            @case('Bank')
            <div class="form-group">
                <input type="text" class="form-control @error('account_number') is-invalid @enderror"
                    id="account_number" placeholder="Account Number" name="account_number"
                    value="{{ old('account_number')  }}">
                @error('account_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            @break

            @case('E-Wallet')
            <div class="form-group">
                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                    placeholder="Phone Number" name="phone_number" value="{{ old('phone_number')  }}">
                @error('phone_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            @break

            @case('QR Code')
            <div class="form-group">
                <label for="qr_code">QR Code</label>
                <input type="file" class="form-control-file @error('qr_code') is-invalid @enderror" id="qr_code"
                    placeholder="QR Code" name="qr_code" value="{{ old('qr_code')  }}">
                @error('qr_code')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            @break

            @endswitch
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Tambah {{ $method }}
            </button>
        </form>
    </div>
    @else
    <div>
        <div class="card-body">
            <h1 class="h3 mb-2 text-gray-800">Pilih Metode Pembayaran</h1>
            <p class="mb-4">Pilih metode pembayaran yang akan dibuat.</p>
            <div class="row">
                <div class="col-lg-4">
                    <a href="{{ route('dashboard.paymentmethods.create', ['method' => 'Bank']) }}"
                        class="btn btn-primary btn-user btn-block">
                        Bank
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ route('dashboard.paymentmethods.create', ['method' => 'E-Wallet']) }}"
                        class="btn btn-primary btn-user btn-block">
                        E-Wallet
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ route('dashboard.paymentmethods.create', ['method' => 'QR Code']) }}"
                        class="btn btn-primary btn-user btn-block">
                        QR Code
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
    @endsection