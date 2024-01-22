// upload file
$target = basename($_FILES['importJudul']['name']);
move_uploaded_file($_FILES['importJudul']['tmp_name'], $target);

// permission
chmod($_FILES['importJudul']['name'], 0777);

// mengambil file excel
$data = new Spreadsheet_Excel_Reader($_FILES['$importJudul']['name'], false);
// menghitung jumlah baris
$jumlahBaris = $data->rowcount($sheet_index = 0);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i = 2; $i <= $jumlahBaris; $i++) { // menangkap data dan memasukkan ke variabel $judul=$data->val($i, 1);

    // pemngujian jika judul
    if ($judul != "") {
    // persiapkan insert data ke database
    mysqli_query($koneksi, "INSERT INTO tb_judul VALUES ('', 'judul')");
    $berhasil++;

    // jika berhasil ditambahkan
    if ($berhasil) {
    echo "<script>
        alert('$berhasil Berhasil Diimpor')
        window.location = 'tambah-judul.php'
    </script>";
    } else {
    echo "<script>
        alert('Simpan Gagal') window.location = 'tambah-judul.php'
    </script>";
    }
    }
    }

    // menghapus file xlx tadi
    unlink($_FILES['importJudul']['name']);

    // alihkan halaman ke index,php
    header("location:index.php?berhasil=$berhasil");