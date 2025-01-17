@extends('layouts.app')

@section('content')
<h1>Thêm Tòa Nhà</h1>
<form method="POST" action="{{ route('apartments.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Tên tòa nhà" required>
    <input type="text" name="address" placeholder="Địa chỉ" required>
    <input type="file" name="image">
    <button type="submit">Thêm</button>
</form>
@endsection
