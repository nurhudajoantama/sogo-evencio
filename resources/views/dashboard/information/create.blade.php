@extends('layouts.dashboard.main')

@section('content')
<form action="{{route('dashboard.information.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        @error('slug')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label class="" style="margin-top: 100px" for="title">Title</label>
        <input type="text" class="form-control  @error('title') is-invalid @enderror" id="title" name="title"
            placeholder="Title" value="{{old('title')}}">
        @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="" for="image" class="form-label">Image</label>
        <img class="img-preview img-fluid mb-4 col-sm-2">
        <input class="form-control  @error('image') is-invalid @enderror" type="file" id="image" name="image"
            onchange="previewImage()">
        @error('image')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <label class="" style="margin-top: 100px" for="video">Url Video</label>
        <input type="text" class="form-control  @error('video') is-invalid @enderror" id="video" name="video"
            placeholder="URL" value="{{old('video')}}">
        @error('video')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    
    <div class="form-group">
        <label class="" for="body">Body</label>
        <input type="hidden" class="form-control  @error('body') is-invalid @enderror" id="body" name="body"
            value="{{old('body')}}">
        <trix-editor input="body"></trix-editor>
        @error('body')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>       
    
    <div class="d-flex" style="justify-content: center">
        <button type="submit" class="btn">Add</button>
    </div>
</form>

@endsection

@section('script')
<script>
    const csrf_token = "{{csrf_token()}}";

    // previewImage
    function previewImage(){

        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
<script src="{{URL::asset('/js/select2-conf.js')}}" defer></script>
@endsection