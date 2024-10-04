@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="container">
                    <h2>Create Notification</h2>

                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" id="body" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="datetime-local" name="date" id="date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="creator_name">Creator Name</label>
                            <input type="text" name="creator_name" id="creator_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="creator_email">Creator Email</label>
                            <input type="email" name="creator_email" id="creator_email" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Notification</button>
                    </form>
                </div>
            @endsection
