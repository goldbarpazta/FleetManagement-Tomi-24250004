<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kendaraan</title>
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
    <h2>Laporan Kendaraan</h2>
    <p>Tanggal: {{ date('d/m/Y') }}</p>
    <table>
        <thead>
            <tr><th>No. Plat</th><th>Merk/Model</th><th>Jenis</th><th>Tahun</th><th>Kilometer</th><th>Status</th></tr>
        </thead>
        <tbody>
            @foreach($kendaraan as $k)
            <tr>
                <td>{{ $k->no_plat }}</td>
                <td>{{ $k->merk }} {{ $k->model }}</td>
                <td>{{ $k->jenis_label }}</td>
                <td>{{ $k->tahun }}</td>
                <td class="text-end">{{ number_format($k->kilometer) }} km</td>
                <td>{{ $k->status_label }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
