@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container mt-100">
        <h1 class="mb-4">Thêm Bài Viết Mới</h1>
        <form action="{{route('posts.store')}}" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tiêu đề</label>
                <input type="text" name="title" class="form-control" placeholder="Tiêu đề" >
            </div>
           
            
            <div class="mb-3">
                <label class="form-label">Nội dung</label>
                <textarea type="text" name="content" class="form-control" placeholder="Nội dung" ></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Tác giả</label>
                <input type="text" name="author" class="form-control" placeholder="Tác giả">
            </div>
            <div class="mb-3">
                <label class="form-label">Ảnh</label>
                <input type="file" name="image" class="form-control" id="imageInput">
                <img id="previewImage" class="mt-2 img-thumbnail" style="max-width: 200px; display: none;">
            </div>
            <button type="submit" class="btn btn-success">Thêm</button>
            <a href="{{route('posts.index')}}" class="btn btn-secondary">Quay lại</a>
            
        </form>
    </div>
   
    
    

@endsection