<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Servis</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background: #f5f5f5; }
        h2 { margin-bottom: 5px; }
        .text-end { text-align: right; }
    </style>
</head>
<body>
    <h2>Laporan Servis</h2>
    <p>Tanggal: {{ date('d/m/Y') }}</p>
    <table>
        <thead>
            <tr><th>Tanggal</th><th>Kendaraan</th><th>Bengkel</th><th>Jenis</th><th>Biaya</th><th>Status</th></tr>
        </thead>
        <tbody>
            @foreach($servis as $s)
            <tr>
                <td>{{ $s->tanggal?->format('d/m/Y') }}</td>
                <td>{{ $s->kendaraan->no_plat ?? '-' }}</td>
                <td>{{ $s->bengkel }}</td>
                <td>{{ $s->jenis_servis }}</td>
                <td class="text-end">Rp {{ number_format($s->biaya, 0, ',', '.') }}</td>
                <td>{{ $s->status_label }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
