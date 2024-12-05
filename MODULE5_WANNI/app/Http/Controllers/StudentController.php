<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        // Fetch all students along with their related lecturer data
        $students = Student::with('lecturer')->get();
        return view('students.index', compact('students'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        // Fetch all lecturers to display in the dropdown
        $lecturers = Lecturer::all();
        return view('students.create', compact('lecturers'));
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'nim' => 'required|unique:student',
            'student_name' => 'required',
            'email' => 'required|email|unique:student',
            'major' => 'required',
            'dosen_id' => 'required|exists:lecturer,id',
        ]);

        // Create a new student record
        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    // Display the specified resource
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    // Show the form for editing the specified resource
    public function edit(Student $student)
    {
        // Fetch all lecturers to display in the dropdown
        $lecturers = Lecturer::all();
        return view('students.edit', compact('student', 'lecturers'));
    }

    // Update the specified resource in storage
    public function update(Request $request, Student $student)
    {
        // Validate the incoming request
        $request->validate([
            'nim' => 'required|unique:student,nim,' . $student->id,
            'student_name' => 'required',
            'email' => 'required|email|unique:student,email,' . $student->id,
            'major' => 'required',
            'dosen_id' => 'required|exists:lecturer,id',
        ]);

        // Update the student record
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
