@extends('layout.main')

@section('css')
    <style>
        body {
            padding-top: 20px;
            background-color: #f8f9fa;
        }

        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        .list-group-item {
            border: none;
            padding-left: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-10">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Users</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $users }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-1 px-0">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fa-regular fa-users fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4 ">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-10">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Admin</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $user }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-1 px-0">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fa-regular fa-user-tie fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-10">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total History</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $video }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-1 px-0">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fa-regular fa-rectangle-history fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="d-flex flex-column h-100">
                                    <p class="mb-1 pt-2 text-bold">Hi Developers</p>
                                    <h5 class="font-weight-bolder">Kompres Video dengan Efisien Menggunakan Algoritma
                                        Huffman</h5>
                                    <p class="mb-5 text-justify">Optimalkan ukuran video Anda tanpa mengorbankan kualitas!
                                        Aplikasi kompresi video berbasis web kami menggunakan algoritma Huffman yang
                                        terbukti efisien untuk mengurangi ukuran file video dengan tetap menjaga kejernihan
                                        gambar. Tidak perlu aplikasi tambahan, cukup unggah video Anda, kompres dengan
                                        sekali klik, dan unduh hasilnya dalam sekejap. Hemat ruang penyimpanan dan
                                        tingkatkan waktu unggah video ke berbagai platform dengan teknologi kompresi terkini
                                    </p>

                                </div>
                            </div>
                            <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                                <div class="bg-gradient-primary border-radius-lg h-100">
                                    <img src="../assets/img/shapes/waves-white.svg"
                                        class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                                    <div class="position-relative d-flex align-items-center justify-content-center h-100">
                                        <img class="w-100 position-relative z-index-2 pt-4"
                                            src="../assets/img/illustrations/rocket-white.png" alt="rocket">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
