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
        <form action="{{route('employee.store')}}" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Họ tên</label>
                <input type="text" name="name" class="form-control" placeholder="Tiêu đề"  >
            </div>
           
            
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Nội dung" >
            </div>
            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" name="phone_number" class="form-control" placeholder="Tác giả" >
            </div>
            <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <input type="text" name="address" class="form-control" placeholder="Địa chỉ">
            </div>
            <button type="submit" class="btn btn-success">Thêm</button>
            <a href="{{route('employee.index')}}" class="btn btn-secondary">Quay lại</a>
            
        </form>
    </div>
 
   
    
    

@endsection