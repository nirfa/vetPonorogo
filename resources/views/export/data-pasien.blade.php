<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Penyimpanan</th>
            <th>No Registrasi</th>
            <th>Tanggal Registrasi</th>
            <th>Alamat</th>
            <th>Nama Pasien</th>
            <th>Kelamin</th>
            <th>Kategori</th>
            <th>Nama Pemilik</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
            <tr>
            <td>{{ $loop->iteration }}</td>
                <td>{{ $d->namaS }}</td>
                <td>{{ $d->id_hewan }}</td>
                <td>{{date('d-m-y', strtotime ($d->created_at))}}</td>
                <td>{{ $d->alamat }}</td>
                <td>{{ $d->namaH }}</td>
                <td>{{ $d->jenis_kelamin }}</td>
                <td>{{ $d->namaK }}</td>
                <td>{{ $d->namaP }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
