@extends('layouts.app')

@section('content')
<h1>Sửa Phòng Trọ - {{ $apartment->name }}</h1>
<form method="POST" action="{{ route('rooms.update', [$apartment->id, $room->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="text" name="room_number" value="{{ $room->room_number }}" required>
    <input type="number" name="price" value="{{ $room->price }}" required>
    <input type="file" name="image">
    <button type="submit">Cập nhật</button>
</form>
@endsection
