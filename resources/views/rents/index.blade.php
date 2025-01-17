@extends('layouts.app')

@section('content')
<h1>Danh sách Tiền Trọ - Phòng {{ $room->room_number }}</h1>
<a href="{{ route('rents.create', $room->id) }}">Thêm Tiền Trọ</a>
<ul>
    @foreach ($rents as $rent)
        <li>
            Số điện: {{ $rent->electricity }} | Số nước: {{ $rent->water }}
            | Tổng tiền: {{ $rent->total_amount }} | Đã thanh toán: {{ $rent->paid_amount }}
            <a href="{{ route('rents.edit', [$room->id, $rent->id]) }}">Sửa</a>
            <form method="POST" action="{{ route('rents.destroy', [$room->id, $rent->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Xóa</button>
            </form>
        </li>
    @endforeach
</ul>
{{ $rents->links() }}
@endsection
