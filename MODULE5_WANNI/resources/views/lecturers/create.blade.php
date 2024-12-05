@extends('layouts.app')

@section('content')
    <h1 class="mb-4">{{ isset($lecturer) ? 'Edit Lecturer' : 'Add Lecturer' }}</h1>

    <form action="{{ isset($lecturer) ? route('lecturers.update', $lecturer->id) : route('lecturers.store') }}" method="POST">
        @csrf
        @if(isset($lecturer))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="lecturer_code" class="form-label">Lecturer Code</label>
            <input type="text" class="form-control" id="lecturer_code" name="lecturer_code" value="{{ old('lecturer_code', $lecturer->lecturer_code ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="lecturer_name" class="form-label">Lecturer Name</label>
            <input type="text" class="form-control" id="lecturer_name" name="lecturer_name" value="{{ old('lecturer_name', $lecturer->lecturer_name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $lecturer->email ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip', $lecturer->nip ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="telephone_number" class="form-label">Telephone Number</label>
            <input type="text" class="form-control" id="telephone_number" name="telephone_number" value="{{ old('telephone_number', $lecturer->telephone_number ?? '') }}">
        </div>

        <button type="submit" class="btn btn-success">{{ isset($lecturer) ? 'Update Lecturer' : 'Add Lecturer' }}</button>
    </form>
@endsection
