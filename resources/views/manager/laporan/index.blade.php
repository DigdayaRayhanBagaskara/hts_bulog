@extends('manager.template')
@section('title', 'Tiket')

@section('content')
<div class="row justify-content-center">
    <div class="card p-4 shadow col-sm-12">
        <div class="card-header">
            <form action="/manager/laporan/cetak" target="_blank" method="POST">
                @csrf
                <div class="d-flex align-items-center mb-2">
                    <label for="tanggal_mulai" class="mr-2 mb-0">Mulai:</label>
                    <input type="date" required name="tanggal_mulai" id="tanggal_mulai" class="form-control mr-3"
                        style="max-width: 200px;">

                    <label for="tanggal_selesai" class="mr-2 mb-0">Selesai:</label>
                    <input type="date" required name="tanggal_selesai" id="tanggal_selesai" class="form-control mr-3"
                        style="max-width: 200px;">

                    <button class="btn btn-success ml-auto" type="submit">Cetak</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center align-middle">No</th>
                            <th class="text-center align-middle">Waktu Tiket</th>
                            <th class="text-center align-middle">ID Tiket</th>
                            <th class="text-center align-middle">Nama User</th>
                            <th class="text-center align-middle">Jabatan</th>
                            <th class="text-center align-middle">Area</th>
                            <th class="text-center align-middle">Kategori</th>
                            <th class="text-center align-middle">Subkategori</th>
                            <th class="text-center align-middle">Judul</th>
                            <th class="text-center align-middle">Deskripsi</th>
                            <th class="text-center align-middle">Tanggapan</th>
                            <th class="text-center align-middle">Status</th>
                        </tr>
                    </thead>
                    <tbody id="tiketBody">
                        @foreach($data as $row)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle">{{ \Carbon\Carbon::parse($row->waktu_tiket)->format('d M Y | H:i:s') }}</td>
                            <td class="text-center align-middle">{{ $row->id_tiket }}</td>
                            <td class="text-center align-middle">{{ $row->user->nama }}</td>
                            <td class="text-center align-middle">{{ $row->user->jabatan->nama_jabatan }}</td>
                            <td class="text-center align-middle">{{ $row->user->area->nama_area }} | {{ $row->user->area->tipe_area }}</td>
                            <td class="text-center align-middle">{{ $row->kategori_masalah->nama_kategori }}</td>
                            <td class="text-center align-middle">{{ $row->kategori_masalah->nama_subkategori }}</td>
                            <td class="text-center align-middle">{{ $row->judul }}</td>
                            <td class="text-center align-middle">{{ $row->deskripsi }}</td>
                            <td class="text-center align-middle">{{ $row->tanggapan }}</td>
                            <td class="text-center align-middle">{{ $row->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const data = @json($data); // Mengambil data tiket
        const tanggalMulaiInput = document.getElementById('tanggal_mulai');
        const tanggalSelesaiInput = document.getElementById('tanggal_selesai');
        const tbody = document.getElementById('tiketBody');

        // Format tanggal untuk ditampilkan
        function formatDate(dateStr) {
            const options = { day: '2-digit', month: 'short', year: 'numeric' };
            const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            const date = new Date(dateStr);
            return date.toLocaleDateString('id-ID', options) + ' | ' + date.toLocaleTimeString('id-ID', timeOptions);
        }

        // Render tabel setelah data difilter
        function renderTable(filtered) {
            if (filtered.length === 0) {
                tbody.innerHTML = `<tr><td class="text-center" colspan="12">Tidak ada data untuk rentang tanggal ini</td></tr>`;
                return;
            }

            // Accumulate rows in a single string to improve performance
            let rows = filtered.map((item, index) => `
                <tr>
                    <td class="text-center align-middle">${index + 1}</td>
                    <td class="text-center align-middle">${formatDate(item.waktu_tiket)}</td>
                    <td class="text-center align-middle">${item.id_tiket}</td>
                    <td class="text-center align-middle">${item.user.nama}</td>
                    <td class="text-center align-middle">${item.user.jabatan.nama_jabatan}</td>
                    <td class="text-center align-middle">${item.user.area.nama_area} | ${item.user.area.tipe_area}</td>
                    <td class="text-center align-middle">${item.kategori_masalah.nama_kategori}</td>
                    <td class="text-center align-middle">${item.kategori_masalah.nama_subkategori}</td>
                    <td class="text-center align-middle">${item.judul}</td>
                    <td class="text-center align-middle">${item.deskripsi}</td>
                    <td class="text-center align-middle">${item.tanggapan}</td>
                    <td class="text-center align-middle">${item.status}</td>
                </tr>
            `).join('');

            tbody.innerHTML = rows; // Update the table body once
        }

        // Fungsi filter berdasarkan tanggal
        function filterData() {
            const mulai = tanggalMulaiInput.value;
            const selesai = tanggalSelesaiInput.value;

            if (!mulai || !selesai) return;

            const filtered = data.filter(item => {
                const tanggal = item.waktu_tiket.slice(0, 10); // Extract just the date part
                return tanggal >= mulai && tanggal <= selesai; // Filter by the selected date range
            });

            renderTable(filtered);
        }

        // Event listeners untuk perubahan tanggal
        tanggalMulaiInput.addEventListener('change', filterData);
        tanggalSelesaiInput.addEventListener('change', filterData);
    });
</script>

@endsection
