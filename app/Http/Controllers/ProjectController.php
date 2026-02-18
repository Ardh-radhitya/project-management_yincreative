<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client;
use App\Models\ProjectCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\ProjectStatusUpdated;
use App\Models\ProjectDelivery;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;


class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['client', 'category', 'user'])->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $clients = Client::all();
        $categories = ProjectCategory::all();
        $teams = User::whereHas('role', function($q) {
            $q->where('name', 'Team');
        })->get();

        return view('projects.create', compact('clients', 'categories', 'teams'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'nullable|exists:users,id',
            'category_id' => 'required|exists:project_categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
        ]);

        Project::create($validatedData);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function show(Project $project)
    {
        return redirect()->route('projects.tasks.index', $project->id);
    }

    public function edit(Project $project)
    {
        $clients = Client::all();
        $categories = ProjectCategory::all();
        $teams = User::whereHas('role', function($q) {
            $q->where('name', 'Team');
        })->get();

        return view('projects.edit', compact('project', 'clients', 'categories', 'teams'));
    }

    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'nullable|exists:users,id', // ID Team
            'category_id' => 'required|exists:project_categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
        ]);

        // LOGIC KUNCI: Cek apakah user_id (Team) mau diganti
        if ($project->user_id != $request->user_id) {
            // Cek apakah ada task di proyek ini yang sudah "Done"
            $hasDoneTask = $project->tasks()->where('status', 'Done')->exists();

            if ($hasDoneTask) {
                return back()->with('error', 'Gagal! Anggota tim proyek tidak bisa diganti karena sudah ada tugas yang selesai (Done).');
            }
        }

        $project->update($validatedData);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dihapus.');
    }

    // 1. Tampilkan halaman delivery
    public function showDelivery(Project $project)
    {
        // Eager load deliveries dan usernya agar tidak berat
        $project->load('deliveries.user', 'client');
        return view('projects.delivery', compact('project'));
    }

    // 2. Proses upload file hasil
    public function storeDelivery(Request $request, Project $project)
    {
        $request->validate([
            'file_hasil' => 'required|file|mimes:pdf,zip,jpg,png,docx|max:20480', // Max 20MB
            'description' => 'nullable|string|max:255'
        ]);

        if ($request->hasFile('file_hasil')) {
            $file = $request->file('file_hasil');

            // Simpan ke folder storage/app/public/deliveries/{id_proyek}
            $path = $file->store('deliveries/' . $project->id, 'public');

            ProjectDelivery::create([
                'project_id' => $project->id,
                'user_id' => auth()->id(),
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'description' => $request->description
            ]);
        }

        return back()->with('success', 'File hasil pengerjaan berhasil diunggah!');
    }

    public function history(Request $request)
    {
        $user = auth()->user();

        // Inisialisasi query dasar
        $query = Project::with(['client', 'category', 'user'])
                        ->where('status', 'Completed');

        // LOGIC FILTER RENTANG WAKTU
        if ($request->has('start_date') && $request->has('end_date')) {
            // Kita filter berdasarkan tanggal update terakhir (saat status jadi Completed)
            $query->whereBetween('updated_at', [$request->start_date, $request->end_date]);
        }

        // Filter Role (Tetep bawa yang lama biar gak rusak)
        if (strtolower($user->role->name) !== 'admin') {
            $query->where('user_id', $user->id);
        }

        $projects = $query->orderBy('updated_at', 'desc')->get();

        return view('projects.history', compact('projects'));
    }

    public function generateReport(Project $project)
    {
        $project->load(['tasks', 'deliveries.user', 'client', 'category']);

        $totalTasks = $project->tasks->count();
        $completedTasks = $project->tasks->whereIn('status', ['Done', 'Selesai'])->count();
        $progressPercentage = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        // Menyiapkan data untuk dikirim ke view PDF
        $data = [
            'project' => $project,
            'progressPercentage' => $progressPercentage,
            'totalTasks' => $totalTasks,
            'completedTasks' => $completedTasks,
            'adminName' => auth()->user()->name
        ];

        // Load view khusus PDF (kita buat di step 3)
        $pdf = Pdf::loadView('projects.pdf_report', $data);

        // Langsung download atau tampilkan di browser
        return $pdf->stream('Laporan_Proyek_' . $project->name . '.pdf');
    }
}
