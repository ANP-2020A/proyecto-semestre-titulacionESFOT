<?php

namespace App\Http\Controllers;

use App\Project;
use App\Http\Resources\ProjectCollection;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
        'title.unique' => 'El título ya existe, por favor agregue otro.',

    ];

    public function index()
    {
        return new ProjectCollection(Project::all());
    }

    public function show (Project $project)
    {
        return $project;
    }

    public function store (Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|unique:projects|max:255',
            'general_objective' => 'required',
            'specifics_objectives' => 'required',
            'uploaded_at'=>'required',
            'teachers_id'=>'required'
        ],self::$messages);

        $project = Project::create($validatedData);
        return response()->json(new ProjectCollection($project), 201);
    }

    public function update (Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|unique:projects,title,'.$project->id.'|max:255',
            'general_objective' => 'required',
            'specifics_objectives' => 'required',

        ],self::$messages);
        $project->update($request->all());
        return response()->json($project, 200);
    }

    public function delete (Project $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }
}
