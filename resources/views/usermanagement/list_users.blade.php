@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">List Users</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">List Users</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table comman-shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped table-hover table-center mb-0" id="UsersList">
                                <thead class="student-thread">
                                    <tr>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Date Join</th>
                                        <th>Position</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->user_id }}</td>
                                            <td>{{ $user->name }}</td>          
                                            <td>{{ $user->email }}</td>                
                                            <td>{{ $user->phone_number }}</td>
                                            <td>{{ $user->join_date }}</td>
                                            <td>{{ $user->role_name }}</td>

                                            <td class="text-end">
                                                <div class="actions">
                                            
                                                    <a class="btn btn-sm bg-danger-light delete_user" data-bs-toggle="modal" data-bs-target="#delete">
                                                        <i class="far fa-trash-alt me-2"></i>
                                                    </a>
                                                </div>
                                            </td>
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

{{-- model delete --}}
<div class="modal custom-modal fade" id="delete" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete User</h3>
                    <p>Are you sure you want to delete this user?</p>
                </div>
                <div class="modal-btn delete-action">
                    <form action="{{ route('user/delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="row">
                            <input type="hidden" name="user_id" class="e_user_id" value="">
                            <input type="hidden" name="avatar" class="e_avatar" value="">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary paid-continue-btn" style="width: 100%;">Delete</button>
                            </div>
                            <div class="col-6">
                                <a href="#" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
{{-- delete js --}}
<script>
    $(document).on('click', '.delete_user', function() {
        var user_id = $(this).closest('tr').find('td:first').text().trim();
        $('.e_user_id').val(user_id);
    });
</script>

@endsection

@endsection
