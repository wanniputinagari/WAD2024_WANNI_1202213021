@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Student</h2>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nim">NIM</label>
            <input type="text" name="nim" id="nim" class="form-control"
                   value="{{ old('nim', $student->nim) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="student_name">Student Name</label>
            <input type="text" name="student_name" id="student_name" class="form-control"
                   value="{{ old('student_name', $student->student_name) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control"
                   value="{{ old('email', $student->email) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="major">Major</label>
            <input type="text" name="major" id="major" class="form-control"
                   value="{{ old('major', $student->major) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="dosen_id">Guardian Lecturer</label>
            <select name="dosen_id" id="dosen_id" class="form-control" required>
                <option value="">Select Lecturer</option>
                @foreach ($lecturers as $lecturer)
                    <option value="{{ $lecturer->id }}"
                        {{ old('dosen_id', $student->dosen_id) == $lecturer->id ? 'selected' : '' }}>
                        {{ $lecturer->lecturer_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Student</button>
    </form>
</div>
@endsection
