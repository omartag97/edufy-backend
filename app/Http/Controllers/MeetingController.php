<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    function store(Request $request){
        Meeting::create([
            'user_id'=>Auth::user(),
            'meeting_id'=>$request->meeting_id,
            'courseTitle'=>$request->courseTitle,
            'ended'=>0
        ]);
    }
    function update(Request $request){
    Meeting::find($request->meeting_id)->update(['ended'=> '1']);
    }
    // function ShowStudents(Request $request){
    //     $meeting = new Meeting;
    //     $meeting->meeting_id = $request->meeting_id;
    //     foreach($meeting->students as $student){
    //     echo $student->pivot->student_id . "<br>";
    //     }
    // }
}
