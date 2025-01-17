@extends('layouts.app')

@section('content')
<h1>Thêm Phòng Trọ - {{ $apartment->name }}</h1>
<form method="POST" action="{{ route('rooms.store', $apartment->id) }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="room_number" placeholder="Số phòng" required>
    <input type="number" name="price" placeholder="Giá thuê" required>
    <input type="file" name="image">
    <button type="submit">Thêm</button>
</form>
@endsection
