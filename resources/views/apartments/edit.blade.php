@extends('layouts.app')

@section('content')
<h1>Sửa Tòa Nhà</h1>
<form method="POST" action="{{ route('apartments.update', $apartment->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $apartment->name }}" required>
    <input type="text" name="address" value="{{ $apartment->address }}" required>
    <input type="file" name="image">
    <button type="submit">Cập nhật</button>
</form>
@endsection
