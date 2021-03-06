<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\TeacherPlan;
use Illuminate\Http\Request;
use App\Http\Resources\TeacherPlanCollection;
use App\Http\Resources\TeacherPlan as TeacherPlanResource;
use Illuminate\Support\Facades\Auth;

class TeacherPlanController extends Controller
{
    private static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
        'title.unique' => 'El título ya existe, por favor agregue otro.',

    ];

    public function index()
    {
        return new TeacherPlanCollection(TeacherPlan::paginate());
    }

    public function show(TeacherPlan $teacherplan)
    {
        return response()->json(new TeacherPlanResource($teacherplan), 200);
    }

    public function store(Request $request)
    {
        $this->authorize('create', TeacherPlan::class);

        $validateData = $request->validate([
            'title' => 'required|string|unique:teacher_plans|max:255',
            'problem' => 'required',
            'solution' => 'required',
            'status'=>'nullable'
        ], self::$messages);


        $idea = TeacherPlan::create($validateData);

        return response()->json(new TeacherPlanResource($idea), 201);
    }

    public function update(Request $request, TeacherPlan $teacherplan)
    {
        $request->validate([
            'title' => 'required|string|unique:teacher_plans,title,' . $teacherplan->id . '|max:255',
            'problem' => 'required',
            'solution' => 'required'
        ], self::$messages);

        $teacherplan->update($request->all());
        return response()->json($teacherplan, 200);
    }

    public function ideas()
    {
        $user = Auth::user();
        $teacher = $user->userable;
        return response()->json(TeacherPlanResource::collection($teacher->ideas), 200);
    }

    public function idea(Teacher $teacher, TeacherPlan $idea)
    {
        $ideas = $teacher->ideas()->where('id', $idea->id)->firstOrFail();
        return response()->json(new TeacherPlanResource($ideas), 200);
    }

    public function delete(TeacherPlan $teacherplan)
    {
        $teacherplan->delete();
        return response()->json(null, 204);
    }
}
