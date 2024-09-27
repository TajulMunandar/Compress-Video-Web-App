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
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Brand</p>
                                    <h5 class="font-weight-bolder mb-0">

                                    </h5>
                                </div>
                            </div>
                            <div class="col-1 px-0">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fa-duotone fa-gauge fs-3"></i>
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
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Products</p>
                                    <h5 class="font-weight-bolder mb-0">

                                    </h5>
                                </div>
                            </div>
                            <div class="col-1 px-0">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fa-solid fa-bottle-droplet fs-3"></i>
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
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Tipe Kulit </p>
                                    <h5 class="font-weight-bolder mb-0">

                                    </h5>
                                </div>
                            </div>
                            <div class="col-1 px-0">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fa-regular fa-smile fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4 mt-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-10">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Masalah Kulit </p>
                                    <h5 class="font-weight-bolder mb-0">

                                    </h5>
                                </div>
                            </div>
                            <div class="col-1 px-0">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fa-regular fa-face-worried fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4 mt-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-10">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Kategori </p>
                                    <h5 class="font-weight-bolder mb-0">

                                    </h5>
                                </div>
                            </div>
                            <div class="col-1 px-0">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fa-regular fa-bars fs-3"></i>
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
                                    <h5 class="font-weight-bolder">Temukan Skincare Terbaik untuk Anda dengan Rekomendasi
                                        CBF yang Personal</h5>
                                    <p class="mb-5 text-justify">Selamat datang di Rekomendasi Skincare, platform yang
                                        menghubungkan
                                        Anda
                                        dengan produk skincare terbaik melalui metode Content-Based Filtering (CBF). Kami
                                        memahami bahwa setiap kulit memiliki kebutuhan unik, oleh karena itu kami
                                        menggunakan teknologi canggih untuk menganalisis dan merekomendasikan produk
                                        skincare yang paling sesuai untuk Anda.

                                        Jelajahi berbagai produk skincare yang telah disesuaikan berdasarkan preferensi dan
                                        kebutuhan kulit Anda. Dapatkan saran produk yang tepat dan ciptakan rutinitas
                                        perawatan kulit yang efektif dan personal.

                                        Mulai perjalanan perawatan kulit Anda dengan kami hari ini!</p>

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

        <H2 class="mt-4">Sekilas Info Tentang Skincare</H2>

        <div class="row mt-1">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-12 ms-auto text-center mt-5 mt-lg-0">
                                <div class=" border-radius-lg h-100">
                                    <div class="position-relative d-flex align-items-center justify-content-center h-100">
                                        <img class="w-100 position-relative z-index-2 pt-4" src="../assets/img/skin.jpg"
                                            alt="rocket">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex flex-column h-100">
                                    <p class="mb-1 pt-2 text-bold">Hi Patients</p>
                                    <h3 class="font-weight-bolder">Panduan Tata Cara Skincare: Merawat Kulit Anda dengan
                                        Benar</h3>

                                    <section>
                                        <h6>1. Pahami Jenis Kulit Anda</h6>
                                        <p>Sebelum memulai rutinitas skincare, penting untuk mengetahui jenis kulit Anda:
                                            normal, kering, berminyak, kombinasi, atau sensitif. Ini akan membantu Anda
                                            memilih produk yang tepat untuk kebutuhan kulit Anda.</p>
                                    </section>

                                    <section>
                                        <h6>2. Langkah-Langkah Skincare Pagi</h6>
                                        <ul class="list-group">
                                            <li class="list-group-item"><strong>Pembersih (Cleanser)</strong>: Gunakan
                                                pembersih yang sesuai dengan jenis kulit Anda untuk menghilangkan kotoran,
                                                minyak, dan sisa produk skincare malam hari.</li>
                                            <li class="list-group-item"><strong>Toner</strong>: Toner membantu
                                                menyeimbangkan pH kulit dan menghidrasi kulit. Pilih toner yang tidak
                                                mengandung alkohol agar tidak mengeringkan kulit.</li>
                                            <li class="list-group-item"><strong>Serum</strong>: Serum mengandung konsentrasi
                                                bahan aktif yang dapat membantu mengatasi berbagai masalah kulit. Oleskan
                                                serum setelah toner.</li>
                                            <li class="list-group-item"><strong>Pelembap (Moisturizer)</strong>: Pelembap
                                                membantu mengunci kelembapan dan menjaga kulit tetap terhidrasi sepanjang
                                                hari.</li>
                                            <li class="list-group-item"><strong>Tabir Surya (Sunscreen)</strong>:
                                                Menggunakan tabir surya setiap hari untuk melindungi kulit dari sinar UV.
                                                Pilih tabir surya dengan SPF 30 atau lebih tinggi.</li>
                                        </ul>
                                    </section>

                                    <section>
                                        <h6>3. Langkah-Langkah Skincare Malam</h6>
                                        <ul class="list-group">
                                            <li class="list-group-item"><strong>Pembersih (Cleanser)</strong>: Gunakan
                                                pembersih untuk menghilangkan makeup, kotoran, dan minyak dari wajah.</li>
                                            <li class="list-group-item"><strong>Eksfoliasi (2-3 kali seminggu)</strong>:
                                                Eksfoliasi membantu mengangkat sel kulit mati. Gunakan produk eksfoliasi
                                                yang lembut.</li>
                                            <li class="list-group-item"><strong>Toner</strong>: Gunakan toner untuk
                                                menyeimbangkan pH kulit dan mempersiapkan kulit untuk produk berikutnya.
                                            </li>
                                            <li class="list-group-item"><strong>Serum</strong>: Oleskan serum dengan bahan
                                                aktif untuk merawat masalah kulit tertentu.</li>
                                            <li class="list-group-item"><strong>Pelembap (Moisturizer)</strong>: Gunakan
                                                pelembap untuk menjaga kelembapan kulit sepanjang malam.</li>
                                            <li class="list-group-item"><strong>Krim Mata (Opsional)</strong>: Jika Anda
                                                memiliki masalah dengan lingkaran hitam atau pembengkakan di area mata,
                                                gunakan krim mata khusus.</li>
                                        </ul>
                                    </section>

                                    <section>
                                        <h6>4. Tips Tambahan</h6>
                                        <ul class="list-group">
                                            <li class="list-group-item">Konsistensi: Rutinitas skincare harus dilakukan
                                                secara konsisten untuk hasil yang optimal.</li>
                                            <li class="list-group-item">Hidrasi: Selain menggunakan pelembap, pastikan Anda
                                                juga cukup minum air setiap hari.</li>
                                            <li class="list-group-item">Pola Makan Sehat: Makanan yang kaya akan
                                                antioksidan, vitamin, dan mineral dapat mendukung kesehatan kulit Anda.</li>
                                            <li class="list-group-item">Perhatikan Reaksi Kulit: Jika Anda menggunakan
                                                produk baru, perhatikan apakah ada reaksi negatif pada kulit Anda.</li>
                                        </ul>
                                    </section>

                                    <section>
                                        <h6>5. Kesimpulan</h6>
                                        <p>Rutinitas skincare yang tepat dapat membantu menjaga kulit Anda tetap sehat,
                                            bersih, dan bercahaya. Dengan memahami jenis kulit Anda dan mengikuti
                                            langkah-langkah yang sesuai, Anda dapat merawat kulit dengan cara yang efektif
                                            dan bermanfaat.</p>
                                    </section>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
