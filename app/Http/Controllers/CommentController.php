<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

/**
 * Class CommentController
 *
 * Handles operations related to task comments.
 *
 * @package App\Http\Controllers
 */
class CommentController extends Controller
{
    /**
     * Create a new comment for a given task.
     *
     * @param StoreCommentRequest $request
     * @param Task $task
     * @return JsonResponse
     */
    public function store(StoreCommentRequest $request, Task $task): JsonResponse
    {
        $data = $request->validated();
        $data['task_id'] = $task->id;
        $comment = Comment::create($data);

        return response()->json($comment, 201);
    }
}
