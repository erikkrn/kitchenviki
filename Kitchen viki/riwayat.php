<?php 
session_start();
$koneksi = new mysqli("localhost","root","","kitchenviki");

//jika belum login tapi di akses paksa

if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
{
		echo "<script>alert('Silahkan Login')</script>";
		echo "<script>location='login.php';</script>";
		exit();
}	

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Toko Ktchen Viki</title>
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
				<li><a href="riwayat.php">Riwayat Belanja</a></li>
				<li><a href="logout.php">Logout</a></li>

				<?php else : ?>
				<li><a href="login.php">Login</a></li>
				<li><a href="daftar.php">Daftar</a></li>
				<?php endif  ?>
				
				<li><a href="checkout.php">Checkout</a></li>
			</ul>
	</div>
	</nav>
	<!--<pre><?php print_r($_SESSION) ?></pre>-->
	<section class="riwayat">
		<div class="container">
			<h3>Riwayat Belanja Pelanggan <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h3>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Status</th>
						<th>Total</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$nomor=1; 
					//mendapatkan id pelanggan
					$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

					$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
					while($pecah = $ambil->fetch_assoc()){


					 ?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah["tanggal_pembelian"] ?></td>
						<td>
							<?php echo $pecah["status_pembelian"] ?>
							<br><?php if (!empty($pecah['resi_pengiriman'])): ?>
							Resi : <?php echo $pecah['resi_pengiriman']; ?>
							<?php endif ?>
							</td>
						<td>Rp. <?php echo number_format($pecah["total_pembelian"])?></td>
						<td>
							<a href="nota.php?id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-info">Nota</a>
							<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"];  ?>" class="btn btn-success">Pembayaran</a>
						</td>
					</tr>
					<?php $nomor++; ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</section>

</body>
</html>