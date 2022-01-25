<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Anamnesa</th>
            <th>Hasil Pemeriksaan</th>
            <th>Diagnosa</th>
            <th>Terapi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($penyakit as $dt)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ date('d-m-y', strtotime($dt-> created_at)) }}</td>
                <td>{{ $dt->anamnesa }}</td>
                <td>{{ $dt->hasil_priksa }}</td>
                <td>{{ $dt->diagnosa }}</td>
                <td>{{ $dt->terapi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
