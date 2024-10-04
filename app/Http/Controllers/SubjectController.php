<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\Post;

use Toastr;

class SubjectController extends Controller
{
    /** index page */
    public function subjectList()
    {
        $subjectList = Subject::all();
        $posts = Post::all();
        return view('subjects.subject_list',compact('subjectList','posts'));
    }

    /** subject add */
    public function subjectAdd()
    {
        $posts = Post::all();
        return view('subjects.subject_add',compact('posts'));
    }

    public function saveRecord(Request $request)
    {
        try {
            $request->validate([
                'subject_id'    => 'required|string|unique:subjects,subject_id',
                'subject_name'  => 'required|string|unique:subjects,subject_name',
            ]);

            DB::beginTransaction();
            try {
                $saveRecord = new Subject;
                $saveRecord->subject_id      = $request->subject_id;
                $saveRecord->subject_name    = $request->subject_name;
                $saveRecord->save();
                
                DB::commit();
                Toastr::success('Subject has been added successfully :)', 'Success');         
                return redirect()->back();
            } catch(\Exception $e) {
                Log::info($e);
                DB::rollback();
                Toastr::error('Failed to add new subject :)', 'Error');
                return redirect()->back();
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // If validation fails, catch the exception and show a message
            Toastr::error('This subject already exists!', 'Error');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /** subject edit view */
    public function subjectEdit($subject_id)
    {
        $subjectEdit = Subject::where('subject_id',$subject_id)->first();
        $posts = Post::all();
        return view('subjects.subject_edit',compact('subjectEdit','posts'));
    }

    public function updateRecord(Request $request)
    {
        try {
            $request->validate([
                'subject_name'  => 'required|string|unique:subjects,subject_name,' . $request->subject_id . ',subject_id',
            ]);
    
            DB::beginTransaction();
            try {
                // Find the subject by subject_id
                $subject = Subject::where('subject_id', $request->subject_id)->firstOrFail();
                
                // Update subject name
                $subject->subject_name = $request->subject_name;
                $subject->save();
    
                DB::commit();
                Toastr::success('Subject has been updated successfully :)', 'Success');
                return redirect()->back();
            } catch (\Exception $e) {
                Log::info($e);
                DB::rollback();
                Toastr::error('Failed to update the subject :)', 'Error');
                return redirect()->back();
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // If validation fails, catch the exception and show a message
            Toastr::error('This subject name already exists!', 'Error');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }
    

    /** delete record */
    public function deleteRecord(Request $request)
    {
        DB::beginTransaction();
        try {

            Subject::where('subject_id',$request->subject_id)->delete();
            DB::commit();
            Toastr::success('Deleted record successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Deleted record fail :)','Error');
            return redirect()->back();
        }
    }

}
