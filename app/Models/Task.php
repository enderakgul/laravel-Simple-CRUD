<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function getStatusDetail()
    {
        switch ($this->status) {
            case('todo'):
                return ['description' => 'To Do', 'color' => 'bg-secondary'];

            case('in_progress'):
                return ['description' => 'In Progress', 'color' => 'bg-warning'];

            case('done'):
                return ['description' => 'Completed', 'color' => 'bg-success'];
        }
    }
}
