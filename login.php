<?php
//menyertakan file program koneksi.php pada register
require('koneksi.php');
//inisialisasi session
session_start();

$error = '';
$validate = '';

//mengecek apakah sesssion username tersedia atau tidak jika tersedia maka akan diredirect ke halaman index
if (isset($_SESSION['username'])) header('Location: botP.php');

//mengecek apakah form disubmit atau tidak

if (isset($_POST['submit'])) {
    // Menghilangkan backslashes
    $username = stripslashes($_POST['username']);
    // Cara sederhana mengamankan dari SQL injection
    $username = mysqli_real_escape_string($con, $username);
    // Menghilangkan backslashes
    $password = stripslashes($_POST['password']);
    // Cara sederhana mengamankan dari SQL injection
    $password = mysqli_real_escape_string($con, $password);

    // Cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
    if (!empty(trim($username)) && !empty(trim($password))) {
        // Select data berdasarkan username dari database
        $query  = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($con, $query);
        $rows   = mysqli_num_rows($result);

        if ($rows != 0) {
            $hash = mysqli_fetch_assoc($result)['password'];
            if (password_verify($password, $hash)) {
                $_SESSION['username'] = $username;
                header('Location: botP.php');
            } else {
                $errorMessage = 'Password salah!';
            }
        } else {
            $errorMessage = 'Username tidak ditemukan!';
        }
    } else {
        $errorMessage = 'Data tidak boleh kosong!';
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- costum css -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="container-fluid mb-4">
        <!-- justify-content-center untuk mengatur posisi form agar berada di tengah-tengah -->
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-4">
                <form class="form-container" action="login.php" method="POST">
                    <h4 class="text-center font-weight-bold"> Sign-In </h4>
                    <?php if (isset($errorMessage)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $errorMessage; ?>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
                    </div>
                    <div class="form-group">
                        <label for="InputPassword">Password</label>
                        <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Password">

                    </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
                    <div class="form-footer mt-2">
                        <p> Belum punya account? <a href="register.php">Register</a></p>
                    </div>
                </form>
            </section>
        </section>
    </section>

    <!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan  yang terakhit Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>