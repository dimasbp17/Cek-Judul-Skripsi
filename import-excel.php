<?php
require_once "config/config.php";
require_once "vendor/autoload.php";


if (isset($_POST['btnimport'])) {
    $err        = "";
    $ekstensi   = "";
    $success    = "";

    $file_name  = $_FILES['importJudul']['name'];
    $file_data  = $_FILES['importJudul']['tmp_name'];


    if (empty($file_name)) {
        $err = "<li>Silahkan masukkan file yang kamu inginkan</li>";
    } else {
        $ekstensi = pathinfo($file_name)['extension'];
    }



    $ekstensi_allowed = array("xls", "xlsx");
    if (!in_array($ekstensi, $ekstensi_allowed)) {
        $err = "<li>Silahkan masukkan file tipe xls atau xlsx. File yang kamu masukkan <b>$file_name</b> punya tipe <b>$ekstensi</b></li>";
    }

    if (empty($err)) {
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
        $spreadsheet = $reader->load($file_data);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $jumlahData = 0;
        for ($i = 1; $i < count($sheetData); $i++) {
            $judul = htmlspecialchars($sheetData[$i]['0']);

            #echo "$judul </br>";

            $sql = "insert into tb_judul(judul) values ('$judul')";
            mysqli_query($koneksi, $sql);

            $jumlahData++;
            if ($jumlahData > 0) {
                $success = "$jumlahData berhasil dimasukkan ke database";
            }
        };
    }

    if ($err) {
?>
        <div class="alert alert-danger">
            <ul><?= $err ?></ul>
        </div>
    <?php
    }

    if ($success) {
    ?>
        <div class="alert alert-primary">
            <ul><?= $success ?></ul>
        </div>
<?php
    }
};
