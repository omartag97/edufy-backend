<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Meeting;
use App\Models\Student;

class Apicontroller extends Controller
{

    function register(Request $request)
    {
        $password = $request->password;
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->acces_token = str::random(64);
        $user->save();
        return response()->json(['acces_token' => $user->acces_token]);
    }
    function login(Request $request)
    {
        $cred = array('email' => $request->email, 'password' => $request->password);
        if (Auth::attempt($cred)) {
            if (!isset(Auth::user()->access_token)) {
                Auth::user()->access_token = str::random(64);
                Auth::user()->save;
            }
            return response()->json(['acces_token' => Auth::user()->acces_token, 'email' => Auth::user()->email, 'name' => Auth::user()->name]);
        } else {
            return 'not valid email or password';
        }
    }
    function getAllMeetings(Request $request)
    { // add $id
        $instructor = User::find($request->id);
        if ($instructor) {
            $meetings = $instructor->meetings;
            $data = [];
            foreach ($meetings as  $meeting) {
                $meeting_with_students = new Meeting;
                $students = Meeting::find($meeting->meeting_id)->students;
                $meeting_with_students->meeting_id  = $meeting->meeting_id;
                $meeting_with_students->user_id     = $meeting->user_id;
                $meeting_with_students->courseTitle = $meeting->courseTitle;
                $meeting_with_students->created_at  = $meeting->created_at;
                $meeting_with_students->updated_at  = $meeting->updated_at;
                $meeting_with_students->students    = $students;
                array_push($data, $meeting_with_students);
            }
            return response()->json(['data' => $data]);
        } else {
            return response()->json(['erorr' => 'No user found']);
        }
    }
    function create(Request $request)
    {
        Meeting::create([
            'user_id' => $request->user_id,
            'meeting_id' => $request->meeting_id,
            'courseTitle' => $request->courseTitle,
            'ended' => 0,
        ]);
        return $meetings = Meeting::with(['meetings' => function($q){
            $q->select('user_id','meeting_id');
        }]);
        return response()->json(['user_id' => $request->user_id, 'meeting_id' => $request->meeting_id, 'courseTitle' => $request->courseTitle]);
    }
    function join(Request $request)
    {
        $data = [];
        $meeting =  Meeting::find($request->meeting_id);
        if (!$meeting->ended) {
            $stundet = Student::find($request->reg_number);
            if (!$stundet) {
                Student::create([
                    'name' => $request->name,
                    'reg_number' => $request->reg_number,
                    'status' => '',
                ]);
            }


            $students = $meeting->students;
            $reg_number =  $request->reg_number;
            if (gettype($request->reg_number) == 'string') {
                $reg_number =  intval($request->reg_number);
            }

            if (count($students) > 0) {
                foreach ($students as $student) {
                    $flag = 0;
                    if ($student->pivot->student_id  === $reg_number) {
                        $flag = 1;
                        break;
                    }
                }
                if ($flag == 1) {
                    return response()->json(['error' => 'Student is already in']);
                } else {
                    $meeting = Meeting::findOrFail($request->meeting_id);
                    $meeting->students()->attach($reg_number);
                    // array_push($data,$meeting);
                    return response()->json(['data' => '1']);
                }
            } else { // edge case
                $meeting = Meeting::findOrFail($request->meeting_id);
                $meeting->students()->attach($reg_number);
                // array_push($data,$meeting);
                return response()->json(['data' => '2']);
            }
        } else {
            $error = array(
                'ended'=>$meeting->ended,
                'message'=>'meeting is ended',
            );

            return response()->json($error);
        }
    }
    function updateStatus(Request $request)
    {
        Student::find($request->reg_number)->update(['status' => $request->status]);
        return response()->json(['status' => $request->status]);
    }
    function end(Request $request)
    {

        Meeting::find($request->meeting_id)->update(['ended' => true]);
        return response()->json(['Meeting has been ended']);
    }
}
