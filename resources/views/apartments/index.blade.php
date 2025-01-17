@extends('layouts.app')

@section('content')
<h1>Danh sách Tòa Nhà</h1>
<form method="GET" action="{{ route('apartments.index') }}">
    <input type="text" name="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">
    <button type="submit">Tìm kiếm</button>
</form>
<a href="{{ route('apartments.create') }}">Thêm Tòa Nhà</a>
<ul>
    @foreach ($apartments as $apartment)
        <li>
            <strong>{{ $apartment->name }}</strong> - {{ $apartment->address }}
            <a href="{{ route('apartments.edit', $apartment->id) }}">Sửa</a>
            <form method="POST" action="{{ route('apartments.destroy', $apartment->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Xóa</button>
            </form>
        </li>
    @endforeach
</ul>
{{ $apartments->links() }}
@endsection
