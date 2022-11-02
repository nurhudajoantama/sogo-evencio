@extends('layouts.dashboard.main')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">user</h1>
<p class="mb-4">Halaman ini berisi user yang terdaftar pada aplikasi.</p>

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
    <div class="card-header py-3">
        <div class="row justify-content-between">
            <div class="col-lg-3">
                <form action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search..."
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="card-body">
        {{-- BANK --}}
        @foreach ($paymentMethodsCategories as $paymentMethodsCategory)
        <div class="mb-2 d-flex justify-content-between">
            <h5>
                {{ $paymentMethodsCategory->name }}
            </h5>
            <div>
                <a href="{{ route('dashboard.paymentmethods.create') . '?method=' . $paymentMethodsCategory->name }}"
                    class="btn btn-primary">
                    Tambah {{ $paymentMethodsCategory->name }}
                </a>
            </div>
        </div>
        <div class="table-responsive mb-3">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Nama</th>
                        <th>Account Name</th>
                        @switch($paymentMethodsCategory->name)
                        @case('Bank')
                        <th>Account Number</th>
                        @break

                        @case('E-Wallet')
                        <th>Phone Number</th>
                        @break

                        @case('QR Code')
                        <th>QR Code</th>
                        @break

                        @default

                        @endswitch

                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paymentMethodsCategory->paymentMethods as $paymentMethod)
                    <tr>
                        <td>
                            <img class="m-auto" src="{{ asset('storage/' . $paymentMethod->logo) }}" alt=""
                                width="100px">

                        </td>
                        <td>{{ $paymentMethod->name }}</td>
                        <th>{{ $paymentMethod->account_name }}</th>
                        @switch($paymentMethodsCategory->name)
                        @case('Bank')
                        <th>{{ $paymentMethod->account_number }}</th>
                        @break

                        @case('E-Wallet')
                        <th>{{ $paymentMethod->phone_number }}</th>
                        @break

                        @case('QR Code')
                        <th>
                            <img class="m-auto" src="{{ asset('storage/' . $paymentMethod->qr_code) }}" alt=""
                                width="100px">
                        </th>
                        @break

                        @default

                        @endswitch
                        <td>
                            <a href="{{ route('dashboard.paymentmethods.edit', $paymentMethod) }}"
                                class="btn btn-primary btn-sm">Update</a>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#deleteModal{{ $paymentMethod->id }}">
                                Hapus
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{ $paymentMethod->id }}" tabindex="-1"
                                aria-labelledby="deleteModal{{ $paymentMethod->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModal{{ $paymentMethod->id }}Label">
                                                Hapus {{ $paymentMethodsCategory->name }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin ingin menghapus {{ $paymentMethodsCategory->name }} {{
                                            $paymentMethod->name }}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Close
                                            </button>
                                            <form
                                                action="{{ route('dashboard.paymentmethods.destroy', $paymentMethod) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </div>
</div>
@endsection