<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Building;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;

class TaskController extends Controller
{
    /**
     * List all tasks with comments.
     *
     * @param  \App\Models\Building  $building
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function index(Building $building, Request $request)
    {
        $tasks = $building->tasks()
            ->with('comments')
            ->filter($request->query())
            ->get();

        return response()->json($tasks);
    }

    /**
     * Create a new task.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();

        $task = Task::create($data);
        
        return response()->json($task, 201);
    }
}
