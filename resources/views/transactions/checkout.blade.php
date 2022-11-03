@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Checkout Page</h1>
    <p>
        {{ $product->name }}
    </p>
    <p>
        Rp. {{ $product->price }}
    </p>
    <p>
        {{ $product->description }}
    </p>

    <select class="form-control" id="province-field">
        <option selected disabled>Pilih provinsi</option>
    </select>
</div>

<script>



</script>
@endsection