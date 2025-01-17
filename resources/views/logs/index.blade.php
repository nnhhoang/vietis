@extends('layouts.app')

@section('content')
<h1>Nhật ký thao tác</h1>
<ul>
    @foreach ($logs as $log)
        <li>
            {{ $log->timestamp }} - {{ $log->action }} bởi {{ $log->user->name }}
        </li>
    @endforeach
</ul>
{{ $logs->links() }}
@endsection
