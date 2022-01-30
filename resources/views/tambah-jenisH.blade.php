@@ -0,0 +1,129 @@
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
            <h3>Tambah Jenis Hewan</h3>
      </div>
      @if ($message = Session::get('success'))
            <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> {{ $message }} </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
      <div class="page-content">
         <section id="basic-horizontal-layouts">
            <div class="row match-height">
               <div class="col-md-6 col-12">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Tambah Kategori Hewan</h4>
                        </div>
                        <div class="card-content">
                           <div class="card-body">
                                 <form class="form form-horizontal" method="post" action="/submit/kategori" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="form-body">
                                       <div class="row">
                                             <div class="col-md-4">
                                                <label>Kategori</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text" id="first-name" class="form-control" name="nama"  >
                                             </div>
                                             @error('nama')
                                             <div class="alert alert-danger alert-dismissible show fade">
                                                {{$message}}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                             </div>
                                             @enderror
                                           
                                             
                                             <div class="col-sm-12 d-flex justify-content-end">
                                               
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                               
                                             </div>
                                       </div>
                                    </div>
                                 </form>
                           </div>
                        </div>
                     </div>
               </div>
            </div>
         </section>

         <section id="basic-horizontal-layouts">
            <div class="row match-height">
               <div class="col-md-6 col-12">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Tambah Jenis Ras</h4>
                        </div>
                        <div class="card-content">
                           <div class="card-body">
                                 <form class="form form-horizontal" method="post" action="/submit/breed" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="form-body">
                                       <div class="row">
                                             <div class="col-md-4">
                                                <label>Kategori</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <select name="id_ktg" class="form-select" id="id_ktg">
                                                      <option value="0">Pilih Kategori Hewan</option>
                                                      @foreach ($kategori as $k )
                                                      <option value="{{ $k->id }}">{{$k->nama }}</option>   
                                                      @endforeach
                                                   </select>
                                             </div>
                                             @error('id_ktg')
                                             <div class="alert alert-danger alert-dismissible show fade">
                                                {{$message}}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                             </div>
                                             @enderror
                                             <div class="col-md-4">
                                                <label>Breed</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text" id="email-id" class="form-control" name="nama"  >
                                             </div>
                                             @error('nama')
                                             <div class="alert alert-danger alert-dismissible show fade">
                                                {{$message}}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                             </div>
                                             @enderror
                                             
                                             
                                             <div class="col-sm-12 d-flex justify-content-end">
                                               
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                               
                                             </div>
                                       </div>
                                    </div>
                                 </form>
                           </div>
                        </div>
                     </div>
               </div>
            </div>
         </section>
    
      </div>
   </div>

@endsection