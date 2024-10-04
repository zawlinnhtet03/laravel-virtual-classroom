<?php 
namespace App\Http\Controllers;

use App\Models\Post;
use App\Notifications\PostSharedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\JsonResponse;

class PostController extends Controller
{
    public function create()
    {
        $posts = Post::all();
        return view('posts.create', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
             'date' => 'required|date',
            'creator_name' => 'required|max:255',
            'creator_email' => 'required|email',
        ]);

        // save in post database
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->date = $request->date;
        $post->creator_name = $request->creator_name;
        $post->creator_email = $request->creator_email;
        $post->save();

//        // Notify students
//        $students = // logic to get the targeted students
//        Notification::send($students, new TeacherNotification($post, $signedLink));

        return redirect()->route('posts.index')->with('success', 'Notification created and sent successfully.');
    }

    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function share(Request $request, Post $post)
    {
        // Generate a signed URL for the 'posts.share' route with the correct post ID
        $url = URL::temporarySignedRoute(
            'posts.share',
            now()->addDays(30),
            ['post' => $post->id]
        );

        // Ensure the user IDs are valid and exist in the database
        $user_ids = [3]; // Assuming 3 is a valid user ID
        $users = User::query()->whereIn('id', $user_ids)->get();

        // Send the notification to the users
        Notification::send($users, new PostSharedNotification($post, $url));

        // Return the generated URL as a JSON response
        return new JsonResponse([
            'data' => $url,
        ]);
    }


//    public function share(Request $request, Post $post)
//{
//    $url = URL::temporarySignedRoute(
//        'posts.index', now()->addDays(30), ['post' => $post->id]
//    );
//
//    // Hardcoding your email address for testing
//    $testEmail = 'htoothetnaung295@gmail.com';
//
//    // Creating a dummy user object with the hardcoded email
//
//    // $user = User::query()->whereIn('id', $request->user_ids)->get();
//    $user = new \stdClass(); // what is stdClass?
//    $user->email = $testEmail;
//
//    // Sending the notification to the hardcoded email address
//    Notification::send($user, new PostSharedNotification($post, $url));
//
//    return new JsonResponse([
//        'data' => $url,
//    ]);
//}
}