<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Compress Video</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="/main"><strong>Compress Video</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <ul class="ms-md-auto navbar-nav justify-content-end">
                    <li class="nav-item dropdown d-flex align-items-center">
                        <!-- Toggle for the dropdown -->
                        <a href="javascript:;" class="nav-link dropdown-toggle text-body font-weight-bold px-0"
                            id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">{{ auth()->user()->name }}</span>
                        </a>

                        <!-- Dropdown menu -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <!-- Main Section -->
    <section class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="display-4">Explore A New Level Of Video</h1>
                    <p>Our products combine elegant design and outstanding performance to bring you the ultimate
                        video experience.</p>

                    <!-- Card with Drag and Drop functionality -->
                    <div class="card border-primary mb-3 text-center" style="max-width: auto;">
                        <div class="card-body" id="dropZonePreOrder">
                            <h5 class="card-title">Compress Now</h5>
                            <input type="file" class="form-control-file d-none" id="preOrderUpload"
                                name="preOrderFile">
                            <p class="drag-text">Drag and drop your file here or click to upload</p>
                            <!-- File Name Display -->
                            <p id="fileNameDisplay" class="text-muted"></p>
                            <!-- Submit Button -->
                        </div>
                        <button id="submitBtn" type="button " class="btn btn-primary d-none p-3">Submit</button>
                    </div>
                </div>

                <div class="col-md-6 text-center">
                    <img src="{{ asset('assets/img/main.jpg') }}" alt="Stereo Speaker" class="img-fluid rounded-circle">
                </div>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <h2 class="text-center mb-4">History</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>File Name</th>
                        <th>Original Size (MB)</th>
                        <th>Compressed Size (MB)</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historys as $history)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $history->name }}</td>
                            <td>{{ number_format($history->ori / 1048576, 2) }} MB</td> <!-- Convert to MB -->
                            <td>{{ number_format($history->comp / 1048576, 2) }} MB</td> <!-- Convert to MB -->
                            <td>{{ $history->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <footer class="text-center py-3" style="background-color: #f5f9ff;">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} dome. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dropZonePreOrder = document.getElementById('dropZonePreOrder');
            var preOrderUpload = document.getElementById('preOrderUpload');
            var fileNameDisplay = document.getElementById('fileNameDisplay');
            var submitBtn = document.getElementById('submitBtn');

            dropZonePreOrder.addEventListener('click', function() {
                preOrderUpload.click();
            });

            preOrderUpload.addEventListener('change', function() {
                displayFileName(preOrderUpload.files);
            });

            dropZonePreOrder.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropZonePreOrder.classList.add('drag-over');
            });

            dropZonePreOrder.addEventListener('dragleave', function() {
                dropZonePreOrder.classList.remove('drag-over');
            });

            dropZonePreOrder.addEventListener('drop', function(e) {
                e.preventDefault();
                dropZonePreOrder.classList.remove('drag-over');
                preOrderUpload.files = e.dataTransfer.files;
                displayFileName(e.dataTransfer.files);
            });

            function displayFileName(files) {
                if (files.length > 0) {
                    fileNameDisplay.textContent = "File: " + files[0].name;
                    submitBtn.classList.remove('d-none');
                } else {
                    fileNameDisplay.textContent = "";
                    submitBtn.classList.add('d-none');
                }
            }

            submitBtn.addEventListener('click', function() {
                var file = preOrderUpload.files[0];
                var formData = new FormData();
                formData.append('file', file); // Sesuaikan dengan nama input

                fetch('http://127.0.0.1:5000/compress', { // Ganti dengan URL Flask Anda
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        console.log('Response:', response); // Log respons untuk debugging
                        return response.json(); // Ambil sebagai JSON
                    })
                    .then(data => {
                        console.log('Data:', data); // Lihat apa isi datanya
                        if (data.message) {
                            alert('Video berhasil dikompres: ' + data.compressed_file_path);
                            console.log('Ukuran Asli:', data.original_size, 'bytes');
                            console.log('Ukuran Setelah Kompres:', data.compressed_size, 'bytes');
                            saveVideoData(data.original_size, data.compressed_size, data
                                .compressed_file_path, data.original_name);
                        } else {
                            alert('Terjadi kesalahan saat mengompresi video');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

            function saveVideoData(originalSize, compressedSize, compressedFilePath, original_name) {
                // Implement API call to save data to Laravel backend
                fetch('/main', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json' // Specify JSON content type
                        },
                        body: JSON.stringify({
                            name: original_name, // Use the original file name
                            ori: originalSize,
                            comp: compressedSize,
                            dir: compressedFilePath
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Data video berhasil disimpan!');
                        } else {
                            alert('Gagal menyimpan data video.');
                        }
                    })
                    .catch(error => {
                        console.error('Error while saving video data:', error);
                    });
            }
        });
    </script>

</body>

</html>
