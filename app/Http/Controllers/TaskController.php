<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Building;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class TaskController
 *
 * Handles task-related operations.
 *
 * @package App\Http\Controllers
 */
class TaskController extends Controller
{
    /**
     * List all tasks for a given building with their comments.
     *
     * @param Building $building
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Building $building, Request $request): JsonResponse
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
     * @param StoreTaskRequest $request
     * @return JsonResponse
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $data = $request->validated();
        $task = Task::create($data);

        return response()->json($task, 201);
    }
}
