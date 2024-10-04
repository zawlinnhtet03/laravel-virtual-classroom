<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Jubaer\Zoom\Facades\Zoom;
use App\Models\Post;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch meetings or any data needed for the view
        $meetings = Zoom::getAllMeeting();
        $posts = Post::all();

        $upcomingMeetings = Zoom::getUpcomingMeeting();

        return view('meeting.index', compact('meetings','posts','upcomingMeetings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create a new meeting
        $meeting = Zoom::createMeeting([
            "agenda" => $request->input('agenda'),
            "topic" => $request->input('topic'),
            "type" => 2,
            "duration" => 60,
            "timezone" => 'Asia/Rangoon',
            "password" => $request->input('password'),
            "start_time" => $request->input('start_time'),
            "template_id" => $request->input('template_id'),
            "pre_schedule" => $request->input('pre_schedule'),
            "schedule_for" => $request->input('schedule_for'),
            "settings" => [
                'join_before_host' => false,
                'host_video' => false,
                'participant_video' => false,
                'mute_upon_entry' => false,
                'waiting_room' => false,
                'audio' => 'both',
                'auto_recording' => 'none',
                'approval_type' => 0,
            ],
        ]);

        // Retrieve all meetings, handling pagination
        $allMeetings = [];
        $nextPageToken = '';

        do {
            $meetings = Zoom::getAllMeeting([
                'page_size' => 30,
                'next_page_token' => $nextPageToken,
            ]);

            if (isset($meetings['data']['meetings'])) {
                $allMeetings = array_merge($allMeetings, $meetings['data']['meetings']);
            }

            $nextPageToken = $meetings['data']['next_page_token'] ?? '';
        } while (!empty($nextPageToken));


        // Redirect to the start URL to begin the meeting
        return redirect()->away($meeting['data']['start_url']);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch a specific meeting
        $meeting = Zoom::getMeeting($id);
        $posts = Post::all();

        // Return a view with the meeting data
        return view('meeting.show', compact('meeting','posts'));
    }

//    for displaying the meeting creation form
    public function create()
    {
        $posts = Post::all();
        return view('meeting.store',compact('posts')); // This should match the path of your Blade view file
    }

    // The update and destroy methods remain the same



    public function destroy(string $meetingId)
    {
        // Find the meeting by ID
        $meeting = Zoom::getMeeting($meetingId);

        if ($meeting) {
            // Delete the meeting
            Zoom::deleteMeeting($meetingId);
            Toastr::success('Deleted successfully :)','Success');
            return redirect()->route('meeting.index');
        } else {
            Toastr::error('fail, No Meeting Found :)','Error');
            return redirect()->route('meeting.index');
        
        }
    }
}
