<?php

namespace App\Http\Controllers;

use App\Models\StudyMaterial;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Post;

class StudyMaterialController extends Controller
{
    /**
     * Display a listing of the study materials.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studyMaterials = StudyMaterial::with('subject', 'teacher')->get();
        $posts = Post::all();
        return view('study_materials.index', compact('studyMaterials', 'posts'));
    }


    public function create()
    {
        $subjects = Subject::all();
        $posts = Post::all();

        return view('study_materials.create', compact('subjects', 'posts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,txt,jpg,png', // Validate file types
            'subject_id' => 'required|exists:subjects,id',
        ]);

        // Handle file upload
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = time() . '_' . $file->getClientOriginalName(); // Add timestamp to preserve uniqueness
            $path = $file->storeAs('study_materials', $filename, 'public');
            $validated['file_path'] = $path;
        }

        $studyMaterial = new StudyMaterial($validated);
        $studyMaterial->created_by = auth()->user()->teacher->id; // Assuming the teacher is authenticated
        $studyMaterial->save();

        return redirect()->route('study_materials.index')->with('success', 'Study material created successfully.');
    }

    public function show(StudyMaterial $studyMaterial)
    {
        $posts = Post::all();

        return view('study_materials.show', compact('studyMaterial', 'posts'));
    }

    public function edit($id)
    {
        $studyMaterial = StudyMaterial::findOrFail($id);
        $posts = Post::all();
        $subjects = Subject::all();
        return view('study_materials.edit', compact('studyMaterial', 'subjects', 'posts'));
    }
    /**
     * Update the specified study material in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudyMaterial  $studyMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,txt,jpg,png',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $studyMaterial = StudyMaterial::findOrFail($id);
        $studyMaterial->title = $request->title;
        $studyMaterial->description = $request->description;
        $studyMaterial->subject_id = $request->subject_id;
        $studyMaterial->created_by = auth()->user()->teacher->id; // Assuming the teacher is authenticated
        $studyMaterial->save();

        // Handle file upload if a new file is provided
        if ($request->hasFile('file_path')) {
            if ($studyMaterial->file_path) {
                Storage::disk('public')->delete($studyMaterial->file_path);
            }

            $file = $request->file('file_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('study_materials', $filename, 'public');
            $studyMaterial->file_path = $path;
            $studyMaterial->save();
        }

        return redirect()->route('study_materials.index')->with('success', 'Study material updated successfully.');
    }

    public function destroy($id)
    {
        $studyMaterial = StudyMaterial::findOrFail($id);

        // Delete the attachment if it exists
        if ($studyMaterial->file_path) {
            Storage::delete('public/' . $studyMaterial->file_path);
        }

        $studyMaterial->delete();

        return redirect()->route('study_materials.index')->with('success', 'Assignment deleted successfully.');
    }
}
