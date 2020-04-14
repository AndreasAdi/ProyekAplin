<?php
    include "DB/database.php";
    session_start();
    if(isset($_POST['register'])){
        $query="SELECT * FROM datauser where Email = :email";
        $stmt = $db->prepare($query); // Prepare statement
        // Binding ke :user
        $stmt->bindValue(":email", $_POST["email"]);
        // Lalu Execute, kita belum dapat hasilnya, caranya bisa kita fetch!
        $result = $stmt->execute();
        // Kamu ambil untuk data per row. setiap fetch akan dapat 1 row
        // Kalau kamu fetchAll() akan dapat semua row as an array
        // Dalam kasus ini, karena kita hanya mau cek apakah ada atau tidak usernya
        // Kita fetch aja, karena kalau next cursornya null, dia akan return false
        $data = $stmt->fetch();
        if($data===false){
            $QueryInsertUser='INSERT INTO datauser(Nama,Alamat,Telepon,City,Email,Password,Gender) VALUES(:nama,:alamat,:telepon,:city,:email,:pass,:gender)';
            try {
                $stmt=$db->prepare($QueryInsertUser);
                $stmt->bindValue(':nama',$_POST['nama'],PDO::PARAM_STR);
                $stmt->bindValue(':pass', password_hash($_POST["password"], PASSWORD_DEFAULT),PDO::PARAM_STR);
                $stmt->bindValue(':alamat',$_POST['Alamat'],PDO::PARAM_STR);
                $stmt->bindValue(':telepon',$_POST['Telepon'],PDO::PARAM_STR);
                $stmt->bindValue(':city',$_POST['city'],PDO::PARAM_STR);
                $stmt->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
                $stmt->bindValue(':gender',$_POST['gender'],PDO::PARAM_STR);
                $result=$stmt->execute();
                echo"<script>alert('Berhasil Register')</script>";
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        else{
            echo"<script>alert('Tidak bisa register,email sudah terdaftar')</script>";
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <Form method='post'>
    <a href="index.php"> <h3 style="text-align:center; float:left; margin-left: 47%;">BioskopID</h3> </a>
    <a href="Register.php" style="float:left; margin-left: 500px;"> <text class="text-primary">Sign Up</text> </a>
    <a href="Ticketing.php" style="float:left; margin-left: 30px;"> <text class="text-secondary">Login</text> </a> 
    <div style="clear: both;"></div>
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="Index.php">BIOSKOPID</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="List_Film.php">List Film</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Meals.php">Pre-Order Snack</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Ticketing.php">Ticketing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Riwayat.php">Riwayat</a>
            </li>
            </ul>
        </div>
        </nav>

    <!-- ISIAN PERTAMA-->
    <div id="isianform" style="width: 400px; height: 600px; margin-left: 30px; margin-top: 30px;">
        <form>
            <div class="form-group">
                <label for="inputName">Nama</label>
                <input type="text" class="form-control" id="inputName" placeholder="Nama Lengkap" name='nama'>
            </div>
            <div class="form-group">
                <label for="inputAddress">Alamat</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Alamat" name='Alamat'>
            </div>
            <div class="form-group">
                <label for="inputAddress2">Telepon</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="+62" name='Telepon'>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity" name='city'>
                </div>
            </div>
            <div class="form-row">            
                <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" name='email'>
                </div>
                <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" id="inputPassword4" name='password'>
                </div>
            </div>
            
            

            <div class="form-group">
                <label for="exampleFormControlSelect2">Gender</label>
                <select class="form-control"  name='gender'>
                    <option value='Laki-Laki'>Laki-Laki</option>
                    <option value='Perempuan'>Perempuan</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" name='register'>Register</button>
        </form>
        </div>
    </form>
    <!--FOOTER-->
    <ul class="nav justify-content-center bg-dark" style="position: fixed; left: 0; bottom: 0; width:100%;">
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Copyright 2020</a>
      </li>
    </ul>
  </body>
</html>