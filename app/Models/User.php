<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo_profile',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Tambahkan fungsi ini di dalam class User
    public function assignedTasks()
    {
        // Satu user bisa ditugaskan banyak tugas
        return $this->hasMany(Task::class, 'assigned_to_user_id');
    }

    public function client()
    {
    // Asumsi foreign key di tabel users adalah 'client_id'
    // Jika nama kolomnya beda, sesuaikan 'client_id'
    return $this->belongsTo(Client::class, 'id'); // Sesuaikan jika perlu
    }
}
