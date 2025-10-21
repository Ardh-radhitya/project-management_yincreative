<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Pastikan semua kolom yang diisi dari form terdaftar di sini
    protected $fillable = [
        'name',
        'description',
        'client_id',
        'category_id',
        'start_date',
        'end_date',
        'status'
    ];

    // Relasi ke Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(ProjectCategory::class);
    }

    // Tambahkan fungsi ini di dalam class Project
    public function tasks()
    {
        // Satu proyek bisa punya banyak tugas
        return $this->hasMany(Task::class);
    }
}
