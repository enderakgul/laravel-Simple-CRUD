<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskController extends Controller
{
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function show($id)
    {
        return new TaskResource($this->taskRepository->getTaskById($id));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        return $this->taskRepository->createTask($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, $id)
    {
        $task = $this->taskRepository->getTaskById($id);
        return new TaskResource($this->taskRepository->updateTask($task, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = $this->taskRepository->getTaskById($id);
        $this->taskRepository->deleteTask($task);
        return response()->json(null, 204);
    }
}
