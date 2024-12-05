@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center mt-5">
        <h1 class="display-4">Welcome to the Lecturer & Student Management System</h1>
        <p class="lead">This is your dashboard. Manage lecturers and students efficiently.</p>
    </div>

    <div class="row mt-5">
        <!-- Lecturer Management Card -->
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Manage Lecturers</h5>
                    <p class="card-text">Add, edit, and view all lecturers in the system.</p>
                    <a href="{{ route('lecturers.index') }}" class="btn btn-primary btn-lg">Go to Lecturers</a>
                </div>
            </div>
        </div>

        <!-- Student Management Card -->
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Manage Students</h5>
                    <p class="card-text">Add, edit, and view all students in the system.</p>
                    <a href="{{ route('students.index') }}" class="btn btn-secondary btn-lg">Go to Students</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
