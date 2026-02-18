<!DOCTYPE html>
<html>
<head>
    <title>Laporan Proyek</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #444; padding-bottom: 10px; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; margin-bottom: 5px; }
        .subtitle { font-size: 12px; color: #666; text-transform: uppercase; }
        .section-title { font-size: 12px; font-weight: bold; color: #888; text-transform: uppercase; margin-top: 20px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .info-table td { padding: 5px 0; font-size: 13px; }
        .data-table th { background-color: #f8f9fa; color: #666; font-size: 11px; text-align: left; padding: 10px; border-bottom: 1px solid #ddd; }
        .data-table td { padding: 10px; font-size: 12px; border-bottom: 1px solid #eee; }
        .progress-box { background-color: #f0f4f8; padding: 15px; border-radius: 8px; border: 1px solid #dce3e8; }
        .footer { margin-top: 50px; text-align: right; }
        .signature { margin-top: 60px; font-weight: bold; border-top: 1px solid #333; display: inline-block; width: 200px; text-align: center; padding-top: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">LAPORAN PENYELESAIAN PROYEK</div>
        <div class="subtitle">Y.in Creative Agency - Digital Project Report</div>
    </div>

    <table class="info-table">
        <tr>
            <td width="50%">
                <div class="section-title">Informasi Proyek</div>
                <strong>Nama:</strong> {{ $project->name }}<br>
                <strong>Klien:</strong> {{ $project->client->name ?? '-' }}<br>
                <strong>Kategori:</strong> {{ $project->category->name ?? 'Umum' }}
            </td>
            <td width="50%">
                <div class="section-title">Statistik Pengerjaan</div>
                <div class="progress-box">
                    <strong>Total Progress: {{ $progressPercentage }}%</strong><br>
                    <small>{{ $completedTasks }} dari {{ $totalTasks }} tugas selesai.</small>
                </div>
            </td>
        </tr>
    </table>

    <div class="section-title">Daftar Penyerahan Hasil (Deliverables)</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="45%">Nama File / Aset</th>
                <th width="30%">Keterangan</th>
                <th width="20%">Tanggal Kirim</th>
            </tr>
        </thead>
        <tbody>
            @foreach($project->deliveries as $index => $file)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $file->file_name }}</strong></td>
                <td>{{ $file->description ?? '-' }}</td>
                <td>{{ $file->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p style="font-size: 11px;">Surakarta, {{ date('d F Y') }}</p>
        <p style="font-size: 11px; margin-bottom: 50px;">Penanggung Jawab Proyek,</p>
        <div class="signature">
            {{ $adminName }}<br>
            <span style="font-size: 10px; font-weight: normal;">Administrator System</span>
        </div>
    </div>
</body>
</html>
