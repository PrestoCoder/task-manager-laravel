<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/SortableJS/Sortable/Sortable.min.js"></script>
    <!-- Add jQuery for easier AJAX handling -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Add this right after jQuery loads
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').content
            }
        });
    </script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl mb-8">Task Manager</h1>

        <!-- Project Filter -->
        <div class="mb-6">
            <div class="flex gap-4">
                <select id="projectFilter" class="form-select rounded-md shadow-sm">
                    <option value="">All Projects</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Add Task Form -->
        <div class="mb-8 bg-white p-6 rounded-lg shadow-md">
            <div class="flex gap-4">
                <input type="text" id="newTaskName" placeholder="New task" 
                    class="flex-1 rounded-md border-gray-300 shadow-sm">
                <select id="newTaskProject" class="rounded-md border-gray-300 shadow-sm">
                    <option value="">No Project</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
                <button onclick="addTask()" class="px-4 py-2 bg-green-500 text-white rounded-md">
                    Add Task
                </button>
            </div>
            <!-- Error message container -->
            <div id="taskError" class="mt-2 text-red-500 hidden"></div>
        </div>

        <!-- Tasks List -->
        <div id="tasks-list" class="space-y-2">
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
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl mb-4">Edit Task</h2>
            <div class="space-y-4">
                <input type="text" id="editTaskName" class="w-full rounded-md border-gray-300 shadow-sm">
                <select id="editProjectId" class="w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">No Project</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
                <div class="flex justify-end gap-2">
                    <button onclick="closeEditModal()"
                            class="px-4 py-2 bg-gray-500 text-white rounded-md">Cancel</button>
                    <button onclick="updateTask()"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md">Save</button>
                </div>
                <!-- Error message container -->
                <div id="editError" class="text-red-500 hidden"></div>
            </div>
        </div>
    </div>

    <script>
    // Setup CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').content
        }
    });

    // Initialize drag and drop
    new Sortable(document.getElementById('tasks-list'), {
        animation: 150,
        handle: '.cursor-move',
        onEnd: function() {
            const taskItems = document.querySelectorAll('.task-item');
            const taskIds = Array.from(taskItems).map(item => item.dataset.id);
            
            $.ajax({
                url: '{{ route("tasks.reorder") }}',
                method: 'POST',
                data: { tasks: taskIds },
                success: function() {
                    // Optional: Show success message
                }
            });
        }
    });

    // Add new task
    function addTask() {
        const name = $('#newTaskName').val();
        const projectId = $('#newTaskProject').val();
        
        $.ajax({
            url: '{{ route("tasks.store") }}',
            method: 'POST',
            data: { 
                name: name,
                project_id: projectId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Clear form
                $('#newTaskName').val('');
                $('#taskError').addClass('hidden');
                
                // Add new task to list
                const projectName = projectId ? 
                    $('#newTaskProject option:selected').text() : '';
                const projectSpan = projectId ? 
                    `<span class="text-sm text-gray-500">(${projectName})</span>` : '';
                
                const newTask = `
                    <div class="task-item bg-white p-4 rounded-lg shadow-md flex items-center justify-between" 
                         data-id="${response.id}">
                        <div class="flex items-center gap-4">
                            <span class="cursor-move">≡</span>
                            <span>${name}</span>
                            ${projectSpan}
                        </div>
                        <div class="flex gap-2">
                            <button onclick="editTask(${response.id}, '${name}', ${projectId})"
                                    class="px-3 py-1 bg-blue-500 text-white rounded-md">Edit</button>
                            <button onclick="deleteTask(${response.id})"
                                    class="px-3 py-1 bg-red-500 text-white rounded-md">Delete</button>
                        </div>
                    </div>
                `;
                
                $('#tasks-list').prepend(newTask);
            },
            error: function(xhr) {
                $('#taskError').removeClass('hidden').text(xhr.responseJSON.message);
            }
        });
    }

    // Filter tasks
    $('#projectFilter').change(function() {
        const projectId = $(this).val();
        
        $.get('{{ route("tasks.index") }}', { 
            project_id: projectId 
        }, function(response) {
            $('#tasks-list').html(response);
        });
    });

    // Delete task
    function deleteTask(taskId) {
        if (confirm('Are you sure you want to delete this task?')) {
            $.ajax({
                url: `/tasks/${taskId}`,
                method: 'DELETE',
                success: function() {
                    $(`[data-id="${taskId}"]`).remove();
                }
            });
        }
    }

    // Edit task variables
    let currentEditId = null;

    function editTask(id, name, projectId) {
        currentEditId = id;
        $('#editTaskName').val(name);
        $('#editProjectId').val(projectId || '');
        $('#editModal').removeClass('hidden');
        $('#editError').addClass('hidden');
    }

    function closeEditModal() {
        $('#editModal').addClass('hidden');
        currentEditId = null;
    }

    function updateTask() {
        const name = $('#editTaskName').val();
        const projectId = $('#editProjectId').val();
        
        $.ajax({
            url: `/tasks/${currentEditId}`,
            method: 'PUT',
            data: {
                name: name,
                project_id: projectId
            },
            success: function(response) {
                const taskElement = $(`[data-id="${currentEditId}"]`);
                const projectName = projectId ? 
                    $('#editProjectId option:selected').text() : '';
                const projectSpan = projectId ? 
                    `<span class="text-sm text-gray-500">(${projectName})</span>` : '';
                
                taskElement.find('div:first').html(`
                    <span class="cursor-move">≡</span>
                    <span>${name}</span>
                    ${projectSpan}
                `);
                
                closeEditModal();
            },
            error: function(xhr) {
                $('#editError').removeClass('hidden').text(xhr.responseJSON.message);
            }
        });
    }
    </script>
</body>
</html>