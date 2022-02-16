@extends('layouts.master')
@section('stok-obat', 'active')
@section('content')

    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <h3>Data Stok Obat</h3>
            <!-- <a href="/tambah-stok">
                       <button  class="btn btn-success">
                         Tambah Stok Obat Baru
                       </button>
                    </a> -->
        </div>
        @if ($message = Session::get('success'))
         <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> {{ $message }} </div>
      @endif
        <div class="page-content">
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-top">
                                <div class="mb-3">
                                    <a href="/tambah-stok">
                                        <button class="btn btn-success">
                                            Tambah Stok Obat Baru
                                        </button>
                                    </a>
                                    <a href="{{ route('download-laporan-obat') }}">
                                        <button class="btn btn-success">
                                            Download Laporan Obat
                                        </button>
                                    </a>
                                    <a href="{{ route('reset-stok') }}" class="reset-confirm">
                                        <button class="btn btn-success ">
                                            Reset Stok
                                        </button>
                                    </a>
                                </div>
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
                                </div>
                            </div>
                            <div class="dataTable-container">
                                <table class="table table-striped dataTable-table" id="table1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Obat</th>
                                            <th>Nama Obat</th>
                                            <th>Stok Awal</th>
                                            <th>Tambahan</th>
                                            <th>Stok Saat Ini</th>
                                            <th>Satuan</th>
                                            <th>Harga Dasar</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($obat as $o)
                                        <tbody>
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $o->kode_obat }}</td>
                                                <td>{{ $o->name }}</td>
                                                <td>{{ $o->stok_awal }}</td>
                                                <td>{{ $o->tambahan }}</td>
                                                <td>{{ $o->stok_akhir }}</td>
                                                <td>{{ $o->satuan }}</td>
                                                <td>@currency($o->harga_dasar)</td>
                                                <td>{{ date('d-m-y', strtotime($o->created_at)) }}</td>
                                                <td>
                                                    <a href="/tambahan/obat/{{ $o->id }}" class="btn btn-info m-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-plus-circle"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path
                                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                        </svg>
                                                    </a>
                                                    <a href="/hapus/{{ $o->id }}" class="btn btn-danger ml-1 delete-confirm"  role="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path
                                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                            <path fill-rule="evenodd"
                                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                        </svg>
                                                    </a>
                                                </td>
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
@section('script')
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
   $('.delete-confirm').on('click', function (event) {
      event.preventDefault();
      const url = $(this).attr('href');
      swal({
          title: 'Apakah anda yakin akan mengahapus data?',
          text: 'data akan terhapus pada tabel!',
          icon: 'warning',
          buttons: ["Cancel", "Ya!"],
          }).then(function(value) {
          if (value) {
          window.location.href = url;
        }
      });
     });
</script>
<script>
   $('.reset-confirm').on('click', function (event) {
      event.preventDefault();
      const url = $(this).attr('href');
      swal({
          title: 'Apakah anda yakin untuk reset stok obat pada bulan ini?',
          text: 'Download laporan obat terlebih dahulu!',
          icon: 'warning',
          buttons: ["Cancel", "Ya!"],
          }).then(function(value) {
          if (value) {
          window.location.href = url;
        }
      });
     });
</script>
@endsection
@endsection
