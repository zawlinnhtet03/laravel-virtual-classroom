<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\Setting;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AssignmentSubmissionController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizAttemptController;
use App\Http\Controllers\QuizSubmissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StudyMaterialController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** for side bar menu active */
function set_active( $route ) {
    if( is_array( $route ) ){
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}

// landing page route HTN
Route::get('/', function () {
    return view('landing_page.index');
    // auth.login ko top htae pay ya owin ml

});

Route::get('/login', function () {

    $posts = App\Models\Post::all();
    return view('auth.login',compact('posts'));
    // auth.login ko top htae pay ya owin ml

});

Route::get('/blog1', function(){
    return view('landing_page.blog1');
});

Route::get('/blog2', function(){
    return view('landing_page.blog2');
});

Route::get('/blog3', function(){
    return view('landing_page.blog3');
});


Route::get('/blog3', function(){
    return view('landing_page.blog3');
});


Route::get('/faq', function(){
    return view('landing_page.faq');
});

Route::get('/future_update', function(){
    return view('landing_page.future_update');
});




Route::group(['middleware'=>'auth'],function()
{
    Route::get('home',function()
    {
        return view('home');
    });
    Route::get('home',function()
    {
        return view('home');
    });
});

Auth::routes();
Route::group(['namespace' => 'App\Http\Controllers\Auth'],function()
{
    // ----------------------------login ------------------------------//
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate');
        Route::get('/logout', 'logout')->name('logout');
        Route::post('change/password', 'changePassword')->name('change/password');
    });

    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('/forgot-password', 'showForgotPasswordForm')->name('forgot-password');
        Route::post('/forgot-password', 'sendResetOtp')->name('forgot-password.send-otp');
        Route::get('/reset-password', 'showResetPasswordForm')->name('reset-password.form');
        Route::post('/reset-password', 'resetPassword')->name('reset-password');
    });

    // ----------------------------- register -------------------------//
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('/register','storeUser')->name('register'); 
        Route::get('/verify-otp','showOtpVerificationForm')->name('verify-otp');
        Route::post('/verify-otp','verifyOtp')->name('verify-otp.post'); 
        Route::post('/resend-otp', 'resendOtp')->name('resend-otp');
 
    });
});

Route::group(['namespace' => 'App\Http\Controllers'],function()
{
    // -------------------------- main dashboard ----------------------//
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->middleware('auth')->name('home');
        Route::get('user/profile/page', 'userProfile')->middleware('auth')->name('user/profile/page');
        Route::get('teacher/dashboard', 'teacherDashboardIndex')->middleware('auth')->name('teacher/dashboard');
        Route::get('student/dashboard', 'studentDashboardIndex')->middleware('auth')->name('student/dashboard');

        Route::get('profile/edit', 'editProfile')->middleware('auth')->name('profile.edit');
    });

     // ------------------------ setting -------------------------------//
     Route::controller(Setting::class)->group(function () {
        Route::get('setting/page', 'index')->middleware('auth')->name('setting/page');
    });

    // ----------------------------- user controller ---------------------//
    Route::controller(UserManagementController::class)->group(function () {
        Route::get('list/users', 'index')->middleware('auth')->name('list/users');

        Route::post('change/password', 'changePassword')->name('change/password');
        Route::get('view/user/edit/{id}', 'userView')->middleware('auth');
        Route::post('user/update', 'userUpdate')->name('user/update');
        
        Route::get('get-users-data', 'getUsersData')->name('get-users-data'); /** get all data users */
  
        Route::post('profile/update', 'updateProfile')->name('profile.update');

        Route::delete('user/delete', 'userDelete')->name('user/delete');
    });

    // ------------------------ teacher -------------------------------//
    Route::controller(TeacherController::class)->group(function () {
        Route::get('teacher/add/page', 'teacherAdd')->middleware('auth')->name('teacher/add/page'); 
        Route::get('teacher/list/page', 'teacherList')->middleware('auth')->name('teacher/list/page');  
        Route::post('teacher/save', 'saveRecord')->middleware('auth')->name('teacher/save'); 
        Route::get('teacher/edit/{id}', 'editRecord')->name('teacher/edit'); 
        Route::post('teacher/update', 'updateRecordTeacher')->middleware('auth')->name('teacher/update'); 
        Route::delete('teacher/delete', 'teacherDelete')->name('teacher/delete'); 
    });


    // ------------------------ student -------------------------------//
    Route::controller(StudentController::class)->group(function () {
        Route::get('student/list', 'student')->middleware('auth')->name('student/list'); // list student
 
        Route::get('student/add/page', 'studentAdd')->middleware('auth')->name('student/add/page'); // page student
        Route::post('student/add/save', 'studentSave')->name('student/add/save'); // save record student
        Route::get('student/edit/{id}', 'studentEdit')->name('student/edit'); // view for edit
        Route::post('student/update', 'studentUpdate')->name('student/update'); // update record student
        Route::delete('student/delete', 'studentDelete')->name('student/delete'); // delete record student
        Route::get('student/profile/{id}', 'studentProfile')->middleware('auth'); // profile student
    });

    // ----------------------- subject -----------------------------//
    Route::controller(SubjectController::class)->group(function () {
        Route::get('subject/list/page', 'subjectList')->middleware('auth')->name('subject/list/page'); // subject/list/page
        Route::get('subject/add/page', 'subjectAdd')->middleware('auth')->name('subject/add/page'); // subject/add/page
        Route::post('subject/save', 'saveRecord')->name('subject/save'); // subject/save
        Route::post('subject/update','updateRecord')->name('subject/update');

        Route::post('subject/delete', 'deleteRecord')->name('subject/delete'); // subject/delete
        Route::get('subject/edit/{subject_id}', 'subjectEdit'); // subject/edit/page
    });

    // ----------------------- assignments ----------------------------//
    Route::controller(AssignmentController::class)->group(function () {
        Route::get('assignments', 'index')->middleware('auth')->name('assignments.index'); // assignments
        Route::get('assignments/submissions', 'submissions')->middleware('auth')->name('assignments.submissions'); // assignment submissions
        Route::get('assignments/create', 'create')->middleware('auth')->name('assignments.create'); // assignments/create
        Route::post('assignments', 'store')->middleware('auth')->name('assignments.store'); // assignments
        Route::get('assignments/{id}', 'show')->middleware('auth')->name('assignments.show');
        Route::get('assignments/{id}/edit', 'edit')->middleware('auth')->name('assignments.edit'); // assignments/{id}/edit
        Route::put('assignments/{id}', 'update')->middleware('auth')->name('assignments.update'); // assignments/{id}
        Route::delete('assignments/{id}', 'destroy')->middleware('auth')->name('assignments.destroy'); // assignments/{id}      
    });

    Route::controller(AssignmentSubmissionController::class)->group(function () {
        Route::post('assignments/{assignmentId}/submit', 'store')->middleware('auth')->name('assignments.submit'); // assignments/{assignmentId}/submit
        Route::get('assignment_submissions/{id}', 'show')->middleware('auth')->name('assignment_submissions.show'); // assignment_submissions/{id}
        Route::get('assignment_submissions/{id}/edit', 'edit')->middleware('auth')->name('assignment_submissions.edit'); // assignment_submissions/{id}/edit
        Route::put('assignment_submissions/{id}', 'update')->middleware('auth')->name('assignment_submissions.update'); // assignment_submissions/{id}
        Route::delete('assignment_submissions/{id}', 'destroy')->middleware('auth')->name('assignment_submissions.destroy'); // assignment_submissions/{id}
    });

    // ----------------------- quizzes ----------------------------//
    Route::controller(QuizController::class)->group(function () {
        Route::get('quizzes', 'index')->middleware('auth')->name('quizzes.index');
        Route::get('quizzes/create', 'create')->middleware('auth')->name('quizzes.create');
        Route::post('quizzes', 'store')->middleware('auth')->name('quizzes.store');
        Route::get('quizzes/{id}/edit', 'edit')->middleware('auth')->name('quizzes.edit');
        Route::put('quizzes/{id}', 'update')->middleware('auth')->name('quizzes.update');
        // Route::get('quizzes/{id}', 'show')->name('quizzes.show');
        Route::delete('quizzes/{id}', 'destroy')->middleware('auth')->name('quizzes.destroy');
        Route::get('quizzes/submissions', 'submissions')->middleware('auth')->name('quizzes.submissions');
        Route::get('quizzes/{attempt}/results', 'results')->middleware('auth')->name('quizzes.results');
    });

    Route::controller(QuestionController::class)->group(function () {
        Route::get('quizzes/{quiz}/questions/create', 'create')->middleware('auth')->name('questions.create');
        Route::get('quizzes/{quiz}/questions', 'index')->middleware('auth')->name('questions.index');
        Route::post('quizzes/{quiz}/questions', 'store')->middleware('auth')->name('questions.store');
        Route::get('questions/{question}/edit', 'edit')->middleware('auth')->name('questions.edit');
        Route::put('questions/{question}', 'update')->middleware('auth')->name('questions.update');
        Route::delete('questions/{id}', 'destroy')->middleware('auth')->name('questions.destroy');
        // Route::delete('questions/delete-all', 'deleteAll')->name('questions.deleteAll');
    });

    Route::controller(QuizAttemptController::class)->group(function () {
        Route::get('/quizzes/{quiz}/start', 'start')->middleware('auth')->name('quizzes.start');
        Route::post('/quiz_attempts/{attempt}/submit', 'submit')->middleware('auth')->name('quiz_attempts.submit');
    });

    Route::get('quiz_submissions', [QuizSubmissionController::class, 'index'])->middleware('auth')->name('quiz_submissions.index');

    Route::controller(StudyMaterialController::class)->group(function () {
        Route::get('study_materials', 'index')->middleware('auth')->name('study_materials.index');
        Route::get('study_materials/create', 'create')->middleware('auth')->name('study_materials.create');
        Route::post('study_materials', 'store')->middleware('auth')->name('study_materials.store');
        Route::get('study_materials/{id}', 'show')->middleware('auth')->name('study_materials.show');
        Route::get('study_materials/{id}/edit', 'edit')->middleware('auth')->name('study_materials.edit');
        Route::put('study_materials/{id}', 'update')->middleware('auth')->name('study_materials.update');
        Route::delete('study_materials/{id}', 'destroy')->middleware('auth')->name('study_materials.destroy');
    });

    
    Route::get('no-access', function() {
        $posts = Post::all();
        return view('no-access',compact('posts'));
    })->name('no-access');


    // ----------------------- meeting ----------------------------//
//    HTN (this is https://github.com/JubaerHossain/zoom-laravel/blob/master/README.md api implementation code


Route::controller(MeetingController::class)->group(function () {
    Route::get('/meetings', [MeetingController::class, 'index'])->name('meeting.index');

      // for displaying store.blade.php file (meeting creation form)
    Route::get('/meetings/create', [MeetingController::class, 'create'])->name('meeting.create');

      // for displaying show.blade.php file (each meeting details)
    Route::get('/meetings/{id}', [MeetingController::class, 'show'])->name('meeting.show');

    // this is for submitting the form data to the store method
    Route::post('/meetings/store', [MeetingController::class, 'store'])->name('meeting.store');

        // for displaying edit.blade.php file (meeting edit form)
    Route::get('/meetings/{id}/edit', [MeetingController::class, 'update'])->name('meeting.edit');

    // for deleting meeting
    Route::delete('/meetings/{id}', [MeetingController::class, 'destroy'])->name('meeting.destroy');
});

// Notifications by HTN 

Route::controller(PostController::class)->group(function () {

    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');


    Route::get('/posts/{post}/share', [PostController::class, 'share'])->name('posts.share');
});

    
    Route::get('/', function () {
        return view('landing_page.index');
        // auth.login ko top htae pay ya owin ml

    });

    
    Route::get('/blog1', function(){
        return view('landing_page.blog1');
    });

    Route::get('/blog2', function(){
        return view('landing_page.blog2');
    });

    Route::get('/blog3', function(){
        return view('landing_page.blog3');
    });


    Route::get('/blog3', function(){
        return view('landing_page.blog3');
    });



});