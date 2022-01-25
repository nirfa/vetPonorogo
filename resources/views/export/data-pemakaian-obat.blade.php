<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Obat</th>
            <th>Pasien</th>
            <th>Alamat</th>
            <th>Jumlah</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pemakaian as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->alamat }}</td>
                <td>{{ $p->jumlah }}</td>
                <td>{{ date('d-m-y', strtotime($p->created_at)) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
