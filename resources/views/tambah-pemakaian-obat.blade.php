@extends('layouts.master')
@section('data-pasien', 'active')
@section('content')

    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <h3>Penggunaan Obat</h3>
        </div>
        @if (count($errors) > 0)
            
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="page-content">
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    @foreach ($penyakit as $p)


                                        <div class="row">
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="country-floating">Terapi</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                    name="terapi" disabled>{{ $p->terapi }}</textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="">Pilih Obat</label><br>
                                                <select class="livesearch form-control" width="500px" style="width:full;"
                                                    id="id_stok" name="livesearch"></select>
                                                <!-- <input type="text" placeholder="Enter task" class="form-control " name="id_stok"  id="id_stok" value=""> -->
                                                <font style="color:red">
                                                    {{ $errors->has('id_stok') ? $errors->first('id_stok') : '' }}
                                                </font>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="">Jumlah Obat</label>
                                                <input type="number" class="form-control " name="jumlah" id="jumlah"
                                                    value="">
                                                <font style="color:red">
                                                    {{ $errors->has('jumlah') ? $errors->first('jumlah') : '' }} </font>
                                            </div>
                                            <div class="col-md-2" style="margin-top:26px;">
                                                <button id="addMore" class="btn btn-success btn-sm pull-right">Tambah
                                                    Obat</button>
                                            </div>
                                        </div>
                                        <div class="mt-3"></div>
                                        <form action="/submit/transaksi" method="post">
                                            @csrf
                                            <table class="table table-sm table-bordered" style="display: none;">
                                                <thead>
                                                    <tr>
                                                        <th>Kode Obat</th>
                                                        <th>Nama Obat</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="addRow" class="addRow">

                                                </tbody>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2" class="text-right">
                                                            <strong>Total:</strong>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="estimated_ammount"
                                                                class="estimated_ammount" value="0" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="harga_total"
                                                            name="harga_total" class="harga_total" readonly>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>

                                            <div class="col-12 d-flex justify-content-start">
                                                <button type="submit" class="btn btn-primary me-1 mb-1 mt-3">Simpan
                                                    Obat</button>
                                            </div>

                                        </form>
                                </div>
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
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id+','+item.harga_dasar
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
    @foreach ($penyakit as $p)
        <input name="id_hewan" value="{{ $p->id_hewan }}" >
        <input name="id_status[]" value="{{ $p->id }}" >
        <input name="id_statusT" value="{{ $p->id }}" >
    @endforeach
        <input type="text" name="id_stok[]" value="@{{ id_stok }}" readonly>
    </td>
    <td>
        <input type="text" name="nama_stok[]" value="@{{ nama_stok }}" readonly>
    </td>
    <td>
        <input type="number" class="jumlah" name="jumlah[]" value="@{{ jumlah }}">
    </td>
    <td>
        <input type="text" class="harga_dasar" name="harga_dasar[]" value="@{{ harga_dasar }}">
    </td>
    <td>
    <i class="removeaddmore" style="cursor:pointer;color:red;">Remove</i>
    </td>

    </tr>
    </script>

    <script type="text/javascript">
        $(document).on('click', '#addMore', function() {

            $('.table').show();

            // var id_stok = $("#id_stok :selected").val();
            var id_stok_x = $("#id_stok :selected").val();
            var nama_stok = $("#id_stok :selected").html();
            var jumlah = $("#jumlah").val();
            var source = $("#document-template").html();
            var template = Handlebars.compile(source);

            // tambahan
            var harga = $("#id_stok :selected").val();
            var id_stok = id_stok_x.substr(0, id_stok_x.indexOf(','));
            var harga_dasar = harga.substr(harga.lastIndexOf(',')).match(/[0-9]+$/); 

            
            var data = {
                id_stok: id_stok,
                nama_stok: nama_stok,
                jumlah: jumlah,
                // tambahan
                harga_dasar: harga_dasar,
            }

            var html = template(data);
            $("#addRow").append(html)

            total_ammount_price();
        });

        $(document).on('click', '.removeaddmore', function(event) {
            $(this).closest('.delete_add_more_item').remove();
            total_ammount_price();
        });

        function total_ammount_price() {
            var sum = 0;
            $('.jumlah').each(function() {
                var value = $(this).val();
                if (value.length != 0) {
                    sum += parseFloat(value);
                }
            });
            $('#estimated_ammount').val(sum);

            //tambahan
            const harga_total = $(".jumlah").map(function(i, input) {
                const jumlah = input.value && !isNaN(input.value) ? +input.value : 0;
                let  harga_dasar = $(input).closest("td").next().find("input").val();
                harga_dasar = harga_dasar && !isNaN(harga_dasar) ? +harga_dasar : 0;
                const val = (jumlah * (harga_dasar))
                return val;
            }).get().reduce((acc, cur) => { acc += cur; return acc; }, 0)

            $("#harga_total").val(harga_total.toFixed(0))
        }

    </script>

    // tambahan
    <script>
        $(function () {
            $("tbody#addRow").on("input", function() {
                const estimated_ammount = $(".jumlah").map(function(i, input) {
                    const val = input.value && !isNaN(input.value) ? +input.value : 0;
                    // $(input).closest("tr").find("td").eq(4).text(val)
                    return val;
                }).get().reduce((acc, cur) => { acc += cur; return acc; }, 0)
                $("#estimated_ammount").val(estimated_ammount);
                
                const harga_total = $(".jumlah").map(function(i, input) {
                    const jumlah = input.value && !isNaN(input.value) ? +input.value : 0;
                    let  harga_dasar = $(input).closest("td").next().find("input").val();
                    harga_dasar = harga_dasar && !isNaN(harga_dasar) ? +harga_dasar : 0;
                    const val = (jumlah * (harga_dasar))
                    return val;
                }).get().reduce((acc, cur) => { acc += cur; return acc; }, 0)

                $("#harga_total").val(harga_total.toFixed(0))
            });
        });
    </script>


@endsection

@endsection
