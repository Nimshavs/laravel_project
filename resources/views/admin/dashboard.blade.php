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

            </tr>
        </thead>

        <tbody>
            @if (count($exams) > 0)
                @foreach ($exams as $exam)
                    <tr>
                        <td>{{ $exam->id }}</td>
                        <td>{{ $exam->exams_name }}</td>
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
    <script>
        $(document).ready(function() {
            $("#addExam").submit(function(e) {
                e.preventDefault();

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
        });
    </script>
@endsection
