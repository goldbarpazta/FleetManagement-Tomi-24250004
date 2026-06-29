<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pajak</title>
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
    <h2>Laporan Pajak Kendaraan</h2>
    <p>Tanggal: {{ date('d/m/Y') }}</p>
    <table>
        <thead>
            <tr><th>Kendaraan</th><th>Jatuh Tempo</th><th>Biaya</th><th>Status</th></tr>
        </thead>
        <tbody>
            @foreach($pajak as $p)
            <tr>
                <td>{{ $p->kendaraan->no_plat ?? '-' }}</td>
                <td>{{ $p->tanggal_jatuh_tempo?->format('d/m/Y') }}</td>
                <td class="text-end">Rp {{ number_format($p->biaya, 0, ',', '.') }}</td>
                <td>{{ $p->status_label }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
