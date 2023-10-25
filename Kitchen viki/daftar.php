<?php $koneksi = new mysqli("localhost","root","","kitchenviki"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Daftar</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>

<!--Navbar-->
	<nav class="navbar navbar-default">
		<div class="container">

			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="keranjang.php">Keranjang</a></li>
				<?php if (isset($_SESSION['pelanggan'])):?>
				<li><a href="logout.php">Logout</a></li>

				<?php else : ?>
				<li><a href="login.php">Login</a></li>
				<li><a href="daftar.php">Daftar</a></li>
				<?php endif  ?>
				
				<li><a href="checkout.php">Checkout</a></li>
			</ul>
	</div>
	</nav>


<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel panel-heading">
					<h3 class="panel-title">Daftar Pelanggan</h3>
				</div>
				<div class="panel-body">
					<form method="post" class="form-horizontal">
						<div class="form-group">
						<label class="control-label col-md-3">Nama</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="nama">
						</div>
						</div>

							<div class="form-group">
						<label class="control-label col-md-3">Email</label>
						<div class="col-md-7">
							<input type="email" class="form-control" name="email" required>
						</div>
						</div>

							<div class="form-group">
						<label class="control-label col-md-3">Password</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="password" required>
						</div>
						</div>

							<div class="form-group">
						<label class="control-label col-md-3">Alamat</label>
						<div class="col-md-7">
							<textarea class="form-control" name="alamat" required></textarea>
						</div>
						</div>

							<div class="form-group">
						<label class="control-label col-md-3">Telp/HP</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="telepon" required>
						</div>
						</div>

						<div class="form-group">
							<div class="col-md-7 col-md-offset-3">
								<button class="btn btn-primary" name="daftar">Daftar</button>
							</div>
						</div>
					</form>

					<?php 
					//jika diekan tombol daftar
					if (isset($_POST["daftar"])) 

					{
						//mengambil data
						$nama = $_POST['nama'];
						$email = $_POST['email'];
						$password = $_POST['password'];
						$alamat = $_POST['alamat'];
						$telepon = $_POST['telepon'];

						//cek plagiat email
						$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
						$yangcocok = $ambil->num_rows;
						if ($yangcocok==1) 
						{
							echo "<script>alert('Pendaftaran Gagal, Email Sudah Digunakan')</script>";
							echo "<script>location='daftar.php'</script>";
						}
						else 
						{
							//input ke data pelanggan
							$koneksi->query("INSERT INTO pelanggan(email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan) VALUES('$email','$password','$nama','$telepon','$alamat')");

							echo "<script>alert('Pendaftaran Sukses, Silahkan Login')</script>";
							echo "<script>location='login.php'</script>";

						}


					}

					 ?>

				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>