@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>{{ $meeting->topic }}</h1>
        <p>{{ $meeting->agenda }}</p>
        <p>{{ $meeting->start_time }}</p>
        <p>{{ $meeting->duration }} minutes</p>
        <p><a href="{{ $meeting->join_url }}" target="_blank">Join Meeting</a></p>
    </div>
@endsection