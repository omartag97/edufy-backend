<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    function store(Request $request)
    {
        Student::create([
            'name' => $request->student_name,
            'reg_number' => $request->reg_number,
            'status' => $request->status,
        ]);
    }

    function add(Request $request)
    {
        $meeting = new Meeting;
        $meeting->meeting_id = $request->meeting_id;
        $students = $meeting->students;
        if (gettype($request->reg_number) == 'string') {
            $reg_number =  intval($request->reg_number);
        }
        if (count($students) > 0) {
            $flag = 0;
            foreach ($students as $student) {
                if ($student->pivot->student_id  === $reg_number) {
                    $flag = 1;
                    break;
                }
            }
            if ($flag == 1) {
                echo "Student is already in!";
            } else {
                $meeting = Meeting::findOrFail($request->meeting_id);
                $meeting->students()->attach($reg_number);
                echo "success!";
            }
        } else { // edge case
            $meeting = Meeting::findOrFail($request->meeting_id);
            $meeting->students()->attach($reg_number);
            echo "success!!!!!!!!!!!";
        }
    }
    function update(Request $request){
        Student::find($request->reg_number)->update(['status'=> $request->status]);
    }
}
