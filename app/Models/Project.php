<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal (mass assignable).
     * INI ADALAH KUNCI PERBAIKANNYA
     */
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'client_id',
        'category_id',
    ];

    /**
     * Relasi: Satu Proyek dimiliki oleh satu Klien.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relasi: Satu Proyek masuk dalam satu Kategori.
     */
    public function category()
    {
        return $this->belongsTo(ProjectCategory::class);
    }

    /**
     * Relasi: Satu Proyek memiliki banyak Tugas (Task).
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
