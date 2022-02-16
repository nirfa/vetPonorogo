@extends('layouts.master')
@section('transaksi', 'active')
@section('content')

    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <?php
            $countP = DB::table('transaksi')->sum('perolehan');
            $countJ = DB::table('transaksi')->sum('jasa');
            $countL = DB::table('transaksi')->sum('laba');
        ?> 
        <div class="page-heading">
            <h3>Riwayat Keuangan</h3>
            <a href="#">
                <button  class="btn btn-outline-primary">
                    Total Perolehan <br>
                    <b>@currency($countP)</b>
                </button>
            </a>
            <a href="#">
                <button  class="btn btn-outline-primary">
                    Total Jasa <br>
                    <b>@currency($countJ)</b>
                </button>
            </a>
            <a href="#">
                <button  class="btn btn-primary">
                    Total Laba <br>
                    <b>@currency($countL)</b>
                </button>
            </a>
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
                                    <form action="/cek-pemakaian" method="post" enctype="multipart/form-data" >
                                        @csrf
                                            <input type="date" name="tgl_mulai">
                                            <input type="date" name="tgl_selesai">
                                            <button type="submit" class="btn btn-outline-success m-1">Cek</button>
                                        </form>

                                        <a href="/pemakaian-obat">
                                            <button class="btn btn-info m-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                                </svg>
                                            </button>
                                        </a>
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
                                            <th>Tanggal</th>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Pendaftaran</th>
                                            <th>Periksa</th>
                                            <th>Injeksi</th>
                                            <th>Peroral</th>
                                            <th>Bahan Medis</th>
                                            <th>Rawat Inap</th>
                                            <th>Sewa Kandang</th>
                                            <th>Kateterisasi</th>
                                            <th>Lainnya</th>
                                     
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($transaksi as $d)
                                        <tbody>
                                            <tr>
                                            <td>{{ $no++ }}</td>
                                             <td>{{ date('d-m-y', strtotime($d->created_at)) }}</td>
                                             <td>{{$d->nama}}</td>
                                             <td>{{$d->namaK}}</td>
                                             <td>@currency2($d->pendaftaran)</td>
                                             <td>@currency2($d->periksa)</td>
                                             <td>@currency2($d->injeksi)</td>
                                             <td>@currency2($d->peroral)</td>
                                             <td>@currency2($d->bahan_medis)</td>
                                             <td>@currency2($d->rawat_inap)</td>
                                             <td>@currency2($d->sewa_kandang)</td>
                                             <td>@currency2($d->kateterisasi)</td>
                                             <td>@currency2($d->lainnya)</td>
                                        
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
