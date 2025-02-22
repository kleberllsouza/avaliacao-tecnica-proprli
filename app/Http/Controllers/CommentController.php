<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    /**
     * Create a new comment for a task.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCommentRequest $request, Task $task)
    {
        $data = $request->validated();

        $data['task_id'] = $task->id;

        $comment = Comment::create($data);

        return response()->json($comment, 201);
    }
}
