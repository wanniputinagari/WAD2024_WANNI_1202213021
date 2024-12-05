<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $lecturers = Lecturer::all();
        return view('lecturers.index', compact('lecturers'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('lecturers.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'lecturer_code' => 'required|unique:lecturer,lecturer_code|max:3',
            'lecturer_name' => 'required',
            'nip' => 'required|unique:lecturer,nip',
            'email' => 'required|email|unique:lecturer,email',
            'telephone_number' => 'required',
        ]);

        Lecturer::create($request->all());
        return redirect()->route('lecturers.index')->with('success', 'Lecturer created successfully.');
    }

    // Display the specified resource
    public function show(Lecturer $lecturer)
    {
        return view('lecturers.show', compact('lecturer'));
    }

    // Show the form for editing the specified resource
    public function edit(Lecturer $lecturer)
    {
        return view('lecturers.edit', compact('lecturer'));
    }   

    // Update the specified resource in storage
    public function update(Request $request, Lecturer $lecturer)
    {
        $request->validate([
            'lecturer_code' => 'required|max:3|unique:lecturer,lecturer_code,' . $lecturer->id,
            'lecturer_name' => 'required',
            'nip' => 'required|unique:lecturer,nip,' . $lecturer->id,
            'email' => 'required|email|unique:lecturer,email,' . $lecturer->id,
            'telephone_number' => 'required',
        ]);

        $lecturer->update($request->all());
        return redirect()->route('lecturers.index')->with('success', 'Lecturer updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(Lecturer $lecturer)
    {
        $lecturer->delete();
        return redirect()->route('lecturers.index')->with('success', 'Lecturer deleted successfully.');
    }
}
