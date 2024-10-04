<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class AssignmentController extends Controller
{
    public function index()
    {    
        $assignments = Assignment::all();

        $posts = Post::all();

        return view('assignments.index', compact('assignments','posts')); 
    }

    // public function checkTeacherAccess()
    // {
    //     // Check if the logged-in user is a teacher and exists in the 'teachers' table
    //     $user = auth()->user();
    //     $posts = Post::all();

    //     if ($user->role_name === 'Teachers' && !Teacher::where('user_id', $user->id)->exists()) {
    //         return redirect()->route('no-access')->with('message', 'Please contact the admin to gain access to the assignments feature.');
    //     }

    //     // Proceed if the teacher exists
    //     return view('assignments.index', compact('posts'));
    // }



    public function submissions()
    {
        $assignments = Assignment::all();
        $posts = Post::all();
       
        return view('assignments.submissions', compact('assignments','posts'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $posts = Post::all();
        return view('assignments.create', compact('subjects','posts'));
    }

    public function show($id)
    {
        $assignment = Assignment::findOrFail($id);
        $posts = Post::all();
        return view('assignments.show', compact('assignment','posts'));
    }

    public function edit($id)
    {
        $assignment = Assignment::findOrFail($id);
        $subjects = Subject::all();
        $posts = Post::all();
        return view('assignments.edit', compact('assignment', 'subjects','posts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'subject_id' => 'required|integer',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,zip,jpg,png', // Validate attachment
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = $file->getClientOriginalName(); // Preserve original filename with timestamp
            $path = $file->storeAs('', $filename, 'public');
            $validated['attachment'] = $path;
        }

        $assignment = new Assignment($validated);
        $assignment->created_by = auth()->user()->teacher->id;
        $assignment->save();

        return redirect()->route('assignments.index')->with('success', 'Assignment created successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'subject_id' => 'required|exists:subjects,id',
            'attachment' => 'nullable|file|max:10240'
        ]);

        $assignment = Assignment::findOrFail($id);
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->due_date = $request->due_date;
        $assignment->subject_id = $request->subject_id;

        if ($request->hasFile('attachment')) {
            // Delete the old attachment if it exists
            if ($assignment->attachment) {
                Storage::delete('public/' . $assignment->attachment);
            }
            $file = $request->file('attachment');
            $filename = $file->getClientOriginalName(); // Preserve original filename with timestamp
            $assignment->attachment = $file->storeAs('', $filename, 'public');
            $validated['attachment'] = $assignment->attachment;         
        }

        $assignment->save();

        return redirect()->route('assignments.index')->with('success', 'Assignment updated successfully.');
    }

    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);
        
        // Delete the attachment if it exists
        if ($assignment->attachment) {
            Storage::delete('public/' . $assignment->attachment);
        }

        $assignment->delete();

        return redirect()->route('assignments.index')->with('success', 'Assignment deleted successfully.');
    }

    public function resetAssignmentsTable()
    {
        DB::table('assignments')->truncate(); // Deletes all records and resets auto-increment
        DB::statement('ALTER TABLE assignments AUTO_INCREMENT = 1');

        return redirect()->route('assignments.index')->with('success', 'Assignments table has been reset.');
    }
}

