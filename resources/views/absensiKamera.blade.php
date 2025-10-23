<!DOCTYPE html>
<html lang="en">
        <!-- Latest compiled and minified CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<!-- Fav Icon-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Camera Link-->

<script src="https://cdn.tailwindcss.com"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Kamera</title>
</head>

<style>
    .endpage{
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 60px; /* Height of the footer */
        background-color: #f5f5f5;
    }
    .hide-on-small {
        display: inline;
    }
    @media (max-width: 500px) {
        .hide-on-small {
            display: none;
        }
    }
</style>

<body>
    <nav>
        <div class="container-fluid bg-light">
            <div class="d-flex flex-row-reverse p-2">
                <a class="btn btn-outline-dark" href="{{ route('logout') }}" role="button"><span class="hide-on-small">Log out </span><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                <a class="btn btn-outline-dark mr-1" href="{{ route('dashboard') }}" role="button"><span class="hide-on-small">Main Menu </span><i class="fa fa-list-ol" aria-hidden="true"></i></a>
            </div>
        </div>
    </nav>
    <main>
        <div class="container mt-5 mb-5">
            <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center">Absensi Wajah</h1>
                        <p class="text-center">Silakan ambil foto untuk absensi.</p>
                        <!-- Form Upload menggunakan Input File -->
                        <form id="uploadFormInputFile" action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="text-center mb-4">
                                <input type="file" id="cameraInput" accept="image/*" capture="camera" style="display:none;"
                                    name="image" required>
                                <button type="button" onclick="openCamera()"
                                    class="px-6 py-3 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 transition-all duration-200">
                                    Ambil Gambar <i class="fas fa-camera-alt" aria-hidden="true"></i>
                                </button>
                            </div>

                            <div class="text-center">
                                <img id="previewImageInputFile" src="" alt="Preview Gambar" class="hidden rounded-md shadow-md"
                                    style="max-width: 200px; margin-top: 10px;">
                            </div>

                            <div class="mt-6 text-center">
                                <button type="submit"
                                    class="px-6 py-3 bg-green-500 text-white rounded-lg shadow-md hover:bg-green-600 transition-all duration-200">
                                    Upload Gambar <i class="fa fa-upload" aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
    // Fungsi untuk membuka kamera menggunakan input file
        function openCamera() {
            const inputFile = document.getElementById('cameraInput');
            inputFile.click();
        }

        // Menampilkan preview gambar dari input file
        document.getElementById('cameraInput').addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewImage = document.getElementById('previewImageInputFile');
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';  // Menampilkan gambar
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>
</html>