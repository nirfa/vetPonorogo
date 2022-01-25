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
            <h3>Data Pemakaian Obat</h3>
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
                                <!-- <div class="dataTable-dropdown">
                                  <select class="dataTable-selector form-select">
                                     <option value="5">5</option>
                                     <option value="10" selected="">10</option>
                                     <option value="15">15</option>
                                     <option value="20">20</option>
                                     <option value="25">25</option>
                                  </select>
                            </div> -->
                                <div class="dataTable-search ">
                                    <input class="dataTable-input" placeholder="Search..." type="text">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('download-pemakaian-obat') }}">
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
                                            <th>Pasien</th>
                                            <th>Alamat</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($pemakaian as $p)
                                        <tbody>
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $p->name }}</td>
                                                <td>{{ $p->nama }}</td>
                                                <td>{{ $p->alamat }}</td>
                                                <td>{{ $p->jumlah }}</td>
                                                <td>{{ date('d-m-y', strtotime($p->created_at)) }}</td>
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
