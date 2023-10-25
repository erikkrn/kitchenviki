<?php 
session_start();
$koneksi = new mysqli("localhost","root","","kitchenviki");
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Pelanggan</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
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

				<?php endif  ?>
				<li><a href="checkout.php">Checkout</a></li>
			</ul>
	</div>
	</nav>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Login Pelanggan</h3>
				</div>
				<div class="panel-body">
					<form method="post">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password">
						</div>
						<button class="btn btn-primary" name="login">Login</button>
					</form>
				</div>
			</div>
			</div>
		</div>
	</div>

<?php 
if (isset($_POST["login"]))
{
	$email = $_POST['email'];
	$password = $_POST['password'];

	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

	$akunyangcocok = $ambil->num_rows;
	if ($akunyangcocok==1)
	{
		$akun = $ambil->fetch_assoc();
		$_SESSION['pelanggan'] = $akun;
		echo "<script>alert('Anda Sukses Login')</script>";

		if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])) 
		{
			echo "<script>location='checkout.php'</script>";
		}

		else
		{
			echo "<script>location='riwayat	.php'</script>";
		}

		echo "<script>location='checkout.php';</script>";
	}	
	else 
	{
		echo "<script>alert('Anda Gagal Login, Periksa Akun Anda');</script>";
		echo "<script>location='login.php';</script>";
	}
}


 ?>


</body>
</html>