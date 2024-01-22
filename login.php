<?php

require_once "config/config.php";
require_once "template/header.php";

if (isset($_SESSION['user'])) {
    header("location:index.php");
} else {

?>


    <!-- login -->
    <div class="login-page">
        <div class="card card-login p-4">
            <div class="card-body mt-3">
                <h2 class="card-title text-center fw-bold">L O G I N</h2>
                <h4 class="text-center">Cek Kemiripan Judul Skripsi</h4>
                <div class="mt-5">
                    <?php
                    if (isset($_POST['login'])) {
                        $user = trim(mysqli_real_escape_string($koneksi, $_POST['username']));
                        $pass = md5(trim(mysqli_real_escape_string($koneksi, $_POST['password'])));
                        $sql_login = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$user' AND password = '$pass'") or die(mysqli_errno($koneksi));
                        if (mysqli_num_rows($sql_login) > 0) {
                            $_SESSION['user'] = $user;
                            echo "<script>alert('Login Berhasil')</script>";
                            header("location:index.php");
                        } else {
                            echo "<script>alert('Username/Password Salah!!!')</script>";
                        }
                    }
                    ?>
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="username" class="form-control" name="username" required />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required />
                        </div>

                        <button type="submit" id="btnlogin" class="btn btn-ijo w-100 mt-2 text-white" name="login">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- main -->
<?php
}
?>

<script src="js/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    const btnlogin = document.querySelector('#btnlogin');
    btnlogin.addEventListener('click', function() {
        Swal.fire({
            title: 'Selamat',
            text: 'Anda berhasil Login',
            type: 'success',
        });
    });

    if (mysqli_num_rows($sql_login) > 0) {
        $_SESSION['user'] = $user;
        Swal({
            title: 'Selamat',
            text: 'Anda berhasil Login',
            type: 'success',
        });
    }
</script>