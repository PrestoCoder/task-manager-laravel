<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::all();
        $query = Task::query()->orderBy('priority');
        
        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }
        
        $tasks = $query->get();
        
        if ($request->ajax()) {
            // Return only the tasks list HTML
            return view('tasks._list', compact('tasks', 'projects'))->render();
        }
        
        return view('tasks.index', compact('tasks', 'projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'project_id' => 'nullable|exists:projects,id'
        ]);

        $maxPriority = Task::max('priority') ?? 0;
        
        $task = Task::create([
            'name' => $request->name,
            'priority' => $maxPriority + 1,
            'project_id' => $request->project_id
        ]);

        if ($request->ajax()) {
            return response()->json($task);
        }

        return redirect()->route('tasks.index');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'project_id' => 'nullable|exists:projects,id'
        ]);

        $task->update($request->only(['name', 'project_id']));

        if ($request->ajax()) {
            return response()->json($task);
        }

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('tasks.index');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'tasks' => 'required|array',
            'tasks.*' => 'exists:tasks,id'
        ]);

        foreach ($request->tasks as $index => $taskId) {
            Task::where('id', $taskId)->update(['priority' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}