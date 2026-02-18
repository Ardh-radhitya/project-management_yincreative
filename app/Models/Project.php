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
        'deadline',
        'status',
        'client_id',
        'user_id',
        'category_id',
        'file_path',
    ];

    // Tambahkan ini biar Laravel tau 'user' itu ngambil dari tabel users lewat user_id
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
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

    public function deliveries() {
        return $this->hasMany(ProjectDelivery::class);
    }
}
