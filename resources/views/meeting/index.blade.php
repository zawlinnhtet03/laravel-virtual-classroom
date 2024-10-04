    @extends('layouts.master')
    {{-- Meeting index by HTN --}}
    @section('content')
        {!! Toastr::message() !!}
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="container">

                        <div class="col-12 col-lg-12 col-xl-12 d-flex">
                            <div class="card flex-fill comman-shadow">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-6">

                                            <h4 class="card-title">Past Meetings</h4>
                                        </div>
                                        <div class="col-6">
                                            <div class="float-right">
                                                {{-- @if (Session::get('role_name') === 'Teachers')
                                                    <a href="{{ route('meeting.create') }}"
                                                        class="btn btn-primary float-end">Create New Meeting</a>
                                                @endif --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Topic</th>
                                                <th>Start Time</th>
                                                <th>Duration</th>
                                                <th>Join URL</th>
                                                @if (Session::get('role_name') === 'Teachers')
                                                    <th>Actions</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($meetings['data']['meetings'] as $meeting)
                                                <tr>
                                                    <td>{{ $meeting['topic'] }}</td>
                                                    <td>{{ $meeting['start_time'] }}</td>
                                                    <td>{{ $meeting['duration'] }} minutes</td>
                                                    <td><a href="{{ $meeting['join_url'] }}" target="_blank">Join
                                                            Meeting</a></td>

                                                    @if (Session::get('role_name') === 'Teachers')
                                                        <td>
                                                            <form action="{{ route('meeting.destroy', $meeting['id']) }}"
                                                                method="POST" style="display: inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Delete</button>

                                                            </form>
                                                        </td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                        </div>

                        {{-- Upcoming meetings by HTN --}}

                        <div class="col-12 col-lg-12 col-xl-12 d-flex">
                            <div class="card flex-fill comman-shadow">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-6">

                                            <h4 class="card-title">Upcoming Meetings</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Topic</th>
                                                <th>Start Time</th>
                                                <th>Duration</th>
                                                <th>Join URL</th>
                                                @if (Session::get('role_name') === 'Teachers')
                                                    <th>Actions</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($upcomingMeetings['data']['meetings'] as $meeting)
                                                <tr>
                                                    <td>{{ $meeting['topic'] }}</td>
                                                    <td>{{ $meeting['start_time'] }}</td>
                                                    <td>{{ $meeting['duration'] }} minutes</td>
                                                    <td><a href="{{ $meeting['join_url'] }}" target="_blank">Join
                                                            Meeting</a></td>

                                                    @if (Session::get('role_name') === 'Teachers')
                                                        <td>
                                                            <form action="{{ route('meeting.destroy', $meeting['id']) }}"
                                                                method="POST" style="display: inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Delete</button>

                                                            </form>
                                                        </td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection
