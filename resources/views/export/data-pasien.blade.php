<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tempat</th>
            <th>No Reg</th>
            <th>Alamat</th>
            <th>Pasien</th>
            <th>Kelamin</th>
            <th>Kategori</th>
            <th>Pemilik</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->namaS }}</td>
                <td>{{ $d->id_hewan }}</td>
                <td>{{ $d->alamat }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->jenis_kelamin }}</td>
                <td>{{ $d->namaB }}</td>
                <td>{{ $d->namaP }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
