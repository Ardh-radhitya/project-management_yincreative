<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'company',
        'photo_profile'
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // Opsional: Tambahkan relasi ke User agar lebih lengkap
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
