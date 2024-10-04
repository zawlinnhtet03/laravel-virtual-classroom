@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Questions for Quiz: {{ $quiz->title }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('quizzes.index') }}">Quizzes</a></li>
                        <li class="breadcrumb-item active">Questions</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if($questions && $questions->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Options</th>
                                            <th>Correct Answer</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($questions as $question)
                                            <tr>
                                                <td>{{ $question->question }}</td>
                                                <td>
                                                    @php
                                                        $options = is_array($question->options) ? $question->options : json_decode($question->options, true);
                                                    @endphp
                                                    @if(is_array($options))
                                                        @foreach($options as $index => $option)
                                                            <p>{{ $index + 1 }}. {{ $option }}</p>
                                                        @endforeach
                                                    @else
                                                        <p>No options available.</p>
                                                    @endif
                                                </td>
                                                <td>Option {{ $question->correct_answer }}</td>
                                                <td>
                                                    <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger delete-question" data-id="{{ $question->id }}">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No questions found for this quiz.</p>
                        @endif

                        <!-- Delete Question Modal -->
                        <div class="modal fade" id="deleteQuestionModal" tabindex="-1" role="dialog" aria-labelledby="deleteQuestionModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteQuestionModalLabel">Delete Question</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="deleteQuestionForm" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <p>Are you sure you want to delete this question?</p>
                                            <input type="hidden" name="id" id="questionId">
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete All Questions Modal -->
                        <!-- (Optional) Un-comment if you want to enable the feature -->
                        <!-- <div class="modal fade" id="deleteAllQuestionsModal" tabindex="-1" aria-labelledby="deleteAllQuestionsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteAllQuestionsModalLabel">Delete All Questions</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="deleteAllQuestionsForm" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <p>Are you sure you want to delete all questions for this quiz?</p>
                                            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Delete All</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>          
</div>
@endsection

@section('script')
<script>
    $(document).on('click', '.delete-question', function() {
        var id = $(this).data('id');
        var url = "{{ route('questions.destroy', ':id') }}".replace(':id', id);
        $('#deleteQuestionForm').attr('action', url);
        $('#questionId').val(id);
        $('#deleteQuestionModal').modal('show');
    });

    // Uncomment if you want to enable the Delete All Questions functionality
    // $(document).on('click', '#deleteAllQuestionsButton', function() {
    //     $('#deleteAllQuestionsModal').modal('show');
    // });

    // $('#deleteAllQuestionsForm').on('submit', function(e) {
    //     e.preventDefault();
    //     var form = $(this);
    //     var url = form.attr('action');
    //     $.ajax({
    //         url: url,
    //         type: 'POST',
    //         data: form.serialize(),
    //         success: function(response) {
    //             $('#deleteAllQuestionsModal').modal('hide');
    //             location.reload(); // Reload the page or handle success as needed
    //         },
    //         error: function(xhr) {
    //             console.log(xhr.responseText);
    //         }
    //     });
    // });
</script>
@endsection
