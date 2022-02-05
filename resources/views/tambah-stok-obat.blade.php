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
      @if ($message = Session::get('success'))
         <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> {{ $message }} </div>
      @endif
      <div class="page-content">
     
         <section id="basic-horizontal-layouts">
            <div class="row match-height">
               <div class="col-md-7 col-12">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Tambah Stok Obat</h4>
                        </div>
                        <div class="card-content">
                           <div class="card-body">
                                 <form class="form form-horizontal" method="post" action="/tambah/obat" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="form-body">
                                       <div class="row">
                                             <div class="col-md-4">
                                                <label>Pilih Kode</label>
                                             </div>
                                             <div class="col-md-4 form-group">
                                             <select name="kode"  class="form-select" id="basicSelect" style="width:190px">
                                                <option value="">Kode</option>
                                                @foreach ($kode as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                             </select>
                                             </div>
                                             <!-- <div class="col-md-4">
                                                <label>Kode Barang</label>
                                             </div> -->
                                             <div class="col-md-4 form-group">
                                                <select name="kode_obat" class="form-select" id="basicSelect" style="width:190px">
                                                   <option>Obat</option>
                                                </select>
                                             </div>
                                             <div class="col-md-4">
                                                <label>Satuan</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                 <select name="satuan" class="form-select" id="basicSelect">
                                                    <option value="0">Pilih satuan</option>
                                                    <option value="Ampul">Ampul</option>
                                                    <option value="Buah">Buah</option>
                                                    <option value="Botol">Botol</option>
                                                    <option value="Cm">Cm</option>
                                                    <option value="Kaplet">Kaplet</option>
                                                    <option value="kapsul">Kapsul</option>
                                                    <option value="Ml">Ml</option>
                                                    <option value="Tablet">Tablet</option>
                                                    <option value="Tube">Tube</option>
                                                </select>
                                             </div>
                                             <div class="col-md-4">
                                                <label>Jumlah Stok Awal</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="number" id="email-id" class="form-control" name="stok_awal" >
                                             </div>

                                             <div class="col-md-4">
                                                <label>Harga Dasar</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="number" id="harga" class="form-control" name="harga_dasar" >
                                             </div>

                                             <div class="col-sm-12 d-flex justify-content-end">

                                                <button type="submit" class="btn btn-primary me-1 mb-1">Tambah</button>

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
         @if (count($errors) > 0)
            
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      </div>
   </div>

   @section('script')
   <script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="kode"]').on('change',function(){
               var obatID = jQuery(this).val();
               if(obatID)
               {
                  jQuery.ajax({
                     url : 'kode/obat/' +obatID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="kode_obat"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="kode_obat"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="kode_obat"]').empty();
               }
            });
    });
    </script>
   @endsection

@endsection
