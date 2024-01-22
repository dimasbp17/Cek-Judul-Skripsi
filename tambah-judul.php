<?php

require_once "config/config.php";
require_once "template/header.php";
require_once "template/navbar.php";
require_once "template/sidebar.php";


?>


<!-- main -->
<main class="mt-5 pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card text-bg-white mb-3 rounded-1 shadow-sm">
                    <div class="card-body">
                        <div class="col-md-12">
                            <h5 class="fw-bold mb-0">Data Judul Mahasiswa</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="form-tambah-judul.php" class="btn btn-ijo text-white mb-3"><i class="bi bi-plus-square text-white me-2"></i>Tambah Judul</a>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="example" class="table table-striped" style="width: 100%;">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $data_judul = mysqli_query($koneksi, "SELECT * FROM tb_judul ORDER BY id DESC");
                                while ($data = mysqli_fetch_array($data_judul)) :
                                ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $data['judul'] ?></td>
                                        <td>
                                            <span class="d-flex">
                                                <!-- <button type="button" class="btn btn-success me-2"><i class="bi bi-pencil-square"></i></button> -->
                                                <?php
                                                // uji tombol di klik
                                                if (isset($_POST['btnhapus'])) {
                                                    // mengambil value yang dihapus
                                                    $id = $_POST['id'];
                                                    $hapus = mysqli_query($koneksi, "DELETE FROM tb_judul WHERE id = '$id'");

                                                    if ($hapus) {
                                                        echo "<script>alert('Data Berhasil Dihapus')
                                                              window.location='tambah-judul.php'
                                                              </script>";
                                                    } else {
                                                        echo "<script>alert('Simpan Gagal')window.location='tambah-judul.php'</script>";
                                                    }
                                                }
                                                ?>
                                                <form method="post" action="">
                                                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                                    <button class="btn btn-danger" id="btnhapus" name="btnhapus"><i class="bi bi-trash3-fill"></i></button>
                                                </form>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- main -->

<script>
    new DataTable('#example');
</script>