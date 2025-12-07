<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            padding: 20px;
        }

        h2,
        h4 {
            text-align: center;
            margin: 0;
        }

        .header-line {
            border-top: 3px solid #000;
            margin: 10px 0 10px 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 11px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
            vertical-align: top;
        }

        thead {
            background-color: #343a40;
            color: #fff;
        }

        .signature {
            width: 300px;
            text-align: left;
            float: right;
            margin-top: 40px;
        }

        .signature strong {
            display: inline-block;
            margin-top: 60px;
        }

        .signature-title {
            margin-top: 5px;
        }

    </style>
</head>

<body>

    <h2>HELP TICKETING SYSTEM</h2>
    <h4>BULOG KANWIL RIAU & KEPRI</h4>
    <div class="header-line"></div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu Tiket</th>
                <th>ID Tiket</th>
                <th>Nama User</th>
                <th>Jabatan</th>
                <th>Area</th>
                <th>Kategori</th>
                <th>Subkategori</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tanggapan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cetak as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($row->waktu_tiket)->format('d M Y | H:i') }}</td>
                <td>{{ $row->id_tiket }}</td>
                <td>{{ $row->user->nama }}</td>
                <td>{{ $row->user->jabatan->nama_jabatan }}</td>
                <td>{{ $row->user->area->nama_area }} - {{ $row->user->area->tipe_area }}</td>
                <td>{{ $row->kategori_masalah->nama_kategori }}</td>
                <td>{{ $row->kategori_masalah->nama_subkategori }}</td>
                <td>{{ $row->judul }}</td>
                <td>{{ $row->deskripsi }}</td>
                <td>{{ $row->tanggapan }}</td>
                <td>{{ $row->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature">
        Pekanbaru, {{ \Carbon\Carbon::parse($date)->format('d M Y') }}<br>
        <div class="signature-title">{{ Auth::user()->jabatan->nama_jabatan }}</div>
        <div class="signature-title">{{ Auth::user()->area->nama_area }} | {{Auth::user()->area->tipe_area}}</div>
        <strong><u>{{ Auth::user()->nama }}</u></strong><br>
        NIP. {{ Auth::user()->username_nip }}
    </div>

</body>

</html>
