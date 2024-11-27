
@foreach($tasks as $task)
    <div class="task-item bg-white p-4 rounded-lg shadow-md flex items-center justify-between" 
         data-id="{{ $task->id }}">
        <div class="flex items-center gap-4">
            <span class="cursor-move">≡</span>
            <span>{{ $task->name }}</span>
            @if($task->project)
                <span class="text-sm text-gray-500">({{ $task->project->name }})</span>
            @endif
        </div>
        <div class="flex gap-2">
            <button onclick="editTask({{ $task->id }}, '{{ $task->name }}', {{ $task->project_id ?? 'null' }})"
                    class="px-3 py-1 bg-blue-500 text-white rounded-md">Edit</button>
            <button onclick="deleteTask({{ $task->id }})"
                    class="px-3 py-1 bg-red-500 text-white rounded-md">Delete</button>
        </div>
    </div>
@endforeach