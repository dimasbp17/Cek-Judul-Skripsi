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
                            <h5 class="fw-bold mb-0">Masukkan Judul Disetujui</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleNIM" class="form-label">NIM</label>
                                        <input type="text" class="form-control" id="exampleInputNIM" placeholder="NIM" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputnama" class="form-label">Nama Mahasiswa</label>
                                        <input type="text" class="form-control" id="exampleInputNama" placeholder="Nama Mahasiswa" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Prodi</label>
                                        <select name="prodi" id="prodi" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            <?php
                                            $sql_prodi = mysqli_query($koneksi, "SELECT * FROM tb_prodi") or die(mysqli_error($koneksi));
                                            while ($data_prodi = mysqli_fetch_array($sql_prodi)) {
                                                echo '<option value="' . $data_prodi['id'] . '">' . $data_prodi['prodi'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <!-- <label for="exampleInputPassword1" class="form-label">Prodi</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Prodi" /> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Tahun</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Tahun" />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputJudul" class="form-label">Judul Skripsi</label>
                                <input type="text" class="form-control" id="exampleInputJudul" placeholder="Judul Skripsi" />
                            </div>

                            <div class="d-flex">
                                <a href="judul-disetujui.php"><button type="button" class="btn btn-danger mt-2">Kembali</button></a>
                                <a href="hasilJudul.html" class="ms-auto"><button type="button" class="btn btn-ijo mt-2 ms-auto text-white">Simpan</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- main -->