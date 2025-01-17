@extends('layouts.app')

@section('content')
<h1>Sửa Tiền Trọ - Phòng {{ $room->room_number }}</h1>
<form method="POST" action="{{ route('rents.update', [$room->id, $rent->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="number" name="electricity" value="{{ $rent->electricity }}" required>
    <input type="number" name="water" value="{{ $rent->water }}" required>
    <input type="number" name="total_amount" value="{{ $rent->total_amount }}" required>
    <input type="number" name="paid_amount" value="{{ $rent->paid_amount }}" required>
    <input type="file" name="electricity_image">
    <input type="file" name="water_image">
    <button type="submit">Cập nhật</button>
</form>
@endsection
