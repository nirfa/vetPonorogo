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
            <h3>Edit Pemeriksaan Pasien</h3>
      </div>
      <div class="page-content">
         <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                @foreach ($penyakit as $p )
                                <form class="form" method="post" action="/submit/edit-penyakit/{{$p->id}}" enctype="multipart/form-data" >
                                    @csrf
                                    <input type="text" hidden value="{{$p->id}}" name="id_hewan"> 
                                   <input type="text" hidden value="{{$p->id_hewan}}" name="id_hewan">
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="country-floating">Anamnesa</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="anamnesa">{{$p->anamnesa}}</textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="country-floating">Diagnosa</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="diagnosa">{{$p->diagnosa}}</textarea>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="country-floating">Hasil Pemeriksaan</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="hasil_priksa">{{$p->hasil_priksa}}</textarea>
                                            </div>
                                        </div>
                                        
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="country-floating">Terapi</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="terapi">{{$p->terapi}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
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

@section('script')
<script type="text/javascript">
    $('.livesearch').select2({
        placeholder: 'Pilih Obat',
        ajax: {
            url: '/ajax-autocomplete-search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
</script>

    

<script src="//code.jquery.com/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script> 

    <script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_add_more_item" id="delete_add_more_item">
      
        <td>
        @foreach ($penyakit as $p )
        <input name="id_status[]" value="{{$p->id}}" hidden >
        @endforeach
            <input type="text" name="id_stok[]" value="@{{ id_stok }}" hidden>
            <input type="text" name="id_stok[]" value="@{{ id_stok }}" disabled>
        </td>
        <td>
            <input type="number" class="jumlah" name="jumlah[]" value="@{{ jumlah }}">
        </td>
    
        <td>
        <i class="removeaddmore" style="cursor:pointer;color:red;">Remove</i>
        </td>

    </tr>
    </script>

    <script type="text/javascript">
    
    $(document).on('click','#addMore',function(){
        
        $('.table').show();

        var id_stok = $("#id_stok").val();
        var jumlah = $("#jumlah").val();
        var source = $("#document-template").html();
        var template = Handlebars.compile(source);

        var data = {
            id_stok: id_stok,
            jumlah: jumlah
        }

        var html = template(data);
        $("#addRow").append(html)
    
        total_ammount_price();
    });

    $(document).on('click','.removeaddmore',function(event){
        $(this).closest('.delete_add_more_item').remove();
        total_ammount_price();
    });

    function total_ammount_price() {
        var sum = 0;
        $('.jumlah').each(function(){
        var value = $(this).val();
        if(value.length != 0)
        {
            sum += parseFloat(value);
        }
        });
        $('#estimated_ammount').val(sum);
    }
                        
</script>
        
    
@endsection

@endsection