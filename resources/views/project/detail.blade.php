<x-app-layout>
    <x-slot name="header">
        <div class="md:flex lg:flex">
            <div style="flex: 1;">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight project-name">
                    {{ $project->name }}
                </h2>
                <p class="mt-2 text-sm text-gray-600 project-description">
                    {{ $project->description }}
                </p>
            </div>
            <div style="width: 140px;" class="justify-between flex mt-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateProject">
                    Edit
                </button>
                <a href="/project/delete/{{ $project->id }}" class="btn btn-danger" style="align-content: center;">
                    Delete
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto px-6 flex justify-between">
            <button type="button" class="btn btn-primary mt-2 pull-right" data-bs-toggle="modal" data-bs-target="#newTask">
                New Task
            </button>

            <form class="mt-2" method="get" action="">
                <select name="status_filter">
                    <option value="">All</option>
                    <option value="todo" {{$status_filter == 'todo'?'selected':''}}>To Do</option>
                    <option value="in_progress" {{$status_filter == 'in_progress'?'selected':''}}>In Progress</option>
                    <option value="done" {{$status_filter == 'done'?'selected':''}}>Done</option>
                </select>
                <button type="submit" class="btn btn-secondary">
                    Filter
                </button>
            </form>
        </div>
    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">
                    Task List
                </h2>
                <div class="p-6 text-gray-900">
                    @forelse($tasks as $task)
                        <div class="task-container flex mb-4 border-b p-2">
                            <div style="flex: 1;">
                                <span class="{{ $task->getStatusDetail()['color'] }} text-white p-2 text-sm">{{ $task->getStatusDetail()['description'] }}</span>
                                <p class="mt-2 font-semibold text-xl text-gray-800 leading-tight">
                                    {{ $task->name }}
                                </p>
                                <p class="mt-2 text-sm text-gray-600">
                                    {{ $task->description }}
                                </p>
                            </div>
                            <div style="width: 50px;" class="flex justify-between m-2">
                                <a href="#" class="edit-task" data-id="{{ $task->id }}"><i class="bi bi-pencil-square"></i></a>
                                <a class="delete-task" data-id="{{ $task->id }}"><i class="bi bi-trash3"></i></a>
                            </div>
                        </div>
                    @empty
                        <p>No task is defined. You can add new tasks.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New Task for {{ $project->name }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="new-task-from">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="nameInput">
                        </div>
                        <div class="mb-3">
                            <label for="descriptionInput" class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="descriptionInput"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="statusInput" class="form-label">Status</label>
                            <select name="status" class="form-control" id="statusInput">
                                <option value="todo">To Do</option>
                                <option value="in_progress">In Progress</option>
                                <option value="done">Done</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-task">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="updateProject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="new-project-from">
                        @csrf
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="nameInput" value="{{ $project->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="descriptionInput" class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="descriptionInput">{{ $project->description }}</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-project">Save</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    let editedTaskId;
    $('.save-task').click(function () {
        let saveTaskUrl = '/task';
        if(editedTaskId)
            saveTaskUrl = saveTaskUrl + '/' + editedTaskId;

        $.post(saveTaskUrl, $('#new-task-from').serialize()).done(function(){
            location.reload();
        });
    });

    $('.edit-task').click( function () {
        editedTaskId = $(this).attr("data-id");
       $.get('/task/' + editedTaskId).done(function(data) {
           $('input[name="name"]').val(data.data.name);
           $('textarea[name="description"]').val(data.data.description);
           $('select[name="status"]').val(data.data.status)
           new bootstrap.Modal('#newTask').show();
       });
    });

    $('.delete-task').click( function () {
        $.ajax({
            url: '/task/' + $(this).attr("data-id"),
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function() {
                $(this).closest('task-container').remove();
            }
        });
    });

    $('.save-project').click(function () {
        $.post('/project/{{ $project->id }}', $('#new-project-from').serialize()).done(function(data){
            $('.project-name').text(data.data.name);
            $('.project-description').text(data.data.description);
            bootstrap.Modal.getInstance($('#updateProject')).toggle();
        });
    });
</script>
