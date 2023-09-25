@extends('admin-layout')

@section('space-work')
    <h2 class="mb-4">Exams</h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addExamModel">
        Add Exam
    </button>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Exam Name</th>
                <th>Add Question</th>
                <th>Delete</th>

            </tr>
        </thead>

        <tbody>
            @if (count($exams) > 0)
                @foreach ($exams as $key => $exam)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $exam->exams_name }}</td>
                        <td>
                            <a href="#" class="addQuestion" data-id="{{ $exam->id }}" data-toggle="modal"
                                data-target="#addQnaModal">Add
                                Question</a>
                        </td>
                        <td>
                            <button class="btn btn-danger deleteButton" data-id="{{ $exam->id }}" data-toggle="modal"
                                data-target="#deleteExamModal">Delete</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">Exams not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="addExamModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Exam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addExam">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="exams_name" placeholder="Enter Exam name" class="w-100" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Delete Exam Modal -->
    <div class="modal fade" id="deleteExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Exam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deleteExam">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="exam_id" id="deleteExamId">
                        <p>Are you sure you want to delete the exam</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Add Answer Modal -->
    <div class="modal fade" id="addQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Q&A</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addQna">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="exam_id" id="addExamId">
                        <input type="search" name="search" class="w-100" placeholder="Search here">
                        <br><br>
                        <table class="table">
                            <thead>
                                <th>Select</th>
                                <th>Question</th>
                            </thead>
                            <tbody class="addBody"></tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Q&A</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#addExam").submit(function(e) {
                e.preventDefault();
                console.log("Submitted");
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('addExam') }}",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        if (data.success == true) {
                            location.reload();
                        } else {
                            alert(data.msg);
                        }
                    }
                });
            });

            //add question
            $('.addQuestion').click(function() {

                var id = $(this).attr('data-id');
                $('#addExamId').val(id);

                $.ajax({
                    url: "{{ route('getQuestions') }}",
                    type: "GET",
                    data: {
                        exam_id: id
                    },
                    success: function(data) {
                        if (data.success == true) {

                            var questions = data.data;
                            var html = '';
                            if (questions.length > 0) {
                                for (let i = 0; i < questions.length; i++) {
                                    html += `
                                    <tr>
                                        <td> <input type="checkbox" value="` + questions[i]['id'] + `" name="questions_id[]"/></td>
                                        <td>` + questions[i]['questions'] + `</td>
                                    </tr>
                                    `;
                                }
                            } else {
                                html += `
                                <tr>
                                    <td colspan="2">Questions not found</td>
                                </tr>
                                `;
                            }

                            $('.addBody').html(html);
                        } else {
                            alert(data.msg);
                        }
                    }
                });
            });

            $("#addQna").submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('addQuestions') }}",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        console.log(data);
                        if (data.success == true) {
                            location.reload();
                        } else {
                            alert(data.msg);
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });

            });

            $(".deleteButton").click(function() {
                var id = $(this).attr('data-id');
                $("#deleteExamId").val(id);
            });

            $("#deleteExam").submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('deleteExam') }}",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        if (data.success == true) {
                            location.reload();
                        } else {
                            alert(data.msg);
                        }
                    }
                });

            });

        });
    </script>
@endpush
