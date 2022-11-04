@extends('layouts.main')

@section('css')
{{-- Kontak CSS --}}
<link rel="stylesheet" href="{{ asset('/assets/css/kontak/style.css') }}">
@endsection

@section('content')

<div class="content">

    <div class="container">
        <div class="row">
            <div class="col-md-5 mr-auto">
                <h2>Contact Us</h2>
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste quaerat autem corrupti
                    asperiores accusantium et fuga! Facere excepturi, quo eos, nobis doloremque dolor labore expedita
                    illum iusto, aut repellat fuga!</p>
            </div>

            <div class="col-md-6">
                <form action="{{route('kontak.kontak.store')}}" method="POST">
                    @csrf

                    @if (\Session::has('success'))
                    <div class="alert alert-success ">

                        {!! \Session::get('success') !!}

                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="name" class="col-form-label">Name</label>
                            <input type="text" name="name"
                                class="form-control rounded-top @error('name') is-invalid @enderror" id="name"
                                placeholder="Name" required value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" placeholder="email@gmail.com" required value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="message" class="col-form-label">Message</label>
                            <input type="hidden" name="message"
                                class="form-control @error('message') is-invalid @enderror" id="message"
                                placeholder="message" required value="{{ old('message') }}">
                            <trix-editor input="message"></trix-editor>
                            @error('message')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary mt-3" type="submit">Send Message</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @endsection