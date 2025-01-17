@extends('layouts.app')

@section('content')
<h1>Danh sách Phòng Trọ - {{ $apartment->name }}</h1>
<form method="GET" action="{{ route('rooms.index', $apartment->id) }}">
    <input type="text" name="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">
    <button type="submit">Tìm kiếm</button>
</form>
<a href="{{ route('rooms.create', $apartment->id) }}">Thêm Phòng Trọ</a>
<ul>
    @foreach ($rooms as $room)
        <li>
            <strong>Phòng {{ $room->room_number }}</strong> - Giá thuê: {{ $room->price }} VND
            <a href="{{ route('rooms.edit', [$apartment->id, $room->id]) }}">Sửa</a>
            <form method="POST" action="{{ route('rooms.destroy', [$apartment->id, $room->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Xóa</button>
            </form>
        </li>
    @endforeach
</ul>
{{ $rooms->links() }}
@endsection
