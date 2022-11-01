@extends('layouts.dashboard.main')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Ubah User</h1>
<p class="mb-4">Halaman ini untuk mengubah user pada aplikasi.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="user" action="{{ route('dashboard.user.update',$user) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="Name"
                    placeholder="Name" name="name" value="{{ old('name') ?? $user->name }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror"
                    id="Username" placeholder="Username" name="username"
                    value="{{ old('username') ?? $user->username }}">
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                    id="Email" placeholder="Email Address" name="email" value="{{ old('email') ?? $user->email }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password"
                        class="form-control form-control-user @error('password') is-invalid @enderror" id="Password"
                        placeholder="Password" name="password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input type="password"
                        class="form-control form-control-user @error('confirm_password') is-invalid @enderror"
                        id="RepeatPassword" placeholder="Repeat Password" name="confirm_password">
                    @error('confirm_password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Ubah user
            </button>
        </form>
    </div>
</div>
@endsection