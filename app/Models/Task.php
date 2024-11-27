<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = ['name', 'priority', 'project_id'];

    // Defines relationship with Project model
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}