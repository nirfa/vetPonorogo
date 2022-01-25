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
            <h3>Edit Data Pasien</h3>
      </div>
      <div class="page-content">
         <section id="multiple-column-form">
            <div class="row match-height">
                  <div class="col-12">
                     <div class="card">
                        <div class="card-content">
                              <div class="card-body">
                                 @foreach ($pasien as $p )
                                 <form class="form" method="POST" action="/submit/edit-pasien/{{$p->id}}" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden name="id">
                                    <div class="row">
                                          <div class="col-md-6 col-12">
                                             <div class="form-group">
                                                <label for="last-name-column">Nama Pasien</label>
                                                <input type="text" id="last-name-column" class="form-control"  name="nama" value="{{$p->nama}}">
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                          <div class="form-group">
                                             <label for="kategori">Kategori</label>
                                             <select name="kategori" class="form-select" id="basicSelect">
                                                <option value="">Pilih Kategori Hewan</option>
                                                @foreach ($countries as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                             </select>
                                          </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                          <div class="form-group">
                                             <label for="state">Breed</label>
                                             <select name="id_breed" class="form-select" id="basicSelect">
                                             <option>Pilih Jenis Breed</option>
                                             </select>
                                          </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                             <div class="form-group">
                                                <label for="company-column">Tanggal Lahir</label>
                                                <input type="date" id="company-column" class="form-control" name="tgl_lahir" value={{$p->tgl_lahir}}>
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                             <div class="form-group">
                                                <label for="email-id-column">Umur</label>
                                                <input type="text" id="email-id-column" class="form-control" name="umur" value={{$p->umur}}>
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                             <div class="form-group">
                                                <label for="company-column">Jenis Kelamin</label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="basicSelect" name="jenis_kelamin">
                                                       <option value="{{$p->jenis_kelamin}}">Pilih Jenis Kelamin</option>
                                                      <option value="Jantan">Jantan</option>
                                                      <option value="Betina">Betina</option>
                                                    </select>
                                                </fieldset>
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                             <div class="form-group">
                                                <label for="email-id-column">Jenis Penyimpanan</label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="basicSelect" name="id_simpan">
                                                        <option>Pilih Penyimpanan</option>
                                                        @foreach ($penyimpanan as $p )
                                                        <option value="{{$p->id}}">{{$p->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                             </div>
                                          </div>
                                           @endforeach
                                          <div class="col-md-6 col-12">
                                             <div class="form-group">
                                                <label for="email-id-column">Ciri Spesifik</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="ciri_spesifik" >{{$pasien[0]->ciri_spesifik}}</textarea>
                                             </div>
                                          </div>
                                          
                                          
                                          <div class="col-12 d-flex justify-content-end">
                                             <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                           
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

   @section('script')
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
   <script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="kategori"]').on('change',function(){
               var countryID = jQuery(this).val();
               if(countryID)
               {
                  jQuery.ajax({
                     url : 'kategori/breed/' +countryID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="id_breed"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="id_breed"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="id_breed"]').empty();
               }
            });
    });
   </script>
   @endsection
@endsection