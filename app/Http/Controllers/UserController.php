<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $request->user();
        $data = $request->data;
        $phone = $data['phone'];
        User::find($user->id)->update([
            'phone' => $phone,
        ]);
        $user = User::find($user->id);
        return UserController::getRelation($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getRelation(User $user){
        // get data relation with the user (department, class ,....)
        if ($user->user_type == 1) { //get info of student
            $student = $user->student;
            if ($student) {
                $class = $student->activityClass;
                if ($class) {
                    $class->department;
                }
            };
        } else { //get info of lecture
            $lecturer = $user->lecturer;
            if ($lecturer) {
                $lecturer->department;
                $lecturer->degree;
            }
        }
        return $user;
    }

    public function getUnSubmitAssignmentsOfUser(Request $request){
        $user = $request->user();
        // if($user->user_type == 2){
            //     return response(['message' => 'Forbidden'], 403);
            // }
            $student_id= $user->id;
        $result =DB::select('SELECT s.id as student_id, r.* FROM students s 
        INNER JOIN enrollments e ON s.id = e.student_id
        INNER JOIN courses c ON e.course_id = c.id 
        INNER JOIN topics t ON t.course_id = c.id 
        INNER JOIN resources r ON r.topic_id = t.id 
        where not EXISTS (
            SELECT asm.assignment_id from assignment_submissions  asm
            WHERE asm.assignment_id = r.id 
        )AND r.resource_type = 4 AND s.id = ?', [$student_id]);
        return $result;

    }
}
