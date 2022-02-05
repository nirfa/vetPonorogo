@extends('layouts.master')
@section('tambahan-stok','active')
@section('content')

   <div id="main">
      <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
               <i class="bi bi-justify fs-3"></i>
            </a>
      </header>
      <div class="page-heading">
            <h3>Rekap Tambahan Stok</h3>
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
                              <form action="/cek-tambahanStok" method="post" enctype="multipart/form-data" >
                              @csrf
                                 <input type="date" name="tgl_mulai">
                                 <input type="date" name="tgl_selesai">
                                 <button type="submit" class="btn btn-outline-success m-1">Cek</button>
                              </form>

                              <a href="/tambahan-stok">
                                 <button class="btn btn-info m-1">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                    </svg>
                                 </button>
                              </a>

                                       
                              <!-- <a href="/tambah-stok">
                                 <button  class="btn btn-success m-1">
                                 Download
                                 </button>
                              </a> -->
                              </div>
                             
                             
                        </div>
                        
                     </div>
                     <div class="dataTable-container">
                        <table class="table table-striped dataTable-table" id="table1">
                              <thead>
                                    <tr>
                                       <th>No</th>
                                       <th>Obat</th>
                                       <th>Jumlah</th>
                                       <th>Tanggal</th>
                                    </tr>
                                 </thead>
                                 @php
                                    $no=1;
                                 @endphp
                                 @foreach ($tambahan as $t )
                                 <tbody>                                                              
                                    <tr>
                                       <td>{{$no++}}</td>
                                       <td>{{$t->name}}</td>
                                       <td>{{$t->jumlah}}</td>  
                                       <td>{{date('d-m-y', strtotime ($t->created_at))}}</td>                                     
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