@extends('layouts.master')
@section('dashboard','active')
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
         <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">

                    
                    <div class="col-6 col-lg-4 col-md-6">
                        {{-- <a href=""> --}}
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon purple">
                                                <i class="iconly-boldDocument"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Data Pasien</h6>
                                            <?php
                                                $countH = DB::table('hewan')->count();
                                            ?> 
                                           
                                            <h6 class="font-extrabold mb-0"> Total : {{$countH}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- </a> --}}
                    </div>

                    <div class="col-6 col-lg-4 col-md-6">
                        {{-- <a href=""> --}}
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon red">
                                                <i class="iconly-boldBookmark"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Penyakit Pasien</h6>
                                            <?php
                                                $count = DB::table('status_pasien')->count();
                                            ?> 
                                            <h6 class="font-extrabold mb-0">Total : {{$count}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- </a> --}}
                    </div>

                    <!-- <div class="col-6 col-lg-4 col-md-6">
                        {{-- <a href=""> --}}
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon purple">
                                                <i class="iconly-boldDocument"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Obat</h6>
                                            <?php
                                                $countH = DB::table('stok_obat')->count();
                                            ?> 
                                           
                                            <h6 class="font-extrabold mb-0"> Total : {{$countH}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- </a> --}}
                    </div> -->

                    <!-- <div class="col-6 col-lg-4 col-md-6">
                        {{-- <a href=""> --}}
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon purple">
                                                <i class="iconly-boldDocument"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Pengeluaran</h6>
                                            <!-- <?php
                                                $countH = DB::table('hewan')->count();
                                            ?> 
                                           
                                            <h6 class="font-extrabold mb-0"> Total : {{$countH}}</h6> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- </a> --}}
                    </div> -->

                </div>
            </div>
         </section>
      </div>
   </div>

@endsection