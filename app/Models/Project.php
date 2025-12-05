<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // DEFINISI KONSTANTA STATUS
    const STATUS_PENDING = 'Pending';
    const STATUS_IN_PROGRESS = 'In Progress';
    const STATUS_COMPLETED = 'Completed';
    // Tambahkan status lain jika ada, misal: 'On Hold'

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
     * (Ini sudah ada di file-mu)
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relasi: Satu Proyek masuk dalam satu Kategori.
     * (Ini sudah ada di file-mu)
     */
    public function category()
    {
        return $this->belongsTo(ProjectCategory::class);
    }

    /**
     * Relasi: Satu Proyek memiliki banyak Tugas (Task).
     * (Ini sudah ada di file-mu)
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
