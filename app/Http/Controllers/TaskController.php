<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Functions\Response;
use Throwable;

class TaskController extends Controller
{
    public function create(TaskRequest $request)
    {
        $task = new Task();
        $task->user()->associate(auth()->user());
        $task->title = $request->input('title');
        $task->content = $request->input('content');
        $task->date = $request->input('date');
        $task->save();
        return Response::ok(new TaskResource($task));
    }

    public function update(TaskRequest $request, Task $task)
    {
        $task->title = $request->input('title');
        $task->content = $request->input('content');
        $task->date = $request->input('date');
        $task->save();
        return Response::ok(new TaskResource($task));
    }


    public function show(Task $task)
    {
        return Response::ok(new TaskResource($task));
    }


    public function delete(Task $task)
    {
        try {
            $task->delete();
            return Response::ok([], 'true');
        } catch (Throwable $e) {
            return Response::fail($e->getMessage());
        }
    }
}
