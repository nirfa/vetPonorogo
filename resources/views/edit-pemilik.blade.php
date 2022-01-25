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
            <h3>Dashboard Admin</h3>
      </div>
      <div class="page-content">
         <section id="basic-horizontal-layouts">
            <div class="row match-height">
               <div class="col-md-6 col-12">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Tambah Pemilik Hewan</h4>
                        </div>
                        <div class="card-content">
                           <div class="card-body">
                                 @foreach ($pemilik as $p )
                                 <form class="form form-horizontal" method="post" action="/submit/edit-pemilik" enctype="multipart/form-data" >
                                    @csrf
                                    <input type="text" name="id" hidden value="{{$p->id}}">
                                    <input type="text" name="id_hewan" hidden value="{{$p->id_hewan}}">
                                    <div class="form-body">
                                       <div class="row">
                                             <div class="col-md-4">
                                                <label>Nama Lengkap</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text" id="first-name" class="form-control" name="nama" value="{{$p->nama}}" ></input>
                                             </div>
                                             <div class="col-md-4">
                                                <label>No. Handphone</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="number" id="email-id" class="form-control" name="no_hp" value="{{$p->no_hp}}">
                                             </div>
                                             <div class="col-md-4">
                                                <label>Alamat</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text" id="contact-info" class="form-control" name="alamat" value="{{$p->alamat}}" >
                                             </div>
                                             
                                             <div class="col-sm-12 d-flex justify-content-end">
                                               
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                               
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