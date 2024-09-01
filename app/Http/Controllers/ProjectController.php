<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('project.list', [
            'projects' => $this->projectRepository->getAllProjects(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $project = $this->projectRepository->createProject($request->validated());
        return redirect("/project/" . $project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $project = $this->projectRepository->getProjectById($id);

        $filters = [];
        if($status_filter = $request->status_filter)
            $filters = ['status' => $status_filter];

        $tasks = $this->projectRepository->getTasksForProject($id, $filters);

        return view('project.detail', [
            'project' => $project,
            'tasks' => $tasks,
            'status_filter' => $status_filter
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProjectRequest $request, $id)
    {
        $project = $this->projectRepository->getProjectById($id);
        return new ProjectResource($this->projectRepository->updateProject($project, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = $this->projectRepository->getProjectById($id);
        $this->projectRepository->deleteProject($project);
        return redirect('/project');
    }
}
