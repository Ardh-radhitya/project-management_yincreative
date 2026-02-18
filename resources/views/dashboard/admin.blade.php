@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">

    {{-- BARIS 1: KARTU STATISTIK --}}
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border text-left">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <p class="mb-0 font-sans font-semibold text-sm">Total Proyek</p>
                            <h5 class="mb-0 font-bold">{{ $totalProjects }}</h5>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                                <i class="ni ni-building text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4 text-left">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <p class="mb-0 font-sans font-semibold text-sm">Total Klien</p>
                            <h5 class="mb-0 font-bold">{{ $totalClients }}</h5>
                        </div>
                        <div class="px-3 text-right basis-1/3 text-left">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                                <i class="ni ni-world text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4 text-left">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <p class="mb-0 font-sans font-semibold text-sm">Pending</p>
                            <h5 class="mb-0 font-bold text-orange-500">{{ $pendingProjects }}</h5>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-orange-500 to-yellow-500">
                                <i class="ni ni-cart text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4 text-left text-left">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3 text-left">
                            <p class="mb-0 font-sans font-semibold text-sm">Selesai</p>
                            <h5 class="mb-0 font-bold text-green-500">{{ $completedProjects }}</h5>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-500 to-teal-500">
                                <i class="ni ni-check-bold text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BARIS FILTER TANGGAL & QUICK RANGE --}}
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl p-4">
                <div class="flex flex-wrap items-center justify-between gap-4">

                    {{-- Quick Filter Buttons --}}
                    <div class="flex gap-2 bg-gray-100 p-1 rounded-lg">
                        @foreach(['5d' => '5H', '1w' => '1Mgg', '1m' => '1Bln', '1y' => '1Thn'] as $key => $label)
                            <a href="{{ route('dashboard.admin', ['range' => $key]) }}"
                               class="px-3 py-1 text-xs font-bold rounded-md transition-all {{ $range == $key ? 'bg-white shadow-soft-md text-blue-600' : 'text-slate-500 hover:text-blue-600' }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>

                    {{-- Custom Date Form --}}
                    <form action="{{ route('dashboard.admin') }}" method="GET" class="flex flex-wrap items-end gap-3 text-left">
                        <div class="flex items-center gap-2">
                            <input type="date" name="start_date" value="{{ $startDate }}" class="text-xs border-gray-200 rounded-lg p-1.5 border focus:ring-blue-500">
                            <span class="text-slate-400 text-xs">-</span>
                            <input type="date" name="end_date" value="{{ $endDate }}" class="text-xs border-gray-200 rounded-lg p-1.5 border focus:ring-blue-500">
                        </div>
                        <button type="submit" class="px-4 py-1.5 font-bold text-white bg-gradient-to-tl from-blue-600 to-cyan-400 rounded-lg text-xs shadow-md">GO</button>
                        <a href="{{ route('dashboard.admin') }}" class="px-4 py-1.5 font-bold text-slate-500 bg-gray-50 rounded-lg text-xs text-center border">RESET</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- BARIS 2: GRAFIK STATISTIK --}}
    <div class="flex flex-wrap -mx-3 mb-6 text-left">
        <div class="w-full max-w-full px-3 mt-0 lg:flex-none text-left">
            <div class="border-black/12.5 shadow-soft-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                    <h6 class="capitalize font-bold text-lg">Grafik Proyek {{ date('Y') }}</h6>
                    <p class="mb-0 text-sm leading-normal text-slate-500">
                        <i class="fa fa-arrow-up text-lime-500"></i>
                        <span class="font-semibold text-slate-700"> Statistik Bulanan</span>
                    </p>
                </div>
                <div class="flex-auto p-4">
                    <div style="height: 300px; position: relative; width: 100%;">
                        <canvas id="chart-projects"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BARIS 3: TABEL PROYEK TERBARU --}}
    <div class="flex flex-wrap -mx-3 text-left">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                    <h6 class="font-bold text-left">Proyek Terbaru</h6>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-400 opacity-70 border-b">Proyek</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-400 opacity-70 border-b">Klien</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase text-xxs text-slate-400 opacity-70 border-b">Status</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase text-xxs text-slate-400 opacity-70 border-b">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentProjects as $project)
                                <tr>
                                    <td class="p-4 align-middle border-b text-sm font-semibold px-6">{{ $project->name }}</td>
                                    <td class="p-4 align-middle border-b text-xs text-slate-400 px-6">{{ $project->client->name ?? 'Deleted Client' }}</td>
                                    <td class="p-4 text-center align-middle border-b">
                                        <span class="px-2.5 py-1.5 text-xs font-bold rounded-1.8 inline-block
                                            {{ $project->status == 'Completed' ? 'bg-green-200 text-green-700' :
                                            ($project->status == 'In Progress' ? 'bg-blue-200 text-blue-700' : 'bg-orange-200 text-orange-700') }}">
                                            {{ $project->status }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center align-middle border-b text-xs">{{ $project->created_at->format('d M Y') }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center p-4 italic">Belum ada proyek.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('argon-template/build/assets/js/plugins/chartjs.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("chart-projects");
        if (ctx) {
            var ctx2d = ctx.getContext("2d");
            var gradientStroke1 = ctx2d.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(203, 12, 159, 0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72, 72, 176, 0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203, 12, 159, 0)');

            new Chart(ctx2d, {
                type: "line",
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: "Jumlah Proyek",
                        tension: 0.4,
                        borderWidth: 3,
                        pointRadius: 3,
                        pointBackgroundColor: "#cb0c9f",
                        borderColor: "#cb0c9f",
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: {!! json_encode($chartData) !!},
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 20,
                                color: '#b2b9bf',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                                stepSize: 1,
                                precision: 0,
                                callback: function(value) {
                                    if (value % 1 === 0) { return value; }
                                }
                            },
                            beginAtZero: true
                        },
                        x: {
                            grid: { display: false },
                            ticks: {
                                color: '#b2b9bf',
                                padding: 10,
                                font: { size: 11 },
                                autoSkip: true,
                                // Jika data bulan (12), tampilkan semua. Jika data tanggal (30), batasi limitnya.
                                maxTicksLimit: {!! $range == '1y' ? 12 : 7 !!},
                                maxRotation: 0,
                                minRotation: 0

                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
