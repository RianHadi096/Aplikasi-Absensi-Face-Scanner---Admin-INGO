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
    <title>Data Karyawan</title>
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
                <a class="btn btn-outline-dark mr-1" href="{{ route('admin_dashboard') }}" role="button"><span class="hide-on-small">Main Menu </span><i class="fa fa-list-ol" aria-hidden="true"></i></a>
            </div>
        </div>
    </nav>
    <main>
        <div class="container mt-5 mb-5">
            <div class="d-flex justify-content-center">
                <!-- Fetch all data karyawan -->
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center font-bold">Data Karyawan</h1>
                        @if (Session::has('message'))
                        <div class="alert alert-success m-3" role="alert"><center>{{ Session::get('message') }}</center></div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered mt-4">
                                <thead class="align-middle text-center">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Lengkap</th>
                                        <th>Tanggal Lahir</th>
                                        <th>NIK</th>
                                        <th>Bagian</th>
                                        <th>Jabatan</th>
                                        <th>Masuk Kerja</th>
                                        <th>Nomor Handphone</th>
                                        <th>Aksi</th>
                                        <th>Foto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($karyawans as $karyawan)
                                    <tr>
                                        <td>{{ $karyawan->id }}</td>
                                        <td>{{ $karyawan->nama_lengkap }}</td>
                                        <td>{{ $karyawan->tanggal_lahir ? $karyawan->tanggal_lahir->format('d/m/Y') : '' }}</td>
                                        <td>{{ $karyawan->NIK }}</td>
                                        <td>{{ $karyawan->bagian }}</td>
                                        <td>{{ $karyawan->jabatan }}</td>
                                        <td>{{ $karyawan->tanggal_masuk_kerja ? $karyawan->tanggal_masuk_kerja->format('d/m/Y') : '' }}</td>
                                        <td>{{ $karyawan->nomor_handphone }}</td>
                                        <td>
                                            @if($karyawan->imageFileLocation)
                                                <img src="{{ asset('storage/' . $karyawan->imageFileLocation) }}" alt="Foto Karyawan" class="img-thumbnail" style="width: 100px;">
                                            @else
                                                <span class="text-muted">Tidak ada foto</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button 
                                                    class="btn btn-sm btn-primary m-1 edit-btn" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#my-modal-edit-karyawan" 
                                                    data-id="{{ $karyawan->id }}" 
                                                    data-nama="{{ $karyawan->nama_lengkap }}" 
                                                    data-tanggal-lahir="{{ $karyawan->tanggal_lahir ? $karyawan->tanggal_lahir->format('Y-m-d') : '' }}" 
                                                    data-nik="{{ $karyawan->NIK }}" 
                                                    data-bagian="{{ $karyawan->bagian }}"
                                                    data-jabatan="{{ $karyawan->jabatan }}" 
                                                    data-tanggal-masuk="{{ $karyawan->tanggal_masuk_kerja ? $karyawan->tanggal_masuk_kerja->format('Y-m-d') : '' }}" 
                                                    data-handphone="{{ $karyawan->nomor_handphone }}"
                                                    data-image="{{ $karyawan->imageFileLocation }}">
                                                    <span class="hide-on-small">Edit</span><i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button>
                                                <a class="btn btn-sm btn-danger m-1" href="{{ route('hapusKaryawan', $karyawan->id) }}" role="button"><span class="hide-on-small">Delete</span><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#my-modal-tambah-karyawan"><span class="hide-on-small">Tambah Karyawan</span><i class="fa fa-user-circle" aria-hidden="true"></i><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>
                    </div>
            </div>
        </div>
    </main>
    <!--Modal Tambah Karyawan -->
    <div id="my-modal-tambah-karyawan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h1 class="modal-title mb-3 font-semibold text-center">Form Tambah Karyawan<h1>
                        <form action="{{ route('prosesTambahKaryawan') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            </div>
                            <div class="mb-3">
                                <label for="NIK" class="form-label">NIK</label>
                                <input type="text" class="form-control" id="NIK" name="NIK" required>
                            </div>
                            <div class="mb-3">
                                <label for="bagian" class="form-label">Bagian</label>
                                <input type="text" class="form-control" id="bagian" name="bagian" required>
                            </div>
                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_masuk_kerja" class="form-label">Tanggal Masuk Kerja</label>
                                <input type="date" class="form-control" id="tanggal_masuk_kerja" name="tanggal_masuk_kerja" required>
                            </div>
                            <div class="mb-3">
                                <label for="nomor_handphone" class="form-label">Nomor Handphone</label>
                                <input type="text" class="form-control" id="nomor_handphone" name="nomor_handphone" required>
                            </div>
                            <!--Upload Foto Karyawan-->
                            <div class="mb-3">
                                <label for="imageFileLocation" class="form-label">Foto Karyawan</label>
                                <input type="file" class="form-control" id="imageFileLocation" name="imageFileLocation" accept="image/*">
                            </div>
                            <div class="preview-gambar mb-3">
                                <img id="preview-image" src="#" alt="Preview Gambar" style="display: none; max-width: 100%;">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!--Modal Edit Karyawan -->
    <div id="my-modal-edit-karyawan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h1 class="modal-title mb-3 font-semibold text-center">Form Edit Karyawan</h1>
                    <form id="edit-form" action="" method="post">
                        @csrf
                        <input type="hidden" id="edit-id" name="id">
                        <div class="mb-3">
                            <label for="edit-nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="edit-nama_lengkap" name="nama_lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="edit-tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-NIK" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="edit-NIK" name="NIK" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-bagian" class="form-label">Bagian</label>
                            <input type="text" class="form-control" id="edit-bagian" name="bagian" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="edit-jabatan" name="jabatan" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-tanggal_masuk_kerja" class="form-label">Tanggal Masuk Kerja</label>
                            <input type="date" class="form-control" id="edit-tanggal_masuk_kerja" name="tanggal_masuk_kerja" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-nomor_handphone" class="form-label">Nomor Handphone</label>
                            <input type="text" class="form-control" id="edit-nomor_handphone" name="nomor_handphone" required>
                        </div>
                        <!-- Ganti Foto Karyawan-->
                        <div class="mb-3">
                            <label for="edit-imageFileLocation" class="form-label">Foto Karyawan</label>
                            <input type="file" class="form-control" id="edit-imageFileLocation" name="imageFileLocation" accept="image/*">
                        </div>
                        <div class="preview-gambar mb-3">
                                <img id="preview-image" src="#" alt="Preview Gambar" style="display: none; max-width: 100%;">
                            </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        //call id my-modal
        var myModalTambahKaryawan = new bootstrap.Modal(document.getElementById('my-modal-tambah-karyawan'), {
            keyboard: false
        });
        var myModalEditKaryawan = new bootstrap.Modal(document.getElementById('my-modal-edit-karyawan'), {
            keyboard: false
        });

        // Handle edit button click
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const tanggalLahir = this.getAttribute('data-tanggal-lahir');
                const nik = this.getAttribute('data-nik');
                const bagian = this.getAttribute('data-bagian');
                const jabatan = this.getAttribute('data-jabatan');
                const tanggalMasuk = this.getAttribute('data-tanggal-masuk');
                const handphone = this.getAttribute('data-handphone');

                // Populate the form
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-nama_lengkap').value = nama;
                document.getElementById('edit-tanggal_lahir').value = tanggalLahir;
                document.getElementById('edit-NIK').value = nik;
                document.getElementById('edit-bagian').value = bagian;
                document.getElementById('edit-jabatan').value = jabatan;
                document.getElementById('edit-tanggal_masuk_kerja').value = tanggalMasuk;
                document.getElementById('edit-nomor_handphone').value = handphone;

                // Set the form action
                document.getElementById('edit-form').action = '{{ route("prosesEditKaryawan", ":id") }}'.replace(':id', id);
            });
        });

        // Preview image before upload
        document.getElementById('imageFileLocation').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const previewImage = document.getElementById('preview-image');
                previewImage.src = URL.createObjectURL(file);
                previewImage.style.display = 'block';
            }
        });
    </script>
</body>
</html>