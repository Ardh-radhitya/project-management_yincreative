<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskProgress extends Model
{
    use HasFactory;

    // Nama tabel eksplisit (opsional tapi aman)
    protected $table = 'task_progress';

    protected $fillable = ['task_id', 'user_id', 'progress_note'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
