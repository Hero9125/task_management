@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Task List</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add New Task</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Priority</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ ucfirst($task->status) }}</td>
                <td>{{ $task->due_date }}</td>
                <td>{{ ucfirst($task->priority) }}</td>
                <td>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-info">Edit</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
