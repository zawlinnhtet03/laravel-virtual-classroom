@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="container">
                    <h2>Notifications</h2>

                    @foreach ($posts as $post)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->body }}</p>
                                <p class="card-text"><small class="text-muted">Created by {{ $post->creator_name }}
                                        ({{ $post->creator_email }})
                                        on {{ $post->date }}</small></p>
                            </div>
                        </div>
                    @endforeach

                    <div id="app">
                        <example-component></example-component>
                    </div>


                </div>
            @endsection
