<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignmentSubmission;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class AssignmentSubmissionController extends Controller
{
    public function index()
    {
        $assignments = Assignment::all(); // Fetch all assignments
        // $submissions = AssignmentSubmission::where('student_id', auth()->id())->get(); // Fetch all student submissions
        $submissions = AssignmentSubmission::all();
        $posts = Post::all();
        return view('assignments.index', compact('assignments', 'submissions','posts'));
    }

    public function submissions($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);
        $submissions = AssignmentSubmission::all();
        $posts = Post::all();
        // $submissions = AssignmentSubmission::with('student')->where('assignment_id', $assignmentId)->get();
        return view('assignments.submissions', compact('assignment', 'submissions','posts'));
    }

    public function edit($id)
    {
        $submission = AssignmentSubmission::findOrFail($id);
        $assignment = Assignment::findOrFail($submission->assignment_id);
        $posts = Post::all();
    
        return view('assignment_submissions.edit', compact('submission', 'assignment','posts'));
    }

    public function show($id)
    {
        $assignment = Assignment::findOrFail($id);
        $posts = Post::all();
        $studentId = auth()->user()->student->id;
        
        // Get the submission for the logged-in student (if any)
        $submission = AssignmentSubmission::where('assignment_id', $id)
                                          ->where('student_id', $studentId)
                                          ->first();
    
        if ($submission) {
            // If a submission exists, redirect to edit submission
            return redirect()->route('assignment_submissions.edit', $submission->id);
        }

        return view('assignments.show', compact('assignment', 'submission','posts'));
    }

    public function store(Request $request, $assignmentId)
    {
        // Validate the request
        $validated = $request->validate([
            'attachment' => 'required|file|mimes:pdf,doc,docx,zip,jpg,png|max:10240', // 10MB max
            'comments' => 'nullable|string|max:1000',
        ]);

        // Find the assignment
        $assignment = Assignment::findOrFail($assignmentId);

        // Check if the student has already submitted this assignment
        $existingSubmission = AssignmentSubmission::where('assignment_id', $assignmentId)
            ->where('student_id', Auth::id())
            ->first();

        // if ($existingSubmission) {
        //     return redirect()->back()->withErrors(['You have already submitted this assignment.']);
        // }

        // Handle file upload
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = Auth::user()->student->id . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('assignments/submissions', $filename, 'public');
        }

        // Create new submission record
        $submission = new AssignmentSubmission();
        $submission->assignment_id = $assignment->id;
        $submission->student_id = auth()->user()->student->id;
        // $submission->student_name = auth()->user()->student->full_name;
        $submission->file_path = $path ?? null;
        $submission->submitted_at = now();
        $submission->feedback = $request->comments;
        $submission->save();

        return redirect()->route('assignments.index', $assignment->id)->with('success', 'Assignment submitted successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'comments' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,zip,jpg,png|max:10240',
            'grade' => 'nullable|numeric|min:0|max:100',
        ]);

        // Ensure only the student who submitted can update it
        // if ($submission->student_id !== auth()->id()) {
        //     return redirect()->back()->with('error', 'Unauthorized access');
        // }
    
        // Find the submission or fail if not found
        $submission = AssignmentSubmission::findOrFail($id);

        if ($request->filled('grade')) {
            $submission->grade = $request->grade;
        }  
        $submission->feedback = $request->input('feedback');    
    
        // Handle the attachment file if provided
        if ($request->hasFile('attachment')) {
            // Delete the old attachment if it exists
            if ($submission->attachment) {
                Storage::delete('public/' . $submission->attachment);
            }
    
            // Store the new attachment with original filename
            $file = $request->file('attachment');
            $filename = $file->getClientOriginalName(); // Get the original file name
            $submission->file_path = $file->storeAs('assignment/submissions', $filename, 'public');
        }
        $submission->save();
    
        // Redirect back to the assignment detail page with a success message
        return redirect()->route('assignments.index', $submission->id)
                         ->with('success', 'Submission updated successfully.');
    }

    public function destroy($id)
    {
        $submission = AssignmentSubmission::findOrFail($id);

        if ($submission->attachment) {
            Storage::delete('public/' . $submission->attachment);
        }

        $submission->delete();

        return redirect()->route('assignments.submissions')->with('success', 'Submission deleted successfully.');
    }
    // Ensure only the student who submitted can edit it
        // if ($submission->student_id !== auth()->id()) {
        //     return redirect()->back()->with('error', 'Unauthorized access');
        // }   
}

