<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penggunaan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background: #f5f5f5; }
        h2 { margin-bottom: 5px; }
    </style>
</head>
<body>
    <h2>Laporan Penggunaan Kendaraan</h2>
    <p>Tanggal: {{ date('d/m/Y') }}</p>
    <table>
        <thead>
            <tr><th>Kendaraan</th><th>Pengemudi</th><th>Tujuan</th><th>Berangkat</th><th>Kembali</th><th>Status</th></tr>
        </thead>
        <tbody>
            @foreach($penggunaan as $p)
            <tr>
                <td>{{ $p->kendaraan->no_plat ?? '-' }}</td>
                <td>{{ $p->pengemudi->nama ?? '-' }}</td>
                <td>{{ $p->tujuan }}</td>
                <td>{{ $p->tanggal_berangkat?->format('d/m/Y') }}</td>
                <td>{{ $p->tanggal_kembali?->format('d/m/Y') ?? '-' }}</td>
                <td>{{ $p->status_label }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
