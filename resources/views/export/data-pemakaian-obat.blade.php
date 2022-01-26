<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Kode Obat</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pemakaian as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->kode_obat }}</td>
                <td>{{ $p->tanggal }}</td>
                <td>{{ $p->total }}</td>
                <td>{{ $p->harga_total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
