<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = auth()->user()->tasks()->orderBy('due_date')->get();
        return view('tasks.index', compact('tasks'));
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
            'title' => 'required',
            'due_date' => 'required|date',
        ]);

        auth()->user()->tasks()->create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $task = Task::findOrFail($id);
       return view('tasks.edit', compact('task'));

    }

    /**
     * Update the specified resource in storage.
     */
        public function update(Request $request, string $id)
        {
            $request->validate([
                'title' => 'required|string|max:255',
                'due_date' => 'required|date',
            ]);

            try { 

                $task = Task::findOrFail($id);
 
                $task->update([
                    'title' => $request->input('title'),
                    'due_date' => $request->input('due_date'),
                    'description' => $request->input('description'),
                ]);

                return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
            } catch (\Exception $e) { 
                \Log::error('Error updating task: ' . $e->getMessage());

                return redirect()->route('tasks.index')->with('error', 'Failed to update task.');
            }
        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try { 
            $task = Task::findOrFail($id); 
            $task->delete(); 
            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
        } catch (\Exception $e) { 
            \Log::error('Error deleting task: ' . $e->getMessage());

            return redirect()->route('tasks.index')->with('error', 'Failed to delete task.');
        }
    }

}
