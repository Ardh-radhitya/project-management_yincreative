<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\ProjectCategory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
        'client_id',
    ];

    public function index()
    {
        $totalProjects = Project::count();
        $totalUsers = User::count();

        return view('dashboard.admin', compact('totalProjects', 'totalUsers'));
    }


    // Relasi ke Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

}
