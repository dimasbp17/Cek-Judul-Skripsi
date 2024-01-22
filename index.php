<?php

require_once "config/config.php";
require_once "template/header.php";
require_once "template/navbar.php";
require_once "template/sidebar.php";

if (isset($_SESSION['user'])) {


?>
    <?php
    // $datauser = mysqli_query($koneksi, "SELECT * FROM tb_user");
    // // menghitung data
    // $namauser = mysqli_fetch_assoc($datauser);
    ?>

    <body>
        <!-- main -->
        <main class="mt-5 pt-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card text-bg-white mb-3 rounded-1 shadow-sm">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <h5 class="fw-bold mb-0">Beranda</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                // mengambil data
                $datajudul = mysqli_query($koneksi, "SELECT * FROM tb_judul");
                // menghitung data
                $jumlahjudul = mysqli_num_rows($datajudul);
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card text-bg-primary mb-3 h-80 rounded-1 shadow">
                            <div class="card-header fw-bold">Jumlah Judul</div>
                            <div class="card-body d-flex">
                                <h1 class="card-title fw-bold"><?= $jumlahjudul ?></h1>
                                <span class="ms-auto">
                                    <i class="bi bi-table fs-2 text-muted"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="card text-bg-success mb-3 h-80 rounded-1 shadow">
                            <div class="card-header fw-bold">Judul diterima</div>
                            <div class="card-body d-flex">
                                <h1 class="card-title fw-bold">2000</h1>
                                <span class="ms-auto">
                                    <i class="bi bi-book-half fs-2 text-muted"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-bg-danger mb-3 h-80 rounded-1 shadow">
                            <div class="card-header fw-bold">Header</div>
                            <div class="card-body d-flex">
                                <h1 class="card-title fw-bold">1000</h1>
                                <span class="ms-auto">
                                    <i class="bi bi-journal-plus fs-2 text-muted"></i>
                                </span>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </main>
        <!-- main -->


        <script src="js/script.js"></script>
    </body>

    </html>
<?php
} else {
    header("location:login.php");
}
?>