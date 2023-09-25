@extends('student-layout')

@section('space-work')
    <h2>Exam</h2>
    <table class="table">
        <thead>
            <th>#</th>
            <th>Exam Name</th>
            <th>Copy Link</th>
        </thead>
        <tbody>
            @if ($exams != null && count($exams) > 0)
                @php
                    $count = 1;
                @endphp
                @foreach ($exams as $exam)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $exam->exams_name }}</td>
                        <td><a href="#" data-code="{{ $exam->entrance_id }}" class="copy"><i class="fa fa-copy"></i></a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">No Exams Available! </td>
                </tr>
            @endif
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.copy').click(function() {
                $(this).parent().prepend('<span class="copied_text">Copied</span>');

                var code = $(this).attr('data-code');
                var url = "{{ URL::to('/') }}/exam/" + code;

                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(url).select();
                document.execCommand("copy");
                $temp.remove();

                setTimeout(() => {
                    $('.copied_text').remove();
                }, 1000);
            });
        });
    </script>

@endsection
