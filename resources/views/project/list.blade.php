<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project') }} -
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newProject">
                    New Project
                </button>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <ul class="p-6 text-gray-900 project-list" role="list">
                    @foreach ($projects as $project)
                        <li class="mb-4 border-b p-4 hover:bg-gray-100">
                            <a href="{{ route('project.detail', ['project' => $project->id]) }}" style="flex: 1;">
                                <p class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ $project->name }}
                                </p>
                                <p class="mt-2 text-sm text-gray-600">
                                    {{ $project->description }}
                                </p>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newProject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="/project">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="nameInput" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="nameInput">
                    </div>
                    <div class="mb-3">
                        <label for="descriptionInput" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="descriptionInput"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
