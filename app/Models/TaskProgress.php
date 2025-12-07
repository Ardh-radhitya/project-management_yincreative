<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskProgress extends Model
{
    use HasFactory;

    // Pastikan nama tabel benar (biasanya laravel otomatis 'task_progress')
    protected $table = 'task_progress';

    protected $fillable = [
        'task_id',
        'user_id',
        'progress_note',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // [PENTING] Tambahkan ini agar nama pengirim komentar muncul
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
