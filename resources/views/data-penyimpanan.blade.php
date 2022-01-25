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
            @foreach ($data as $d )
            <h3>Data Pasien Penyimpanan {{$d->namaS}}</h3>
            @endforeach
            <a href="/tambah-pasien">
               <button  class="btn btn-success">
                  Tambah Pasien
               </button>
            </a>
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
                        <form action="/pegawai/cari" method="GET">
                        <div class="dataTable-search ">
                              <input class="dataTable-input" type="text" id="myInput" onkeyup="myFunction()" placeholder="Cari nama pasien" title="Type in a name" >
                              <button class="float-end btn  btn-light-primary font-bold" >C3</button>
                              <button class="float-end btn  btn-light-primary font-bold" style="margin-right:10px;">C2</button>
                              <button class="float-end btn  btn-light-primary font-bold" style="margin-right:10px;">C1</button>
                        </div>
                     </div>
                     <div class="dataTable-container">
                        <table class="table table-striped dataTable-table" id="myTable">
                              <thead>
                                    <tr>
                                       <th>No</th>
                                       <th>Penyimpanan</th>
                                       <th>No Registrasi</th>
                                       <th>Pasien</th>
                                       <th>Jenis Kelamin</th>
                                       <th>Kategori</th>
                                       <th>Pemilik</th>
                                       <th>Aksi</th>
                                    </tr>
                                 </thead>
                                 @php
                                    $no=1;
                                 @endphp
                                 @foreach ($data as $d )
                                 <tbody>                                                              
                                    <tr>
                                       <td>{{$no++}}</td>
                                       <td>{{$d -> namaS}}</td>
                                       <td>{{$d -> id}}</td>
                                       <td>{{$d -> nama}}</td>
                                       <td>{{$d -> jenis_kelamin}}</td>
                                       <td>{{$d -> namaB}}</td>
                                       <td>{{$d -> namaP}}</td>
                                       <td>
                                       <a href="/detailpasien/{{$d->id}}" class="btn btn-info m-1">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                          <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                          <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
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
                     @if ($data->lastPage() > 1)
                     <div class="dataTable-bottom">
                        <div class="dataTable-info">Jumlah Penjual {{$count}}</div>
                            <ul class="pagination pagination-primary float-end dataTable-pagination">
                                <li class="{{ ($data->currentPage() == 1) ? ' disabled' : '' }}">
                                    <a href="{{ $data->url(1) }}">Previous</a>
                                </li>
                                @for ($i = 1; $i <= $data->lastPage(); $i++)
                                    <li class="{{ ($data->currentPage() == $i) ? ' active' : '' }}">
                                        <a href="{{ $data->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="{{ ($data->currentPage() == $data->lastPage()) ? ' disabled' : '' }}">
                                    <a href="{{ $data->url($data->currentPage()+1) }}" >Next</a>
                                </li>
                            </ul>
                        </div>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </div>

   @section('script')
   <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
      
   @endsection

@endsection