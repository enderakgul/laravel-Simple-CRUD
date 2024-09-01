<?php

namespace App\Repositories\Interfaces;

use App\Models\Project;

interface ProjectRepositoryInterface
{
    public function getAllProjects();
    public function getProjectById($id);
    public function createProject(array $data);
    public function updateProject(Project $project, array $data);
    public function deleteProject(Project $project);
    public function getTasksForProject($projectId, array $filters = []);
}
