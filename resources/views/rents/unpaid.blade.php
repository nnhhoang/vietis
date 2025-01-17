@extends('layouts.app')

@section('content')
<h1>Danh sách phòng chưa thanh toán đủ tiền</h1>
<ul>
    @foreach ($unpaidRents as $rent)
        <li>
            Phòng {{ $rent->room->room_number }} - Tòa nhà: {{ $rent->room->apartment->name }}
            <br> Tổng tiền: {{ $rent->total_amount }} | Đã thanh toán: {{ $rent->paid_amount }}
        </li>
    @endforeach
</ul>
@endsection
