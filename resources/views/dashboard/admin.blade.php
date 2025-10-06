@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <h3 class="font-bold text-white text-3xl mb-6">Admin Dashboard</h3>

    <!-- Statistik Card -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-white rounded-2xl shadow p-5 text-center">
            <h4 class="text-gray-500 text-sm">Total Projects</h4>
            <p class="text-2xl font-bold text-gray-800">{{ $totalProjects }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-5 text-center">
            <h4 class="text-gray-500 text-sm">Total Clients</h4>
            <p class="text-2xl font-bold text-gray-800">{{ $totalClients }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-5 text-center">
            <h4 class="text-gray-500 text-sm">Total Users</h4>
            <p class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-5 text-center">
            <h4 class="text-gray-500 text-sm">Total Admins</h4>
            <p class="text-2xl font-bold text-gray-800">{{ $totalAdmins }}</p>
        </div>
    </div>

    <!-- Recent Projects -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h4 class="text-gray-800 text-xl font-semibold mb-4">Recent Projects</h4>
        <table class="w-full border-collapse text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-2 px-3 text-gray-500 text-sm font-medium">#</th>
                    <th class="py-2 px-3 text-gray-500 text-sm font-medium">Project Name</th>
                    <th class="py-2 px-3 text-gray-500 text-sm font-medium">Client</th>
                    <th class="py-2 px-3 text-gray-500 text-sm font-medium">Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentProjects as $index => $project)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-3 text-sm text-gray-700">{{ $index + 1 }}</td>
                        <td class="py-2 px-3 text-sm text-gray-800 font-medium">{{ $project->name }}</td>
                        <td class="py-2 px-3 text-sm text-gray-700">{{ $project->client->name ?? '-' }}</td>
                        <td class="py-2 px-3 text-sm text-gray-700">{{ $project->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-3 text-center text-gray-500">No recent projects found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
