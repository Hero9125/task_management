@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($task) ? 'Edit Task' : 'Create Task' }}</h1>

    <form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST">
        @csrf
        @if(isset($task))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $task->title ?? old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $task->description ?? old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" class="form-control" value="{{ $task->due_date ?? old('due_date') }}" required>
        </div>

        <div class="form-group">
            <label for="priority">Priority</label>
            <select name="priority" class="form-control">
                <option value="low" {{ (isset($task) && $task->priority == 'low') ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ (isset($task) && $task->priority == 'medium') ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ (isset($task) && $task->priority == 'high') ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($task) ? 'Update' : 'Create' }}</button>
    </form>
</div>
@endsection
