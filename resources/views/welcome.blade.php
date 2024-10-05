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
                            <button id="submitBtn" class="btn btn-primary d-none">Submit</button>
                        </div>
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
                        <th>Original Size</th>
                        <th>Compressed Size</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>video.mp4</td>
                        <td>50 MB</td>
                        <td>20 MB</td>
                        <td>2024-10-01</td>

                    </tr>
                    <tr>
                        <td>2</td>
                        <td>presentation.mp4</td>
                        <td>100 MB</td>
                        <td>40 MB</td>
                        <td>2024-09-28</td>

                    </tr>
                    <tr>
                        <td>3</td>
                        <td>movie.mp4</td>
                        <td>200 MB</td>
                        <td>80 MB</td>
                        <td>2024-09-25</td>

                    </tr>
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
</body>

</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pre-order drop zone
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
            preOrderUpload.files = e.dataTransfer.files; // Set dropped files to input
            displayFileName(e.dataTransfer.files);
        });

        function displayFileName(files) {
            if (files.length > 0) {
                fileNameDisplay.textContent = "File: " + files[0].name; // Show the file name
                submitBtn.classList.remove('d-none'); // Show the submit button
            } else {
                fileNameDisplay.textContent = "";
                submitBtn.classList.add('d-none'); // Hide the submit button
            }
        }
    });
</script>
