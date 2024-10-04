@extends('layouts.master') // Assuming you're using a layout file

@section('content')
    <div class="container">
        <!-- Form to create a new Zoom meeting -->
        <div class="row mb-4">
            <div class="col-md-12">
                @include('meeting.create') <!-- Include create.blade.php -->
            </div>
        </div>

        <!-- Display past and ongoing meetings -->
        <div class="row">
            <div class="col-md-12">
                <h3>Past Meetings</h3>
                @if(isset($meetings) && count($meetings) > 0)
                    <ul>
                        @foreach($meetings as $meeting)
                            <li>
                                <strong>{{ $meeting['topic'] }}</strong><br>
                                Start Time: {{ $meeting['start_time'] }}<br>
                                <a href="{{ $meeting['join_url'] }}">Join Meeting</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No past meetings found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection