@extends('layouts.app')

@section('content')
<h1>Thêm Tiền Trọ - Phòng {{ $room->room_number }}</h1>
<form method="POST" action="{{ route('rents.store', $room->id) }}" enctype="multipart/form-data">
    @csrf
    <input type="number" name="electricity" placeholder="Số điện" required>
    <input type="number" name="water" placeholder="Số nước" required>
    <input type="number" name="total_amount" placeholder="Tổng tiền" required>
    <input type="number" name="paid_amount" placeholder="Đã thanh toán" required>
    <input type="file" name="electricity_image">
    <input type="file" name="water_image">
    <button type="submit">Thêm</button>
</form>
@endsection
