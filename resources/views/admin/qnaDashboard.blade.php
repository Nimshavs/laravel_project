@extends('admin-layout')

@section('space-work')
    <h2 class="mb-4">Q&A</h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQnaModal">
        Add Q&A
    </button>
    <br><br>

    <table class="table">
        <thead>
            <th>#</th>
            <th>Questions</th>
            <th>Answers</th>
        </thead>
        <tbody>
            @if (count($questions) > 0)
                @foreach ($questions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td>{{ $question->question }}</td>
                        <td>
                            <a href="#" class="ansButton" data-id="{{ $question->id }}" data-toggle="modal"
                                data-target="#showAnsModal">See Answers</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr colspan="3">Questions and Answers not found!</tr>
            @endif
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="addQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Q&A</h5>

                    <button id="addAnswer" class="ml-5 btn btn-info">Add Answer</button>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addQna">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="w-100" name="question" placeholder="Enter Question" required>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <span class="error text-danger"></span>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Show Answer Modal -->
    <div class="modal fade" id="showAnsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Show Answer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Answer</th>
                            <th>Is Correct</th>
                        </thead>
                        <tbody class="showAnswers">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <span class="error text-danger"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            //form submit
            $("#addQna").submit(function(e) {
                e.preventDefault();

                if ($(".answers").length < 4) {
                    $(".error").text("Please add minimum four answers")
                    setTimeout(function() {
                        $(".error").text("");
                    }, 2000);
                } else {

                    var checkIsCorrect = false;

                    for (let i = 0; i < $(".is_correct").length; i++) {
                        if ($(".is_correct:eq(" + i + ")").prop('checked') == true) {
                            checkIsCorrect = true;
                            $(".is_correct:eq(" + i + ")").val($(".is_correct:eq(" + i + ")").next().find(
                                'input').val());
                        }
                    }

                    if (checkIsCorrect) {

                        var formData = $(this).serialize();
                        console.log("Susmitting");

                        $.ajax({
                            url: "{{ route('addQna') }}",
                            type: "POST",
                            data: formData,
                            success: function(data) {
                                if (data.success == true) {
                                    location.reload();
                                } else {
                                    alert(data.msg);
                                }
                            },
                            error: function(e) {
                                console.log(e);
                            }
                        });

                    } else {
                        $(".error").text("Please select one correct answer")
                        setTimeout(function() {
                            $(".error").text("");
                        }, 2000);
                    }

                }

            });

            //add answer
            $("#addAnswer").click(function() {
                if ($(".answers").length >= 6) {
                    $(".error").text("Add maximum six answers")
                    setTimeout(function() {
                        $(".error").text("");
                    }, 2000);
                } else {

                    var html = `
                        <div class="row mt-2 answers">
                            <input type="radio" name="is_correct" class="is_correct">
                            <div class="col">
                                <input type="text" class="w-100" name="answers[]" placeholder="Enter Answer" required>
                            </div>
                            <div class="col">
                                <button class="btn btn-danger removeButton">Remove</button>
                            </div>
                        </div>
                    `;
                    $("#addQna > .modal-body").append(html);
                }
            });
            $(document).on("click", ".removeButton", function() {
                $(this).parent().parent().remove();
            });

            //show answers

            $(".ansButton").click(function() {

                var questions = @json($questions);
                var qid = $(this).attr('data-id');
                var html = '';

                for (let i = 0; i < questions.length; i++) {
                    if (questions[i]['id'] == qid) {

                        var answersLength = questions[i]['answers'].length;
                        for (let j = 0; j < answersLength; j++) {

                            let is_correct = 'No';
                            if (questions[i]['answers'][j]['is_correct'] == 1) {
                                is_correct = 'Yes';
                            }

                            html += `
                                <tr>
                                    <td> ` + (j + 1) + ` </td>
                                    <td> ` + questions[i]['answers'][j]['answer'] + ` </td>
                                    <td> ` + is_correct + ` </td>
                                </tr>
                                `;
                        }
                        break;
                    }
                }

                $('.showAnswers').html(html);

            });

        });
    </script>
@endpush
