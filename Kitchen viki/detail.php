<?php session_start(); ?>
<?php $koneksi = new mysqli("localhost","root","","kitchenviki"); ?>
<?php 

$id_produk = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk' ");
$detail = $ambil->fetch_assoc();

echo "<pre>";
print_r($detail);
echo "</pre>";


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Detail Produk</title>
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
				<li><a href="riwayat.php">Riwayat Belanja</a></li>
				<li><a href="logout.php">Logout</a></li>

				<?php else : ?>
				<li><a href="login.php">Login</a></li>

				<?php endif  ?>
				<li><a href="checkout.php">Checkout</a></li>
			</ul>
	</div>
	</nav>

	<section class="konten">
		<div class="container">
			<div class="row"> 
			<div class="col-md-6">
				<img src="foto_produk/<?php echo $detail["foto_produk"]; ?>" class="img-responsive"> 
			</div>
			<div class="col-md-6">
				<h2><?php echo $detail["nama_produk"] ?></h2>
				<h4>Rp. <?php  echo number_format($detail["harga_produk"]); ?></h4>

				<h5>Stock : <?php echo $detail['stock_produk'] ?></h5>

				<form method="post">
					<div class="form-group">
						<div class="input-group">
							<input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $detail['stock_produk'] ?>">
							<div class="input-group-btn">
								<button class="btn btn-primary" name="beli">Beli</button>
							</div>
						</div>
					</div>
				</form>

				<?php

				//jika ada tombol beli
				if (isset($_POST["beli"])) 
				{

				//Mendapatkan jumlah yg di input
					$jumlah = $_POST["jumlah"];

				//Masukan keranjang belanja
					$_SESSION["keranjang"][$id_produk] = $jumlah;
					echo "<script>alert('Produk Telah Masuk Ke Keranjang Belanja')</script>";
					echo "<script>location='keranjang.php';</script>";
				}

				 ?>

				<p><?php echo $detail["deskripsi_produk"]; ?></p>
			</div>	
			</div> 
		</div>
	</section>

</body>
</html>