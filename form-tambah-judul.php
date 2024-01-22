<?php

require_once "config/config.php";
require_once "template/header.php";
require_once "template/navbar.php";
require_once "template/sidebar.php";
// require_once "excel_reader2.php";


?>



<!-- main -->
<main class="mt-5 pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card text-bg-white mb-3 rounded-1 shadow-sm">
                    <div class="card-body">
                        <div class="col-md-12">
                            <h5 class="fw-bold mb-0">Tambah Judul Mahasiswa</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // uji tombol di klik
        if (isset($_POST['btnsimpan'])) {

            // mengambil value yang dipost
            $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
            $simpan = mysqli_query($koneksi, "INSERT INTO tb_judul VALUES ('null','$judul')");

            // jika simpan sukses
            if ($simpan) {
                echo "<script>alert('Simpan Sukses')
                      window.location='tambah-judul.php'
                      </script>";
            } else {
                echo "<script>alert('Simpan Gagal')window.location='tambah-judul.php'</script>";
            }
        }

        ?>

        <form method="post" action="">
            <div class="card mb-3">
                <div class="card-header fw-bold">Tambah Judul</div>
                <div class="card-body">
                    <div class="mb-2">
                        <input type="text" class="form-control" placeholder="Masukkan Judul" name="judul" required />
                    </div>
                    <div>
                        <button type="submit" class="btn btn-ijo mt-2 text-white" name="btnsimpan"><i class="bi bi-floppy me-2"></i>Simpan</button>
                    </div>
                </div>
            </div>
        </form>
        <?php include("import-excel.php") ?>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header fw-bold">Import Judul Excel (XLSX/XLS)</div>
                <div class="card-body">
                    <div class="mb-2">
                        <input type="file" class="form-control" name="importJudul" required />
                    </div>
                    <div>
                        <button type="submit" class="btn btn-ijo mt-2 text-white" name="btnimport"><i class="bi bi-floppy me-2"></i>Import</button>
                    </div>
                </div>
            </div>
        </form>


    </div>


    </div>
</main>
<!-- main -->