<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $tasks = Task::paginate(5);
        } else {
            $tasks = Task::where('user_id', auth()->user()->id)->paginate(5);
        }

        return response()->json($tasks, 200);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
        ];

        $messages = [
            'title.required' => 'Title is required',
            'title.string' => 'Title must be a string',
            'title.max' => 'Title must not exceed 255 characters',
            'description.string' => 'Description must be a string',
        ];

        $request->validate($rules, $messages);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_status' => false,
            'user_id' => auth()->user()->id,
        ]);

        return response()->json([
            'message' => 'Task created successfully',
            'task' => $task
        ], 201);
    }

    public function filterByStatus($is_status)
    {
        $statusFilter = filter_var($is_status, FILTER_VALIDATE_BOOLEAN);

        if (auth()->user()->role === 'admin') {
            $tasks = Task::where('is_status', $statusFilter)
                ->paginate(10);
        } else {
            $tasks = Task::where('is_status', $statusFilter)
                ->where('user_id', auth()->user()->id)->paginate(10);
        }

        return response()->json($tasks, 200);
    }

    public function update(Request $request, $id)
    {

        if (auth()->user()->is_admin === true) {
            $task = Task::find($id);
        } else {
            $task = Task::where('user_id', auth()->user()->id)->find($id);
        }

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $rules = [
            'title' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'is_status' => 'nullable|boolean',
        ];

        $messages = [
            'title.string' => 'Title must be a string',
            'title.max' => 'Title must not exceed 255 characters',
            'description.string' => 'Description must be a string',
            'is_status.boolean' => 'Status must be a boolean',
        ];

        $request->validate($rules, $messages);

        $data = [
            'title' => $request->title ?? $task->title,
            'description' => $request->description ?? $task->description,
            'is_status' => $request->is_status ?? $task->is_status,
        ];

        $task->update($data);

        return response()->json([
            'message' => 'Task updated successfully',
            'task' => $task
        ], 200);
    }

    public function destroy($id)
    {
        if(auth()->user()->is_admin === true) {
            $task = Task::find($id);
        } else {
            $task = Task::where('user_id', auth()->user()->id)->find($id);
        }

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
