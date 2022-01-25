@extends('layouts.master')
@section('stok-obat','active')
@section('content')

   <div id="main">
      <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
               <i class="bi bi-justify fs-3"></i>
            </a>
      </header>
      <div class="page-heading">
            <h3>Stok Obat</h3>
      </div>
      <div class="page-content">
         <section id="basic-horizontal-layouts">
            <div class="row match-height">
               <div class="col-md-6 col-12">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Tambah Stok Obat</h4>
                        </div>
                        <div class="card-content">
                           <div class="card-body">
                                 @foreach ($obat as $o)
                                 <form class="form form-horizontal" method="post" action="/tambah/tambahan-obat" enctype="multipart/form-data" >
                                    @csrf
                                    <input type="text" hidden value="{{$o->id}}" name="id_stok">
                                    <div class="form-body">
                                       <div class="row">
                                             <div class="col-md-4">
                                                <label>Obat</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text" id="email-id" class="form-control" value="{{$o->name}}" disabled>
                                             </div>
                                             <div class="col-md-4">
                                                <label>Jumlah Stok Sekarang</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="number" id="email-id" class="form-control" value="{{$o->stok_akhir}}" disabled >
                                             </div>
                                            
                                             <div class="col-md-4">
                                                <label>Tambah Stok </label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="number" id="email-id" class="form-control" name="jumlah" >
                                             </div>
                                            
                                             
                                             <div class="col-sm-12 d-flex justify-content-end">
                                               
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Tambah</button>
                                               
                                             </div>
                                       </div>
                                    </div>
                                 </form>
                                 @endforeach
                           </div>
                        </div>
                     </div>
               </div>
            </div>
         </section>
    
      </div>
   </div>

@endsection