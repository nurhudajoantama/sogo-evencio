@extends('layouts.dashboard.main')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Admin</h1>
<p class="mb-4">Halaman ini berisi admin yang terdaftar pada aplikasi.</p>

@if(session()->has('success'))
<div class="alert alert-success fade show" role="alert">
    {{ session('success') }}
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
            <div class="col-lg-2">
                <a href="{{ route('dashboard.admin.create') }}" class="btn btn-primary">Tambah Admin</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Admin</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->username }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>
                            <a href="{{ route('dashboard.admin.edit', $admin) }}"
                                class="btn btn-primary btn-sm">Update</a>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#deleteModal{{ $admin->id }}" @if(auth()->user()->id == $admin->id)
                                disabled @endif>
                                Hapus
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{ $admin->id }}" tabindex="-1"
                                aria-labelledby="deleteModal{{ $admin->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModal{{ $admin->id }}Label">
                                                Hapus Admin
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin ingin menghapus admin {{ $admin->name }}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Close
                                            </button>
                                            <form action="{{ route('dashboard.admin.destroy', $admin) }}" method="post">
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
    </div>
</div>
@endsection