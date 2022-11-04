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
                <a href="{{ route('dashboard.information.create') }}" class="btn btn-primary">Add Information</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" style="width: 100%" id="dataTable"  cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="width: 100%">
                    @foreach ($informations as $inf)
                    <tr>
                        <td>{{ $inf->title }}</td>
                        <td>{{ $inf->excerpt }}</td>
                        <td>
                        @if($inf->is_status == 1)
                            <span class="badge badge-primary" style="width: 100%; height: 35px">
                                <p class="mt-2">Aktif</p>
                            </span>
                        @else
                            <span class="badge badge-secondary" style="width: 100%; height: 35px">
                                <p class="mt-2">Nonaktif</p>
                            </span>
                        @endif
                        </td>
                        <td>
                            <a style="text-decoration: none" href="{{ route('dashboard.information.active', $inf->id) }}">
                                <span class="btn btn-primary" style="">Active</span>
                            </a>
                            <a href="{{ route('dashboard.information.nonactive', $inf->id) }}">
                                <span class="btn btn-secondary" style="">NonActive</span>
                            </a>
                            <a href="{{ route('dashboard.information.edit', $inf->id) }}"
                            class="btn btn-primary ">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#deleteModal{{ $inf->id }}">
                                Hapus
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{ $inf->id }}" tabindex="-1"
                                aria-labelledby="deleteModal{{ $inf->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModal{{ $inf->id }}Label">
                                                Hapus Article
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin ingin menghapus article {{ $inf->title }}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Close
                                            </button>
                                            <form action="{{ route('dashboard.information.destroy', $inf->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
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