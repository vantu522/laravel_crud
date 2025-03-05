@extends('layouts.app')

@section('content')
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
        <div class="container mt-6">
            <h1>Danh sách bài viết</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-success mb-3">Thêm mới</a>
            <table class="table table-hover table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên</th>
                        <th>Nội dung</th>
                        <th>Tác giả</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td><img src="{{$post->image}}" class="img-thumbnail" style="width: 100px; "></td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->content}}</td>
                        <td>{{$post->author}}</td>

                        <td class="text-center">
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('posts.edit', $post->id)}}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ route('posts.destroy', $post->id) }}')">Xóa</button>
                                </form>
                            </div>
                        </td>
                        
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    <!-- Modal Xác Nhận Xóa -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa bài viết này?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <form id="deleteForm" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    {{-- xác nhận xoá --}}
    <script>
        function confirmDelete(url) {
            document.getElementById('deleteForm').setAttribute('action', url);
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
    

@endsection
