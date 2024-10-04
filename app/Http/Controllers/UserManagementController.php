<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Save;
use Carbon\Carbon;
use App\Models\User;
use Toastr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use App\Models\Post;


class UserManagementController extends Controller
{
    /** index page */
    public function index()
    {
        $users = User::all();
        $posts = Post::all();
        return view('usermanagement.list_users',compact('users','posts'));
    }

    public function userDelete(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
        ]);

        DB::beginTransaction();

        try {
            // Optionally delete related resources or perform additional checks here

            User::where('user_id', $request->user_id)->delete();

            Toastr::success('Record deleted successfully!', 'Success');
            DB::commit();
            return redirect()->route('user/list'); // Adjust the redirect route as necessary
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            // Toastr::error('Failed to delete record.', 'Error');
            return redirect()->back();
        }
    }

    /** change password */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password'     => ['required', new MatchOldPassword],
            'new_password'         => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        DB::commit();
        Toastr::success('User change successfully :)','Success');
        return redirect()->intended('home');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone_number' => 'nullable|string|min:8|max:15|regex:/^[0-9]+$/',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Avatar validation
        ]);
    
        $user = Auth::user();
        $user->name = $request->name;
        $user->date_of_birth = $request->date_of_birth;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
    
        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('images'), $avatarName);
    
            // Delete old avatar if exists
            if ($user->avatar && file_exists(public_path('images/' . $user->avatar))) {
                unlink(public_path('images/' . $user->avatar));
            }
    
            $user->avatar = $avatarName;
        }
    
        $user->save();
    
        return redirect()->route('user/profile/page')->with('success', 'Profile updated successfully.');
    }
    
    /** user Update */
    public function userUpdate(Request $request)
    {
        DB::beginTransaction();
        try {
            if (Session::get('role_name') === 'Admin' || Session::get('role_name') === 'Super Admin')
            {
                $user_id       = $request->user_id;
                $name          = $request->name;
                $email         = $request->email;
                $role_name     = $request->role_name;
                $position      = $request->position;
                $phone         = $request->phone_number;
                $date_of_birth = $request->date_of_birth;
                $department    = $request->department;
                $status        = $request->status;
                $address       = $request->address;

                $image_name = $request->hidden_avatar;
                $image = $request->file('avatar');

                if($image_name =='photo_defaults.jpg') {
                    if ($image != '') {
                        $image_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('/images/'), $image_name);
                    }
                } else {
                    
                    if($image != '') {
                        unlink('images/'.$image_name);
                        $image_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('/images/'), $image_name);
                    }
                }
            
                $update = [
                    'user_id'       => $user_id,
                    'name'          => $name,
                    'role_name'     => $role_name,
                    'email'         => $email,
                    'position'      => $position,
                    'phone_number'  => $phone,
                    'date_of_birth' => $date_of_birth,
                    'department'    => $department,
                    'status'        => $status,
                    'avatar'        => $image_name,
                    'address'       => $address,
                ];

                User::where('user_id',$request->user_id)->update($update);
            } else {
                Toastr::error('User update fail :)','Error');
            }
            DB::commit();
            Toastr::success('User updated successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e){
            DB::rollback();
            Toastr::error('User update fail :)','Error');
            return redirect()->back();
        }
    }
}
