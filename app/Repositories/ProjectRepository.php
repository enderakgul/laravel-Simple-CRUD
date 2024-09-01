<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\Task;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function getAllProjects()
    {
        return Project::all();
    }

    public function getProjectById($id)
    {
        return Project::findOrFail($id);
    }

    public function createProject(array $data)
    {
        return Project::create($data);
    }

    public function updateProject(Project $project, array $data)
    {
        $project->update($data);
        return $project;
    }

    public function deleteProject(Project $project)
    {
        return $project->delete();
    }

    public function getTasksForProject($projectId, array $filters = [])
    {
        $query = Task::where('project_id', $projectId);

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->get();
    }
}
