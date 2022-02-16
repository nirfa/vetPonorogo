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
            <h3>Tambah Pasien Hewan</h3>
            <a href="/tambah-pemilik">
                <button class="btn btn-success">
                    Tambah Pemilik Baru
                </button>
            </a>
            <a href="/tambah-jenisH">
                <button class="btn btn-dark">
                    Tambah Jenis Hewan
                </button>
            </a>
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
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" method="POST" action="/submit/pasien"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input hidden name="id">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Nama Pemilik</label><br>
                                                    <select class="livesearch form-control" width="500px"
                                                        style="width:full;" id="livesearch" name="id_pemilik"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Nama Pasien</label>
                                                    <input type="text" id="last-name-column" class="form-control"
                                                        name="nama">
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
                                                        <option value="-"></option>
                                                        @foreach ($breed as $data)
                                                          
                                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="company-column">Tanggal Lahir</label>
                                                    <input type="date" id="datepicker" class="form-control"
                                                        name="tgl_lahir">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group row">
                                                    <label for="email-id-column">Umur</label>
                                                    <div class="col-12">
                                                        <input type="text" id="umur" class="form-control" name="umur"
                                                            placeholder="umur" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="company-column">Jenis Kelamin</label>
                                                    <fieldset class="form-group">
                                                        <select class="form-select" id="basicSelect"
                                                            name="jenis_kelamin">
                                                            <option value="">Pilih Jenis Kelamin</option>
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
                                                            @foreach ($penyimpanan as $p)
                                                                <option value="{{ $p->id }}">{{ $p->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Ciri Spesifik</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1"
                                                        rows="3" name="ciri_spesifik"></textarea>
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
        jQuery(document).ready(function() {
            jQuery('select[name="kategori"]').on('change', function() {
                var countryID = jQuery(this).val();
                if (countryID) {
                    jQuery.ajax({
                        url: 'kategori/breed/' + countryID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            jQuery('select[name="id_breed"]').empty();
                            jQuery.each(data, function(key, value) {
                                $('select[name="id_breed"]').append('<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="id_breed"]').empty();
                }
            });
        });
    </script>

    <script type="text/javascript">
        $('.livesearch').select2({
            placeholder: 'Cari nama pemilik hewan',
            ajax: {
                url: '/pemilik-search',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nama,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                showAnim: 'slideDown',
                dateFormat: 'yy-mm-dd'
            });
        });

        window.onload = function() {
            $('#datepicker').on('change', function() {
                var age = getAge(this);
                // console.log(age);
                // var dob = new Date(this.value);
                // console.log(this.value);
                // var today = new Date();
                // var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
                $('#umur').val(age);
            });
        }

        function getAge(dateVal) {
            var
                birthday = new Date(dateVal.value),
                today = new Date(),
                ageInMilliseconds = new Date(today - birthday),
                years = ageInMilliseconds / (24 * 60 * 60 * 1000 * 365.25),
                months = 12 * (years % 1),
                days = Math.floor(30 * (months % 1));
            return Math.floor(years) + ' tahun ' + Math.floor(months) + ' bulan ' + days + ' hari';

        }
    </script>
@endsection
@endsection
