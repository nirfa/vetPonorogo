@extends('layouts.master')
@section('pemakaian-obat', 'active')
@section('content')

    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <h3>Riwayat Keuangan</h3>
            <!-- <a href="/tambah-stok">
                   <button  class="btn btn-success">
                     Tambah Stok Obat Baru
                   </button>
                </a> -->
        </div>
        <div class="page-content">
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-top">
                                <div class="dataTable-search ">
                                    <input class="dataTable-input" placeholder="Search..." type="text">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('download-laporan-keuangan') }}">
                                            <button class="btn btn-success ">
                                                Download
                                            </button>
                                        </a>
                                    </div>


                                </div>

                            </div>
                            <div class="dataTable-container">
                                <table class="table table-striped dataTable-table" id="table1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Obat</th>
                                            <th>Kode</th>
                                            <th>Stok Awal</th>
                                            <th>Jumlah Penggunaan</th>
                                            <th>Stok Akhir</th>
                                            <th>Satuan</th>
                                            <th>Harga Terapan</th>
                                            <th>Harga Dasar</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data as $d)
                                        <tbody>
                                            <tr>
                                            <td>{{ $no++ }}</td>
                                             <td>{{ $d->name }}</td>
                                             <td>{{ $d->kode_obat }}</td>
                                             <td>{{ $d->stok_awal }}</td>
                                             <td>{{ $d->jumlah_pemakaian }}</td>
                                             <td>{{ $d->stok_akhir }}</td>
                                             <td>{{ $d->satuan }}</td>
                                             <td>{{ $d->harga_terpakai }}</td>
                                             <td>{{ $d->harga_dasar }}</td>
                                            </tr>
                                        </tbody>
                                    @endforeach

                                </table>
                            </div>
                            <?php
                            $count = DB::table('hewan')->count();
                            ?>

                        </div>
                    </div>
                </div>
        </div>
        </section>
    </div>
    </div>

@endsection
