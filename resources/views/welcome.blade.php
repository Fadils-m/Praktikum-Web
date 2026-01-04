<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Donasi</title>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #99fffdff;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .btn-tambah {
            background: #28a745;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        .aksi {
            display: flex;
            gap: 5px;
        }
        .btn-edit {
            background: #007bff;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 12px;
        }
        .btn-hapus {
            background: #dc3545;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 12px;
        }
        img {
            width: 80px;
            height: auto;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>DATA DONASI</h1>
        <a href="/donasi/create" class="btn-tambah">Tambah Data</a>

        <table>
            <thead>
                <tr>
                    <th>GAMBAR</th>
                    <th>NAMA DONATUR</th>
                    <th>JENIS DONASI</th>
                    <th>JUMLAH (Rp/Pcs/Kg)</th>
                    <th>DESKRIPSI</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donasis as $d)
                <tr>
                    <td>
                        @if($d->gambar)
                            <img src="/images/{{ $d->gambar }}" alt="Gambar">
                        @else
                            <span>-</span>
                        @endif
                    </td>
                    <td>{{ $d->nama_donatur }}</td>
                    <td>{{ $d->jenis_donasi }}</td>
                    <td>{{ $d->jumlah}}</td>
                    <td>{{ Str::limit($d->deskripsi, 30) }}</td>
                    <td class="aksi">
                        <a href="/donasi/{{ $d->id }}/edit" class="btn-edit">EDIT</a>
                        <a href="/donasi/{{ $d->id }}/delete" class="btn-hapus" >HAPUS</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>