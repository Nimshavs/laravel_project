@extends('admin-layout')

@section('space-work')
    <h2 class="mb-4">Students</h2>

    <table class="table">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
        </thead>
        <tbody>
            @if (count($students) > 0)
                @foreach ($students as $key => $student)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                    </tr>
                @endforeach
            @else
                <tr colspan="3">Students not found!</tr>
            @endif
        </tbody>
    </table>
@endsection
