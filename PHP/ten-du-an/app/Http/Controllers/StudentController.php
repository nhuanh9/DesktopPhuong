<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'score' => 'required|numeric',
        ]);

        $student = Student::create($request->all());

        return response()->json($student, 201);
    }

    public function show($id)
    {
        $student = Student::find($id);

        if (is_null($student)) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json($student);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'score' => 'required|numeric',
        ]);

        $student = Student::find($id);

        if (is_null($student)) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->update($request->all());

        return response()->json($student);
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if (is_null($student)) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();

        return response()->json(['message' => 'Student deleted']);
    }
}
