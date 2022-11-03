@extends('layouts.main')

@section('content')
<div class="container">

    <h1 class="text-center mt-5">{{ $information->title }}</h1>

    @if ($information->image)
    <div>
        <img src="{{ asset('storage/' . $information->image) }}" alt="{{ $information->title }}" 
        class="img-fluid card-img-top img-border" style="width: 100%; height: 200px;object-fit:contain;">
    </div>
    @else
        <img src="{{ asset("image/blank-image.png") }}" >
    @endif
    <div class="text-center mt-4" >{{ $information->video }}</div>
    <div class="mt-4">{!! $information->body !!}</div>
</div>


@endsection