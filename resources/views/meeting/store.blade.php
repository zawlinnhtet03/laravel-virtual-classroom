@extends('layouts.master')

@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="card">  

                    <div class="card-header">
                        <h5 class="card-title">New Meeting Details</h5>
                    </div>
                    <div class="card-body pt-0">
                        <form action="{{ route('meeting.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                            @csrf
                            <div class="settings-form">

                                <div class="mb-6">
                                    <label for="topic" class="block mb-2 text-sm font-medium text-gray-700">Topic <span class="star-red">*</span></label>
                                    <input type="text" id="topic" name="topic" class="form-control @error('topic') is-invalid @enderror w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"  
                                           required>
                                    @error('topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label for="agenda" class="block mb-2 text-sm font-medium text-gray-700">Agenda <span class="star-red">*</span></label>
                                    <input type="text" id="agenda" name="agenda" class="form-control @error('agenda') is-invalid @enderror w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"  
                                           required>
                                    @error('agenda')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label for="start_time" class="block mb-2 text-sm font-medium text-gray-700">Start Time <span class="star-red">*</span></label>
                                    <input type="datetime-local" id="start_time" name="start_time" class="form-control @error('start_time') is-invalid @enderror w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"  
                                           required>
                                    @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="flex justify-center mb-0">
                                    <a href="{{ route('meeting.index') }}" class="btn btn-secondary mt-4 active" role="button" aria-pressed="true"><< Back</a>
                                    <button type="submit" class = "btn btn-primary mt-4">Create</button>
                                    <a href="{{ url()->previous() }}" class="ml-4 px-4 py-2 text-white bg-gray-500 rounded-md shadow-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection