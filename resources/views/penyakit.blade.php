@extends('layouts.master')
@section('data-pasien','active')
@section('content')

<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <h3>Riwayat Priksa</h3>
    </div>
    @if ($message = Session::get('success'))
      <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> {{$message}} </div>
    @endif

    @if ($message = Session::get('error'))
      <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
      </div>
    @endif
    <div class="page-content">
    @foreach ($detail as $d )
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <h5>Data Hewan
                                        <a href="/detail/pasien/{{$d->id_hewan}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                                            </svg>
                                        </a>
                                        </h5>
                                        <table class="m-3 mt-0 ml-0 mb-1" width="95%">
                                            <tr>
                                                <td width="25%">Nama Hewan</td>
                                                <td width="25%">: {{$d->namaH}}</td>
                                                <td width="25%">Sex</td>
                                                <td width="20%">: {{$d->jenis_kelamin}}</td>
                                            </tr>
                                            <tr>
                                                <td width="25%">Jenis</td>
                                                <td width="25%">: {{$d->namaK}}</td>
                                                <td width="25%">Umur</td>
                                                <td width="20%">: {{$d->umur}}</td>
                                            </tr>
                                            <tr>
                                                <td width="25%">Breed</td>
                                                <td width="25%">: {{$d->namaB}}</td>
                                            </tr>
                                        </table>
                                        <hr>
                                        <p>Ciri Spesifik : {{$d->ciri_spesifik}}</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <h5>Data Pemilik
                                        <a href="/detail/pemilik/{{$d->id_pemilik}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                                            </svg>
                                        </a>
                                        </h5>
                                        <table class="m-3 mt-0 ml-0 mb-1" width="95%">
                                            <tr>
                                                <td width="25%">Nama Pemilik</td>
                                                <td width="25%">: {{$d->namaP}}</td>

                                            </tr>
                                            <tr>
                                                <td width="25%">No. Handphone</td>
                                                <td width="20%">: {{$d->no_hp}}</td>
                                            </tr>
                                            <tr>
                                                <td width="25%">Alamat</td>
                                                <td width="25%">: {{$d->alamat}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    @foreach ($detail as $d )
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <a href="/tambah-status/{{$d->id_hewan}}">
                                <button class="btn btn-success">Tambah Pemeriksaan</button>
                            </a>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('file-export', $d->id_hewan) }}">
                                <button class="btn btn-success">Download Data</button>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    <thead>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Anamnesa</th>
                        <th>Hasil Pemeriksaan</th>
                        <th>Diagnosa</th>
                        <th>Terapi</th>
                        <th>Aksi</th>
                    </thead>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($penyakit as $p )
                    <tbody>
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{date('d-m-y', strtotime($p -> created_at)) }}</td>
                            <td>{{$p->anamnesa}}</td>
                            <td>{{$p->hasil_priksa}}</td>
                            <td>{{$p->diagnosa}}</td>
                            <td>{{$p->terapi}}</td>
                            <td>
                                <a href="/edit/penyakit/{{$p->id}}" type="button" class="btn btn-warning mb-1" title="Detail & Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                                    </svg>
                                </a>
                                <a href="/hapus/penyakit/{{$p->id}}" class="btn btn-danger mb-1" onclick="return confirm('Yakin untuk Menghapus Data?')" data-toggle="tooltip" data-placement="top" title="Hapus Data">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>

    </section>
    </div>
</div>

@endsection
