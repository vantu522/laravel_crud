@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Sửa nhân viên: {{$employee->name}}</h2>

    <form action="{{ route('employee.update', $employee->id) }}" method="POST" >
        @csrf 
        @method('PUT')
        <div class="mb-3">
            <label>Họ tên</label>
            <input type="text" name="name" value="{{ $employee->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email"  name="email"  class="form-control" required value="{{$employee->email}}" >
        </div>

        <div class="mb-3">
            <label>Số điện thoại</label>
            <input type="text" name="phone_number" value="{{ $employee->phone_number }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Địa chỉ</label>
            <input type="text" name="address" class="form-control" value="{{$employee->address}}" required >
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{route('employee.index')}}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection