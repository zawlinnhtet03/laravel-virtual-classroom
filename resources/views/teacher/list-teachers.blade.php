@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Teachers</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Teachers</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                      
                        <div class="table-responsive">
                            <table id="DataList" class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread"> 
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <!-- <th>Email</th>  -->
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listTeacher as $list)
                                    <tr>
                                        <td>{{ $list->id }}</td>
                                        <td>{{ $list->full_name }}</td>          
                                        <!-- <td>{{ $list->email }}</td>                 -->
                                        <td>{{ $list->phone_number }}</td>
                                        <td>{{ $list->address }}</td>
                                        <td>{{ $list->city }}</td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="{{ route('teacher/edit', $list->id) }}" class="btn btn-sm bg-danger-light">
                                                    <i class="far fa-edit me-2"></i>
                                                </a>
                                                <a class="btn btn-sm bg-danger-light teacher_delete" data-bs-toggle="modal" data-bs-target="#teacherDelete">
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

{{-- model teacher delete --}}
<div class="modal custom-modal fade" id="teacherDelete" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Teacher</h3>
                    <p>Are you sure you want to delete this teacher?</p>
                </div>
                <div class="modal-btn delete-action">
                    <form action="{{ route('teacher/delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="row">
                            <input type="hidden" name="id" class="e_user_id" value="">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary continue-btn submit-btn" style="border-radius: 5px !important;">Delete</button>
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
        $(document).on('click', '.teacher_delete', function() {
            var user_id = $(this).closest('tr').find('td:first').text();
            $('.e_user_id').val(user_id);
        });
    </script>
@endsection

@endsection
