<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Add this import
use App\Models\Student;
use Illuminate\Http\Request;
use Toastr;
use App\Models\User;
use App\Models\Post;

class StudentController extends Controller
{
    /** student add page */
    public function studentAdd()
    {
        // Get user IDs of students who are already added
        $addedStudents = Student::pluck('user_id')->toArray();

        // Fetch only users with the role 'Student' who have not been added yet
        $users = User::where('role_name', 'Student')
                    ->whereNotIn('user_id', $addedStudents)
                    ->get();
                    
        $posts = Post::all();
        
        return view('student.add-student', compact('users', 'posts'));
    }

    /** index page student list */
    public function student()
    {
        $studentList = Student::all();
        $posts = Post::all();
        return view('student.student',compact('studentList','posts'));
    }

    /** index page student grid */
    public function studentGrid()
    {
        $studentList = Student::all();
        $posts = Post::all();
        return view('student.student-grid',compact('studentList','posts'));
    }
  
    public function studentSave(Request $request)
    {
        // Validate the input data
        $request->validate([
            'full_name'   => 'required|string|max:255',
            'email'       => 'required|email|unique:students,email',
            'gender'      => 'required',
            'date_of_birth' => 'required|date',
            'blood_group' => 'required|string',
            'religion'    => 'required|string',
            'phone_number' => 'nullable|string|max:15',
            'upload'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate the photo upload
        ]);

        DB::beginTransaction();

        try {
            // Create a new student instance
            $student = new Student();
            $student->full_name = $request->full_name;
            $student->user_id = $request->student_id; // Ensure this field is correct
            $student->email = $request->email;
            $student->gender = $request->gender;
            $student->date_of_birth = $request->date_of_birth;
            $student->blood_group = $request->blood_group;
            $student->religion = $request->religion;
            $student->phone_number = $request->phone_number;

            // Handle the photo upload
            if ($request->hasFile('upload')) {
                $imageName = time() . '.' . $request->upload->extension();
                $request->upload->move(public_path('uploads/students'), $imageName);
                $student->photo = $imageName;
            }

            // Save the student to the database
            $student->save();
            DB::commit(); 

            // Send a success message and redirect
            Toastr::success('Student added successfully');
            return redirect()->route('student/add/page');
    
        } catch(\Exception $e) {
            DB::rollback(); // Rollback transaction in case of error
            Log::error('Error while saving student: ' . $e->getMessage());
            Toastr::error('Failed to add new record.', 'Error');
            return redirect()->back();
        }
    }

    /** view for edit student */
    public function studentEdit($id)
    {
        $student = Student::where('id',$id)->first();
        $posts = Post::all();
        return view('student.edit-student',compact('student','posts'));
    }

    public function studentUpdate(Request $request)
    {
        // Validate the input data
        $request->validate([
            'full_name'   => 'required|string|max:255',
            'blood_group' => 'required|string',
            'religion'    => 'required|string',
            'phone_number' => 'nullable|string|max:15',
            // 'upload'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate the photo upload
        ]);

        DB::beginTransaction();

        try {
            // Find the student by ID
            $student = Student::where('user_id', $request->user_id)->firstOrFail();

            // Update student data
            $student->full_name = $request->full_name;
            $student->blood_group = $request->blood_group;
            $student->religion = $request->religion;
            $student->phone_number = $request->phone_number;

            // Handle the photo upload if a new file is provided
            // if ($request->hasFile('upload')) {
            //     // Delete old photo if exists
            //     if ($student->photo) {
            //         $oldPhotoPath = public_path('uploads/students/' . $student->photo);
            //         if (file_exists($oldPhotoPath)) {
            //             unlink($oldPhotoPath); // Delete the old photo
            //         }
            //     }

            //     // Save new photo
            //     $imageName = time() . '.' . $request->upload->extension();
            //     $request->upload->move(public_path('uploads/students'), $imageName);
            //     $student->photo = $imageName;
            // }

            // Save updated student data
            $student->save();
            DB::commit();

            // Send a success message and redirect
            Toastr::success('Student updated successfully');
            return redirect()->route('student/list/page');
        
        } catch(\Exception $e) {
            DB::rollback(); // Rollback transaction in case of error
            Log::error('Error while updating student: ' . $e->getMessage());
            // Toastr::error('Failed to update student record.', 'Error');
            return redirect()->back();
        }
    }


    public function studentDelete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:students,id',
        ]);
    
        DB::beginTransaction();
    
        try {
            $student = Student::find($request->id);
            
            if ($student) {
                // Optionally delete the photo
                if ($student->upload) {
                    Storage::delete('student-photos/' . $student->upload);
                }
    
                $student->delete();
            }
    
            Toastr::success('Record deleted successfully!', 'Success');
            DB::commit();
            return redirect()->route('student/list');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            Toastr::error('Failed to delete record.', 'Error');
            return redirect()->back();
        }
    }
    
}
