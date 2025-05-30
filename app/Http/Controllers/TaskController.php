<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource (Dashboard).
     */
    public function index()
    {
        $filter = request('filter', 'all');
        $query = auth()->user()->tasks();
        
        // Apply filters
        switch ($filter) {
            case 'completed':
                $query->where('completed', true);
                break;
            case 'pending':
                $query->where('completed', false);
                break;
            case 'overdue':
                $query->where('completed', false)
                      ->where('deadline', '<', now());
                break;
        }
        
        $tasks = $query->latest()->get();
        
        // Process subtasks if stored as JSON
        $tasks->each(function ($task) {
            if ($task->subtasks && is_string($task->subtasks)) {
                $task->subtasks = json_decode($task->subtasks, true) ?: [];
            }
        });
        
        return view('tasks.index', compact('tasks', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'notes' => 'nullable',
            'deadline' => 'nullable|date',
            'priority' => 'nullable|in:low,medium,high',
            'subtasks' => 'nullable|string',
        ]);

        $subtasks = null;
        if ($request->subtasks) {
            $subtasks = json_decode($request->subtasks, true);
        }

        auth()->user()->tasks()->create([
            'title' => $request->title,
            'notes' => $request->notes,
            'deadline' => $request->deadline,
            'priority' => $request->priority ?? 'medium',
            'subtasks' => $subtasks ? json_encode($subtasks) : null,
            'completed' => false,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('dashboard')->with('success', 'Task berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Pastikan task milik user yang sedang login
        if ($task->user_id !== auth()->id()) {
            abort(404);
        }
        
        // Process subtasks if stored as JSON
        if ($task->subtasks && is_string($task->subtasks)) {
            $task->subtasks = json_decode($task->subtasks, true) ?: [];
        }
        
        // If AJAX request, return JSON for editing
        if (request()->ajax()) {
            return response()->json($task);
        }
        
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        // Pastikan task milik user yang sedang login
        if ($task->user_id !== auth()->id()) {
            abort(404);
        }
        
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Pastikan task milik user yang sedang login
        if ($task->user_id !== auth()->id()) {
            abort(404);
        }
        
        $request->validate([
            'title' => 'required|max:255',
            'notes' => 'nullable',
            'deadline' => 'nullable|date',
            'priority' => 'nullable|in:low,medium,high',
            'subtasks' => 'nullable|string',
        ]);

        $subtasks = null;
        if ($request->subtasks) {
            $subtasks = json_decode($request->subtasks, true);
        }

        $task->update([
            'title' => $request->title,
            'notes' => $request->notes,
            'deadline' => $request->deadline,
            'priority' => $request->priority ?? 'medium',
            'subtasks' => $subtasks ? json_encode($subtasks) : null,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('dashboard')->with('success', 'Task berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Pastikan task milik user yang sedang login
        if ($task->user_id !== auth()->id()) {
            abort(404);
        }
        
        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Task berhasil dihapus!');
    }

    /**
     * Toggle task completion status.
     */
    public function toggleComplete(Task $task)
    {
        // Pastikan task milik user yang sedang login
        if ($task->user_id !== auth()->id()) {
            abort(404);
        }
        
        $task->update([
            'completed' => !$task->completed
        ]);

        return redirect()->route('dashboard')->with('success', 'Status task berhasil diubah!');
    }

    /**
     * Toggle subtask completion (jika ada fitur subtask).
     */
    public function toggleSubtask($subtaskId)
    {
        // Implementation untuk subtask jika diperlukan
        // ...
    }
}