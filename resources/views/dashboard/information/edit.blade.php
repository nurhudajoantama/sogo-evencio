@extends('layouts.dashboard.main')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Ubah Informasi</h1>
<p class="mb-4">Halaman ini untuk mengubah informasi pada aplikasi.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{route('dashboard.information.update', $information)}}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                @error('slug')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label class="" style="margin-top: 100px" for="title">Title</label>
                <input type="text" class="form-control  @error('title') is-invalid @enderror" id="title" name="title"
                    placeholder="Title" value="{{old('title', $information->title)}}">
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="font-createtitle" for="image" class="form-label">Image</label>

                @if($information->image)
                <img src="{{ asset('storage/' . $information->image) }}"
                    class="img-preview img-fluid mb-4 col-sm-2 d-block">
                @else
                <img class="img-preview img-fluid mb-4 col-sm-2">
                @endif
                <input class="form-control-file border-creatinformation @error('image') is-invalid @enderror"
                    type="file" id="image" name="image" onchange="previewImage()">
                @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <div class="mb-3">
                <label class="" for="video">Url Video</label>
                <input type="text" class="form-control  @error('video') is-invalid @enderror" id="video" name="video"
                    placeholder="URL" value="{{old('video', $information->video)}}">
                @error('video')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="" for="body">Body</label>
                <input type="hidden" class="form-control  @error('body') is-invalid @enderror" id="body" name="body"
                    value="{{old('body', $information->body)}}">
                <trix-editor input="body"></trix-editor>
                @error('body')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

    </div>

    <div class="d-flex" style="justify-content: center">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>

    </form>
</div>
</div>
@endsection

@section('script')
<script>
    const csrf_token = "{{csrf_token()}}";

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