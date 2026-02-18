<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDelivery extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'user_id', 'file_name', 'file_path', 'description'];

    // Relasi ke Proyek
    public function project() {
        return $this->belongsTo(Project::class);
    }

    // Relasi ke User (siapa yang upload)
    public function user() {
        return $this->belongsTo(User::class);
    }
}
