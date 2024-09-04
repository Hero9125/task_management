@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Task</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" class="form-control" value="{{ $task->due_date }}" required>
        </div>

        <div class="form-group">
            <label for="priority">Priority</label>
            <select name="priority" class="form-control">
                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Task</button>
    </form>
</div>
@endsection
