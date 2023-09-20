@extends('admin-layout')

@section('space-work')
    <h2 class="mb-4">Q&A</h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQnaModal">
        Add Q&A
    </button>
    <br><br>

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

                }

            });

            //add answer
            if ($(".answers").length >= 6) {
                $(".error").text("Add maximum six answers")
                setTimeout(function() {
                    $(".error").text("");
                }, 2000);
            } else {
                $("#addAnswer").click(function() {
                    var html = `
                        <div class="row mt-2 answers">
                            <input type="radio" name="is_correct" class="is_correct">
                            <div class="col">
                                <input type="text" class="w-100" name="answers[]" placeholder="Enter Answer" required>
                            </div>
                            <div class="col">
                                <button class="btn btn-danger">Remove</button>
                            </div>
                        </div>
                    `;
                    $(".model-body").append(html);
                });

            }
        });
    </script>
@endpush
