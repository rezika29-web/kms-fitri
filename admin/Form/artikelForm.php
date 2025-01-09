<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <div class="topbar-divider d-none d-sm-block"></div>
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username']; ?></span>
                        <img class="img-profile rounded-circle"
                            src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Tambah Artikel</h1>
                <p id="artikelMessage"></p>
            </div>

            <!-- Content Row -->

            <div class="row">
                <div class="col-xl-12 col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="user" id="kategoriForm">
                                    <div class="form-group row">

                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <form id="formArtikel">
                                                <div class="form-group">
                                                    <label for="judul">Judul Artikel</label>
                                                    <input type="text" class="form-control" id="judul" name="judul" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="kategori">Kategori</label>
                                                    <select class="form-control" id="kategori" name="kategori" required>
                                                        <!-- Data kategori akan dimuat secara dinamis -->
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="isi">Isi Artikel</label><br>
                                                    <textarea id="editor" name="isi"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select class="form-control" id="status" name="status" required>
                                                        <option value="draft">Draft</option>
                                                        <option value="publish">Publish</option>
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>

                                        </div>

                                        <!-- <div class="col-sm-6">
                                    <button id="kategoriButton" class="btn btn-primary btn-user btn-block">Tambah Artikel</button>

                                    </div> -->
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
        </div>
        <!-- /.container-fluid -->

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="path/to/ckeditor/ckeditor.js"></script>
<!-- <script>
  CKEDITOR.replace('isi', {
    filebrowserUploadUrl: 'http://localhost:1337/api/upload', // URL untuk upload gambar
    filebrowserUploadMethod: 'form',
  });
</script> -->
    <script>
        let addEditor;
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi CKEditor
            ClassicEditor.create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: 'http://localhost:1337/api/upload', // URL API untuk upload gambar
                },
                toolbar: [
                    'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                    'imageUpload', 'blockQuote', 'undo', 'redo',
                ],
            }).then(editor => {
                addEditor = editor; // Simpan editor untuk mengakses isinya
            }).catch((error) => {
                console.error(error);
            });

            // Load data kategori dari API
            $.ajax({
                url: 'http://localhost:1337/api/kategoris',
                method: 'GET',
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token'),
                },
                success: function(response) {
                    const kategoriSelect = $('#kategori');
                    kategoriSelect.empty();
                    response.data.forEach((kategori) => {
                        kategoriSelect.append(`<option value="${kategori.documentId}">${kategori.Kategori}</option>`);
                    });
                },
                error: function(error) {
                    console.error(error);
                    alert('Gagal memuat data kategori!');
                },
            });
        });
    </script>
    <!-- <script>
        $('#formArtikel').on('submit', function(e) {
            e.preventDefault();

            // Ambil data dari form
            const formData = {
                data: {
                    judul: $('#judul').val(),
                    kategori: $('#kategori').val(),
                    isi: addEditor.getData(),
                    status: $('#status').val(),
                    user_permissions_user: `<?= $_SESSION['documentId']; ?>`,
                },
            };
            console.log(formData);


            // Kirim data ke API
            $.ajax({
                url: 'http://localhost:1337/api/korans',
                method: 'POST',
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token'),
                },
                contentType: 'application/json',
                data: JSON.stringify(formData),
                success: function() {
                    alert('Artikel berhasil ditambahkan!');
                    location.reload(); // Refresh halaman setelah tambah
                },
                error: function(error) {
                    console.error(error);
                    alert('Gagal menambahkan artikel.');
                },
            });
        });
    </script> -->
    <script>
        $('#formArtikel').on('submit', function(e) {
            e.preventDefault();

            // Ambil data dari form
            const judul = $('#judul').val().trim();
            const isi = addEditor.getData().trim();

            // Validasi input
            if (!judul || !isi) {
                alert('Judul dan Isi tidak boleh kosong!');
                return;
            }

            // Bentuk data JSON sesuai skema Strapi
            const formData = {
                data: {
                    Judul: judul,
                    Isi: isi,
                    kategori: $('#kategori').val(),
                    status: $('#status').val(),
                    user_permissions_user: `<?= $_SESSION['documentId']; ?>`,
                },
            };

            // Debug data sebelum mengirim
            console.log('Data yang dikirim:', formData);

            // Kirim data ke API
            $.ajax({
                url: 'http://localhost:1337/api/korans',
                method: 'POST',
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token'),
                },
                contentType: 'application/json',
                data: JSON.stringify(formData),
                success: function() {
                    alert('Artikel berhasil ditambahkan!');
                    location.reload();
                },
                error: function(error) {
                    console.error('Error Response:', error);
                    alert('Gagal menambahkan artikel. Periksa log untuk detail.');
                },
            });
        });
    </script>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2021</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->