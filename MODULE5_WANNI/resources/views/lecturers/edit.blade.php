@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Lecturer</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('lecturers.update', $lecturer->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="lecturer_code" class="form-label">Lecturer Code</label>
                            <input type="text" name="lecturer_code" class="form-control" id="lecturer_code" value="{{ $lecturer->lecturer_code }}" maxlength="3" required>
                        </div>

                        <div class="mb-3">
                            <label for="lecturer_name" class="form-label">Lecturer Name</label>
                            <input type="text" name="lecturer_name" class="form-control" id="lecturer_name" value="{{ $lecturer->lecturer_name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" name="nip" class="form-control" id="nip" value="{{ $lecturer->nip }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ $lecturer->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="telephone_number" class="form-label">Telephone Number</label>
                            <input type="text" name="telephone_number" class="form-control" id="telephone_number" value="{{ $lecturer->telephone_number }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Lecturer</button>
                        <a href="{{ route('lecturers.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
