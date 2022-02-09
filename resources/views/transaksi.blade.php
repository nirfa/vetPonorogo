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
                                 <form class="form form-horizontal" method="post" action="/submit/pemilik" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="form-body">
                                       <div class="row">
                                             <div class="col-md-4">
                                                <label>Pendaftaran</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text"  class="form-control uang" name="pendaftaran" id="pendaftaran" onkeyup="total();" >
                                             </div>
                                             <div class="col-md-4">
                                                <label>Periksa</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text"  class="form-control uang" name="periksa" id="periksa" onkeyup="total();" >
                                             </div>
                                             <div class="col-md-4">
                                                <label>Injeksi</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text"  class="form-control uang" name="injeksi" id="injeksi" onkeyup="total();" >
                                             </div>
                                             <div class="col-md-4">
                                                <label>Peroral</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text"  class="form-control uang" name="peroral" id="peroral"  onkeyup="total();" >
                                             </div>
                                             <div class="col-md-4">
                                                <label>Bahan Medis</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text"  class="form-control uang" name="bahan_medis" id="bahan_medis" onkeyup="total();" >
                                             </div>
                                             <div class="col-md-4">
                                                <label>Rawat Inap</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text"  class="form-control uang" name="rawat_inap" id="rawat_inap" onkeyup="total();" >
                                             </div>
                                             <div class="col-md-4">
                                                <label>Sewa Kandang</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text"  class="form-control uang" name="sewa_kandang" id="sewa_kandang" onkeyup="total();" >
                                             </div>
                                             <div class="col-md-4">
                                                <label>Kateterisasi</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text"  class="form-control uang" name="kateterisasi" id="kateterisasi" onkeyup="total();" >
                                             </div>
                                             <div class="col-md-4">
                                                <label>Lainnya</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                                <input type="text"  class="form-control uang" name="lainnya" id="lainnya"  onkeyup="total();">
                                             </div>
                                             <div class="col-md-4">
                                                <label>Keterangan</label>
                                             </div>
                                             <div class="col-md-8 form-group">
                                             <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="ciri_spesifik"></textarea>
                                             </div>
                                             
                                             
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
               <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Jumlah Transaksi</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Name</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control uang" name="total_jumlah" id="total" readonly  >
                                                </div>
                                            </div>
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

@section('script')
<script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.mask.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function(){

                // Format mata uang.
                $( '.uang' ).mask('000.000.000', {reverse: true});

            });
        </script>
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

		var jumlah_perolehan = parseInt(vpendaftaran) + parseInt(vperiksa) + parseInt(vinjeksi) + parseInt(vperoral) + parseInt(vbahan) + parseInt(vrawat) + parseInt(vsewa) + parseInt(vkatete) + parseInt(vlainnya);

		document.getElementById('total').value = jumlah_perolehan;
		}
		
</script>
@endsection
@endsection