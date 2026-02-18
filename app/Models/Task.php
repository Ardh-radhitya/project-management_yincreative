<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',    // Sesuai migration lo yang baru
        'project_id',
    ];

    /**
     * Relasi: Task dimiliki oleh satu Project
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Relasi: Task dikerjakan oleh satu User (Team)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi: Task memiliki banyak Progress
     */
    public function progress()
    {
        return $this->hasMany(TaskProgress::class);
    }
}
