@extends('layouts.app')

@section('content')
<h1>Chi tiết Tòa Nhà</h1>
<p><strong>Tên:</strong> {{ $apartment->name }}</p>
<p><strong>Địa chỉ:</strong> {{ $apartment->address }}</p>
@if ($apartment->image)
    <img src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->name }}" style="max-width: 300px;">
@endif
<a href="{{ route('apartments.index') }}">Quay lại danh sách</a>
@endsection
