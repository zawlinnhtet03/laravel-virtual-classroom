<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Teacher;
use Toastr;
use App\Models\Post;

class TeacherController extends Controller
{
    public function teacherAdd()
    {
        $addedTeachers = Teacher::pluck('user_id')->toArray();

        // Fetch only users with the role 'Teacher' who have not been added yet
        $users = User::where('role_name', 'Teachers')
                    ->whereNotIn('user_id', $addedTeachers)
                    ->get();
        $posts = Post::all();
        return view('teacher.add-teacher',compact('users','posts'));
    }

    public function teacherList()
    {
        $listTeacher = Teacher::join('users', 'teachers.user_id','users.user_id')
                    ->select('users.date_of_birth','users.join_date','users.phone_number','teachers.*')->get();
        $posts = Post::all();
        return view('teacher.list-teachers',compact('listTeacher','posts'));
    }

    public function saveRecord(Request $request)
    {
        $request->validate([
            'full_name'     => 'required|string',
            // 'email'       => 'required|email|unique:teachers,email',
            'gender'        => 'required|string',
            // 'date_of_birth' => 'required|date',
            'phone_number'  => 'required|string',
            'address'       => 'required|string',
            'city'          => 'required|string',
        ]);
    
        DB::beginTransaction(); // Start transaction
    
        try {
            // Saving teacher record
            $saveRecord = new Teacher;
            $saveRecord->full_name     = $request->full_name;
            $saveRecord->user_id       = $request->teacher_id;
            // $saveRecord->email         = $request->email;
            $saveRecord->gender        = $request->gender;
            // $saveRecord->date_of_birth = $request->date_of_birth;
            $saveRecord->phone_number  = $request->phone_number;
            $saveRecord->address       = $request->address;
            $saveRecord->city          = $request->city;
            $saveRecord->save();
    
            DB::commit(); // Commit transaction
    
            Toastr::success('Record has been added successfully!', 'Success');
            return redirect()->back();
    
        } catch(\Exception $e) {
            DB::rollback(); // Rollback transaction in case of error
            Log::error('Error while saving teacher: ' . $e->getMessage());
            Toastr::error('Failed to add new record.', 'Error');
            return redirect()->back();
        }
    }
    

    public function editRecord($id)
    {
        $teacher = Teacher::where('id', $id)->firstOrFail();
        $posts = Post::all(); // If needed in the view
        return view('teacher.edit-teacher', compact('teacher', 'posts'));
    }
    

    public function updateRecordTeacher(Request $request)
    {
        $request->validate([
            'full_name'     => 'required|string',
           
            'phone_number'  => 'required|string',
            'address'       => 'required|string',
            'city'          => 'required|string',
        ]);

        try {
            $teacher = Teacher::where('user_id', $request->user_id)->firstOrFail();
            $teacher->full_name     = $request->full_name;
       
            $teacher->phone_number  = $request->phone_number;
            $teacher->address       = $request->address;
            $teacher->city          = $request->city;
            $teacher->save();

            Toastr::success('Record updated successfully!', 'Success');
            return redirect()->route('teacher/list/page');
        } catch (\Exception $e) {
            Log::error($e);
            Toastr::error('Failed to update record.', 'Error');
            return redirect()->back();
        }
    }

    /** delete record */
    public function teacherDelete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:teachers,id',
        ]);

        DB::beginTransaction();

        try {
            Teacher::destroy($request->id);

            Toastr::success('Record deleted successfully!', 'Success');
            DB::commit();
            return redirect()->route('teacher/list');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            // Toastr::error('Failed to delete record.', 'Error');
            return redirect()->back();
        }
    }

    

}
