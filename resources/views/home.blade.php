<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Ajax Autocomplete Dynamic Search with select2</title>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <style>
        .container {
            max-width: 500px;
        }
        h2 {
            color: white;
        }
    </style>

</head>

<body class="bg-primary">
    <div class="container mt-5">
        <h2>Laravel AJAX Autocomplete Search with Select2</h2>
        <div class="row">
            <div class="col-md-5">
                <label for="">Enter Task</label>
                <select class="livesearch form-control" width="500px" style="width:100px;" id="id_stok" name="livesearch"></select>
                <!-- <input type="text" placeholder="Enter task" class="form-control " name="id_stok"  id="id_stok" value=""> -->
                <font style="color:red"> {{ $errors->has('id_stok') ?  $errors->first('id_stok') : '' }} </font>
            </div>
            <div class="col-md-5">
                <label for="">Enter jumlah</label>
                <input type="number" placeholder="Enter task" class="form-control " name="jumlah"  id="jumlah" value="">
                <font style="color:red"> {{ $errors->has('jumlah') ?  $errors->first('jumlah') : '' }} </font>
            </div>
            <div class="col-md-2" style="margin-top:26px;">
                <button id="addMore" class="btn btn-success btn-sm pull-right">Add More </button>
            </div>
        </div>
        <div class="mt-3"></div>
            <form action="{{ route('task') }}" method="post">
                @csrf
                <table class="table table-sm table-bordered" style="display: none;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Jumlah</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="addRow" class="addRow">

                    </tbody>
                    <tbody>
                        <tr>
                            <td colspan="1" class="text-right">
                                <strong>Total:</strong> 
                            </td>
                            <td>
                                <input type="number" id="estimated_ammount" class="estimated_ammount" value="0" readonly>
                            </td>
                        </tr>
                    </tbody>

                </table>
            
                <div class="col-12 d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary me-1 mb-1 mt-3">Tambah</button>
                </div> 
                
            </form>      

        <!-- <select class="livesearch form-control" width="500px" style="width:100px;"name="livesearch"></select> -->
    </div>
</body>

<script type="text/javascript">
    $('.livesearch').select2({
        placeholder: 'Select movie',
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
            <input type="text" name="id_stok[]" value="@{{ id_stok }}" placeholder=>
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
    
</html>