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
                            <h5 class="fw-bold mb-0">Judul Disetujui</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="form-judul-disetujui.php"><button type="button" class="btn btn-ijo mb-3 text-white shadow"><i class="bi bi-plus-square text-white me-2"></i>Tambah Judul</button></a>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="example" class="table table-striped" style="width: 100%;">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Prodi</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Judul Skripsi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;

                                ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <span class="d-flex">
                                            <a href="edit-judul.php"><button type="button" class="btn btn-success me-2"><i class="bi bi-pencil-square"></i></button></a>
                                            <button type="button" class="btn btn-danger me-2"><i class="bi bi-trash3-fill"></i></button>
                                        </span>
                                    </td>
                                </tr>
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