<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Kode Obat</th>
            <th>Tambahan</th>
            <th>Stok Awal</th>
            <th>Jumlah Pemakaian</th>
            <th>Stok Akhir</th>
            <th>Satuan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->name }}</td>
                <td>{{ $d->kode_obat }}</td>
                <td>{{ $d->tambahan }}</td>
                <td>{{ $d->stok_awal }}</td>
                <td>{{ $d->jumlah_pemakaian }}</td>
                <td>{{ $d->stok_akhir }}</td>
                <td>{{ $d->satuan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
