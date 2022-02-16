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
            <h3>Transaksi Pasien</h3>
      </div>
      <div class="page-content">
         <section id="basic-horizontal-layouts">
            <div class="row match-height">
               <div class="col-md-6 col-12">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Transaksi</h4>
                        </div>
                        <div class="card-content">
                           <div class="card-body">
                              @foreach ($data as $d)
                                 <form class="form form-horizontal" method="post" action="/edit/transaksi/{{ $d->id_status }}" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="form-body">
                                       <div class="row">
                                             <div class="col-md-4">
                                                <label>Pendaftaran</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text"  class="form-control uang" name="pendaftaran" id="pendaftaran" value="{{ $d->pendaftaran }}" onkeyup="total();">
                                             </div>
                                             <div class="col-md-4">
                                                <label>Periksa</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text" class="form-control uang" name="periksa" id="periksa" value="{{ $d->periksa }}" onkeyup="total();" >
                                             </div>
                                             <div class="col-md-4 mb-0">
                                                <label>Injeksi</label>
                                             </div>
                                             <div class="col-md-8 form-group mb-0">
                                                <input type="text" class="form-control uang" name="injeksi" id="injeksi" value="{{ $d->injeksi }}" onkeyup="total();" >
                                             </div>
                                             {{-- tambahan --}}
                                             <div class="col-md-4 mt-0">
                                             </div>
                                             <div class="col-md-8 mt-0">
                                                <p class="col-md-6 badge bg-secondary mt-0"><small>Harga Dasar @currency($d->harga_terapan)</small></p>
                                             </div>
                                             {{-- tambahan --}}
                                             <div class="col-md-4">
                                                <label>Peroral</label>
                                             </div>
                                             @if ($d->peroral != null)
                                                <div class="col-md-8 form-group">
                                                   <input type="text" class="form-control uang" name="peroral" id="peroral" value="{{ $d->peroral }}" onkeyup="total();">
                                                </div>
                                             @else
                                                <div class="col-md-8 form-group">
                                                   <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="radioPeroral" id="radioPeroral" value="1" onclick="showPeroral();">
                                                      <label class="form-check-label" for="inlineRadio1">Ya</label>
                                                   </div>
                                                   <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="radioPeroral" id="radioPeroral" value="0" onclick="hidePeroral();">
                                                      <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                                   </div>
                                                </div>
                                                <div class="col-md-4" style="display: none;" id="divPeroral1">
                                                </div>
                                                <div class="col-md-8 form-group" style="display: none;" id="divPeroral2">
                                                   <input type="text"  class="form-control uang" name="peroral" id="peroral" onkeyup="total();" >
                                                </div>
                                             @endif
                                             <div class="col-md-4">
                                                <label>Bahan Medis</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text"  class="form-control uang" name="bahan_medis" id="bahan_medis" value="{{ $d->bahan_medis }}" onkeyup="total();" >
                                             </div>
                                             <div class="col-md-4">
                                                <label>Rawat Inap</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text" class="form-control uang" name="rawat_inap" id="rawat_inap" value="{{ $d->rawat_inap }}" onkeyup="total();" >
                                             </div>
                                             <div class="col-md-4">
                                                <label>Sewa Kandang</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text"  class="form-control uang" name="sewa_kandang" id="sewa_kandang" value="{{ $d->sewa_kandang }}" onkeyup="total();" >
                                             </div>
                                             {{-- tambahan --}}
                                             <div class="col-md-4">
                                                <label>Kateterisasi</label>
                                             </div>
                                             @if ($d->kateterisasi != null)
                                                <div class="col-md-8 form-group">
                                                   <input type="text"  class="form-control uang" name="kateterisasi" id="kateterisasi" value="{{ $d->kateterisasi }}" onkeyup="total();" >
                                                </div>
                                             @else
                                                <div class="col-md-8 form-group">
                                                   <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="radioKateterisasi" id="radioKateterisasi" value="1" onclick="showJantan();">
                                                      <label class="form-check-label" for="inlineRadio1">Jantan</label>
                                                   </div>
                                                   <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="radioKateterisasi" id="radioKateterisasi" value="0" onclick="showBetina();">
                                                      <label class="form-check-label" for="inlineRadio2">Betina</label>
                                                   </div>
                                                   <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="radioKateterisasi" id="radioKateterisasi" value="none" onclick="hideKateterisasi();">
                                                      <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                                   </div>
                                                </div>
                                                <div class="col-md-4" style="display: none;" id="divKateterisasi1">
                                                </div>
                                                <div class="col-md-8 form-group" style="display: none;" id="divKateterisasi2">
                                                   <input type="text"  class="form-control uang" name="kateterisasi" id="kateterisasi" onkeyup="total();" >
                                                </div>
                                             @endif
                                             <div class="col-md-4">
                                                <label>Lainnya</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text"  class="form-control uang" name="lainnya" id="lainnya" value="{{ $d->lainnya }}" onkeyup="total();">
                                             </div>
                                             <div class="col-md-4">
                                                <label>Keterangan</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                             <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="ciri_spesifik">{{ $d->keterangan }}</textarea>
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
               <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Jumlah Transaksi</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                          {{--<form class="form form-horizontal">--}}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Perolehan</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control uang mb-1" name="total_jumlah" id="totalP" value="@currency($d->perolehan)" readonly  >                                                 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Jasa</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control uang mb-1" name="total_jumlah" id="totalJ" value="@currency($d->jasa)" readonly  >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Alat / Obat</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                   <input type="text" class="form-control uang mb-1" name="total_jumlah" id="totalA" value="@currency($d->alat_obat)" readonly  >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Laba</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                   <input type="text" class="form-control uang mb-1" name="total_jumlah" id="totalA" value="@currency($d->laba )" readonly  >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                             <a href="/data-pasien">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Selesai</button>
                                             </a>
                                          </div>
                                    </div>
                                </div>
                          {{--  </form> --}}
                        </div>
                    </div>
                </div>
            </div>
            </div>
         </section>    
      </div>
   </div>

@section('script')
<script type="text/javascript">
		function total() {
		var vpendaftaran = document.getElementById('pendaftaran').value;
		var vperiksa = document.getElementById('periksa').value;
		var vinjeksi = document.getElementById('injeksi').value;
      var vperoral = document.getElementById('peroral').value;
      var vbahan   = document.getElementById('bahan_medis').value;
      var vrawat   = document.getElementById('rawat_inap').value;
      var vsewa    = document.getElementById('sewa_kandang').value;
      var vkatete  = document.getElementById('kateterisasi').value;
      var vlainnya = document.getElementById('lainnya').value;

      if (vkatete >= 380){
         var vkateteJ = 300000;
         var vkateteA = 80000;
      } else if {
         var vkateteJ = 300000;
         var vkateteA = 70000;
      }

		var jumlah_perolehan = parseInt(vpendaftaran) + parseInt(vperiksa) + parseInt(vinjeksi) + parseInt(vperoral) + parseInt(vbahan) + parseInt(vrawat) + parseInt(vsewa) + parseInt(vkatete) + parseInt(vlainnya);
      var jumlah_jasa      = parseInt(vperiksa) + (parseInt(vperoral) - 10000) + parseInt(vrawat) + vkateteJ;
      var alat_obat        = parseInt(vpendaftaran) + parseInt(vinjeksi) + (parseInt(vperoral) - 5000) + parseInt(vbahan) + parseInt(vsewa) + vkateteA;
		document.getElementById('totalP').value = jumlah_perolehan;
      document.getElementById('totalJ').value = jumlah_jasa;
      document.getElementById('totalA').value = alat_obat;

		}
		
</script>
{{-- tambahan --}}
<script>
   function showPeroral(){
      document.getElementById('divPeroral1').style.display ='block';
      document.getElementById('divPeroral2').style.display ='block';
      document.getElementById("peroral").value = "15000";
   }
   function hidePeroral(){
      document.getElementById('divPeroral1').style.display = 'none';
      document.getElementById('divPeroral2').style.display = 'none';
   }
   function showJantan(){
      document.getElementById('divKateterisasi1').style.display ='block';
      document.getElementById('divKateterisasi2').style.display ='block';
      document.getElementById("kateterisasi").value = "370000";
   }
   function showBetina(){
      document.getElementById('divKateterisasi1').style.display ='block';
      document.getElementById('divKateterisasi2').style.display ='block';
      document.getElementById("kateterisasi").value = "380000";
   }
   function hideKateterisasi(){
      document.getElementById('divKateterisasi1').style.display ='none';
      document.getElementById('divKateterisasi2').style.display ='none';
   }
</script>
@endsection
@endsection