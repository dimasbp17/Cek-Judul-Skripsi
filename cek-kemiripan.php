<?php

require "config/config.php";
require_once "template/header.php";
require_once "template/navbar.php";
require_once "template/sidebar.php";
require_once "algoritma.php";


$checkedTitle = [];

if (isset($_POST['submit'])) {
    $data_judul = mysqli_query($koneksi, "SELECT * FROM tb_judul ORDER BY id DESC");
    $listTitle = [];
    while ($data = mysqli_fetch_assoc($data_judul)) {
        $listTitle[] = $data['judul'];
    }

    $maximumSimilarity = 60;
    $title = $_POST['cekJudul'];
    for ($i = 0; $i < sizeof($listTitle); $i++) {
        $result = checkSimilarity($title, $listTitle[$i]);
        $checkedTitle[] = [
            'title' => $listTitle[$i],
            'union' => $result['union'],
            'intersection' => $result['intersection'],
            'percentage' => number_format($result['percentage'], 2),
        ];
    }

    usort($checkedTitle, function ($val1, $val2) {
        return $val1['percentage'] > $val2['percentage'] ? -1 : 1;
    });



    // if (sizeof($checkedTitle) > 0) {
    //     echo    "<script>
    //                 alert('Judul Duplikat')
    //                 window.location='cek-kemiripan.php'
    //             </script>";
    // } else {
    //     echo    "<script>
    //                 alert('Judul Aman')
    //                 window.location='cek-kemiripan.php'
    //             </script>";
    // }
}


?>

<main class="mt-5 pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card text-bg-white mb-3 rounded-1 shadow-sm">
                    <div class="card-body">
                        <div class="col-md-12">
                            <h5 class="fw-bold mb-0">Cek Kemiripan Judul</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-header">Cek Kemiripan Judul Skripsi</div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="CekJudul" name="cekJudul" placeholder="Masukkan Judul" required />
                    </div>
                    <button class="btn btn-ijo text-white" name="submit"><i class="bi bi-search me-2"></i>Cek Judul</button>

                </form>
            </div>
        </div>

        <div class="card btn-ijo mb-2 text-white ">
            <?php if (isset($_POST['cekJudul'])) : ?>
                <div class="card-header">Judul yang baru saja di cek</div>
                <div class="card-body fw-bold fs-4">
                    <span><?= $_POST['cekJudul'] ?></span>
                </div>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="example" class="table table-striped" style="width: 100%;" />
                        <thead class="table-primary text-center">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col" class="text-center">Judul</th>
                                <th scope="col">Union
                                    (Gabungan Fingerprint)</th>
                                <th scope="col">Intersection
                                    (Fingerprint Sama)</th>
                                <th scope="col">Union-Intersection</th>
                                <th scope="col">Persentase Kemiripan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($checkedTitle as $value) :
                            ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $value['title'] ?></td>
                                    <td><?= $value['union'] ?></td>
                                    <td><?= $value['intersection'] ?></td>
                                    <td><?= $value['union'] - $value['intersection'] ?></td>
                                    <td><?= $value['percentage'] ?>%</td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    new DataTable('#example');
</script>