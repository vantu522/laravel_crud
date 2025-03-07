@extends('layouts.app')

@section('content')
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="container mt-6">
        <h1 class="text-center">Danh sách nhân viên</h1>
   
        <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
            {{-- <form class="d-flex" action="{{route('employees.search')}}" method="GET" >
                @csrf 
                <input class="form-control me-2 " style="width:500px" type="text" name="query" placeholder="Nhập từ khóa..." aria-label="Search" >
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </form> --}}
            <a href="{{ route('employee.create') }}" class="btn btn-success">Thêm mới</a>
        </div> 
    
        <table class="table table-hover table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{$employee->name}}</td>
                    <td>{{$employee->email}}</td>
                    <td>{{$employee->phone_number}}</td>
                    <td>{{$employee->address}}</td>
                    <td class="text-center">
                        <div class="d-inline-flex gap-2">
                            <a href="{{ route('employee.edit', $employee->id)}}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{route('employee.destroy', $employee->id)}}" method="POST">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ route('employee.destroy', $employee->id) }}')">Xóa</button>
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
                    <form id="deleteForm" method="post">
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
