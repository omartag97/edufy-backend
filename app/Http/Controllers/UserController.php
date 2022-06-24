<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Meeting;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    function login(Request $request){
        $cred = array('email'=>$request->email,'password'=>$request->password);
        if(Auth::attempt($cred))
        {
            return redirect('dashboard');
        }else{
            return 'Not Valid Credintial!';
        }
    }
    function register(Request $request){
        $password = $request->password;
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->save();
    }
    function getAllMeetings(){ // add $id
        $instructor = Auth::user(); // auth take the current id for the instructor
        foreach($instructor->meetings as $meeting){
        echo  'Instructor name: ' .  $meeting->user->name .  "  - " . 'Instructor id: ' . $meeting->user_id .  "  - "  . 'Course Title: ' . $meeting->courseTitle . "  - "  .
        'Meeting id: ' . $meeting->meeting_id . "  -  " . '<br>' . 'Students in the meeting are: ' . '<br>';
        $meetings = new Meeting;
        $meetings->meeting_id = $meeting->meeting_id;
        foreach($meetings->students as $student){
        echo $student->pivot->student_id . "<br>";
        }
        echo  'Number Of students in the meeting: ' . count($meetings->students) . '<br>';
        }
        echo  'Number Of meetings that instructor enters: ' . count($instructor->meetings) . '<br>';
}

}
