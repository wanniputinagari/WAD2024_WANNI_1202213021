@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Lecturer List</h1>

    <a href="{{ route('lecturers.create') }}" class="btn btn-primary mb-3">Add Lecturer</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Lecturer Code</th>
                <th>Lecturer Name</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lecturers as $lecturer)
                <tr>
                    <td>{{ $lecturer->id }}</td>
                    <td>{{ $lecturer->lecturer_code }}</td>
                    <td>{{ $lecturer->lecturer_name }}</td>
                    <td>{{ $lecturer->email }}</td>
                    <td>{{ $lecturer->telephone_number }}</td>
                    <td>
                        <a href="{{ route('lecturers.edit', $lecturer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('lecturers.destroy', $lecturer->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
