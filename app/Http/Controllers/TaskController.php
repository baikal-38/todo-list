<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => ['nullable', Rule::in(['pending', 'in_progress', 'completed'])]
        ], [
            'title.required' => 'Поле title обязательно для заполнения',
            'status.in' => 'Статус должен быть одним из: pending, in_progress, completed'
        ]);

        $task = Task::create($validated);

        return response()->json($task, Response::HTTP_CREATED);
    }

    public function show(Task $task)
    {
        return $task;
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => ['sometimes', Rule::in(['pending', 'in_progress', 'completed'])]
        ], [
            'title.required' => 'Поле title обязательно для заполнения',
            'status.in' => 'Статус должен быть одним из: pending, in_progress, completed'
        ]);

        $task->update($validated);

        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
