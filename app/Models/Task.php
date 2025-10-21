<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi massal
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'status',
        'assigned_to_user_id'
    ];

    // Relasi: Satu tugas milik satu proyek
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Relasi: Satu tugas ditugaskan ke satu user (bisa null)
    public function assignedUser()
    {
        // Kita pakai nama 'assignedUser' agar tidak bentrok dengan relasi User bawaan Laravel
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }
}
