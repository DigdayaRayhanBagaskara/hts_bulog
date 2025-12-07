<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Struk Tiket</title>
    <style>
        body {
            font-family: monospace;
            font-size: 10px;
            width: 58mm;
            margin: 0 auto;
            padding: 5px;
        }

        h4, h5 {
            text-align: center;
            margin: 0;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }

        .section {
            margin-bottom: 8px;
        }

        img {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            display: block;
            margin: 5px 0;
        }

        .footer {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h4>HELP TICKETING SYSTEM</h4>
    <h5>BULOG RIAU & KEPRI</h5>
    <div class="line"></div>
    <div><strong>ID Tiket:</strong> {{$data->id_tiket}}</div>
    <div><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($date)->format('d-m-Y H:i') }}</div>
    <div class="line"></div>

    <div class="section"><strong>Nama:</strong> {{$data->user->nama}}</div>
    <div class="section"><strong>Telp:</strong> {{$data->user->no_telp}}</div>
    <div class="section"><strong>Jabatan:</strong> {{$data->user->jabatan->nama_jabatan}}</div>
    <div class="section"><strong>Area:</strong> {{$data->user->area->nama_area}} - {{$data->user->area->tipe_area}}</div>

    <div class="line"></div>

    <div class="section"><strong>Kategori:</strong> {{$data->kategori_masalah->nama_kategori}}</div>
    <div class="section"><strong>Subkategori:</strong> {{$data->kategori_masalah->nama_subkategori}}</div>
    <div class="section"><strong>Judul:</strong> {{$data->judul}}</div>
    <div class="section"><strong>Deskripsi:</strong><br>{{ $data->deskripsi }}</div>

    @if($data->gambar_tiket)
        <div class="section">
            <strong>Gambar Tiket:</strong>
            <img src="{{ public_path('storage/gambar_tiket/' . $data->gambar_tiket) }}">
        </div>
    @endif

    <div class="line"></div>

    <div class="section"><strong>Tanggapan:</strong><br>{{ $data->tanggapan }}</div>

    @if($data->gambar_tanggapan)
        <div class="section">
            <strong>Gambar Tanggapan:</strong>
            <img src="{{ public_path('storage/gambar_tanggapan/' . $data->gambar_tanggapan) }}" ...>
        </div>
    @endif

    <div class="line"></div>
    <div class="footer">Terima kasih</div>
</body>
</html>
