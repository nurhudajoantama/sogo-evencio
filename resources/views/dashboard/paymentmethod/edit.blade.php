@extends('layouts.dashboard.main')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Ubah Metode Pembayaran</h1>
<p class="mb-4">Halaman ini untuk mengubah metode pembayaran pada aplikasi.</p>

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

    <div class="card-body">
        <form action={{ route('dashboard.paymentmethods.update', $paymentMethod) }} method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input type="text" class="form-control" id="Category" placeholder="Category"
                    value="{{ $paymentMethod->category->name }}" disabled>

            </div>
            <div class="form-group">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="Name" placeholder="Name"
                    name="name" value="{{ old('name') ?? $paymentMethod->name }}">
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
                    placeholder="Account Name" name="account_name"
                    value="{{ old('account_name') ?? $paymentMethod->account_name  }}">
                @error('account_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            @switch($paymentMethod->payment_method_category_id)
            @case(1)
            <div class="form-group">
                <input type="text" class="form-control @error('account_number') is-invalid @enderror"
                    id="account_number" placeholder="Account Number" name="account_number"
                    value="{{ old('account_number') ?? $paymentMethod->account_number  }}">
                @error('account_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            @break

            @case(2)
            <div class="form-group">
                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                    placeholder="Phone Number" name="phone_number"
                    value="{{ old('phone_number') ?? $paymentMethod->phone_number  }}">
                @error('phone_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            @break

            @case(3)
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
                Simpan
            </button>
        </form>
    </div>

</div>
@endsection