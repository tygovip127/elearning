<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topics = Topic::all();
        return response()->json($topics, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = $request->user();
            if ($user->user_type == 1) {
                return response(['message' => 'Forbidden'], 403);
            }
            $name = $request->input('name');
            $course_id = $request->input('course_id');
            $topic = Topic::create([
                'name' => $name,
                'course_id' => $course_id,
            ]);
            DB::commit();
            return $topic;
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        //
    }

    public function getTopicsByCourse(Request $request){
        $courseID= $request->input('courseID');
        $topics = Topic::where('course_id', $courseID)->get();
        return response()->json($topics, 200);
    }
}
