@extends('layouts.main')

@section('content')
<div class="container">

    <h1 class="text-center mt-5">{{ $information->title }}</h1>

    <div class="d-flex justify-content-center">
        <img src="{{ $information->image ? asset('storage/' . $information->image) : asset('images/blank-image.jpg')}}"
            alt="{{ $information->title }}" class="img-fluid card-img-top img-border"
            style="width: 100%; max-width:480px;object-fit:contain;">
    </div>

    @if ($information->video)
    <div class="d-flex justify-content-center">
        <video width="854" height="480" controls>
            <source src="{{ $information->video }}">
            Your browser does not support the video tag.
        </video>
    </div>
    @endif
    <div class="mt-4">{!! $information->body !!}</div>
</div>


@endsection