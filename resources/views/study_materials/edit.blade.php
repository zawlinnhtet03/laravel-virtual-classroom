@extends('layouts.master')

@section('content')
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Edit Study Material</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('study_materials.index') }}">Study Materials</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Study Material Form</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('study_materials.update', $studyMaterial->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Enter title" value="{{ old('title', $studyMaterial->title) }}" required>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter description">{{ old('description', $studyMaterial->description) }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="subject_id">Subject</label>
                            <select id="subject_id" name="subject_id" class="form-control" required>
                                <option value="">Select Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id', $studyMaterial->subject_id) == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->subject_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="file">File</label>
                            <input type="file" id="file_path" name="file_path" class="form-control-file">
                            @if ($studyMaterial->file_path)
                                <a href="{{ asset('storage/' . $studyMaterial->file_path) }}" target="_blank" class="btn btn-sm bg-info-light mt-2">
                                    <i class="fas fa-download"></i> Current File
                                </a>
                            @endif
                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Update Study Material</button>
                            <a href="{{ route('study_materials.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
