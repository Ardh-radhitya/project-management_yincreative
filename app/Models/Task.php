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
        'assigned_to_user_id', // Foreign Key User
        'project_id',          // Foreign Key Project
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
     * Kita harus sebutkan 'assigned_to_user_id' karena nama kolomnya custom.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    /**
     * Relasi: Task memiliki banyak Progress (History)
     * (Opsional: Tambahkan ini jika nanti butuh menampilkan riwayat progress)
     */
    public function progress()
    {
        return $this->hasMany(TaskProgress::class);
    }

    // Alias agar $task->assignedUser tetap jalan
    public function assignedUser()
    {
        return $this->user();
    }
}
