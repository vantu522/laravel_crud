@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Sửa bài viết: {{$post->title}}</h2>

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf 
        @method('PUT')
        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="title" value="{{ $post->title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nội dung</label>
            <textarea type="text" id="summernote" name="content"  class="form-control" required>{{ $post->content }}</textarea>
        </div>

        <div class="mb-3">
            <label>Tác giả</label>
            <input type="text" name="author" value="{{ $post->author }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh</label>
            <input type="file" name="image" class="form-control" id="imageInput">
            <img id="previewImage" class="mt-2 img-thumbnail" style="max-width: 200px; {{ $post->image ? '' : 'display: none;' }}" 
            src="{{ asset($post->image) }}" alt="Ảnh bài viết">
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{route('posts.index')}}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection