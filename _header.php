<?php 
	require_once('_functions.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>JayClean | Dashboard</title>
	<link rel="stylesheet" href="<?=url('_assets/css/style.css')?>">
	<link rel="shortcut icon" href="<?=url('_assets/img/logo/favico.svg')?>" type="image/x-icon">
</head>
<body>

	<header>
		<nav>
			<div class="logo">
				<a href="<?=url()?>">
					<img src="<?=url('_assets/img/logo/JayCleanText.png')?>" alt="JayClean Logo">
				</a>
			</div>
			<ul class="nav-menu">
				<li>
					<span id=""><?= ucfirst($_SESSION['master']) ?></span>
					<ul class="dropdown-menu">
					<li><a href="<?=url('akun.php')?>">Akun</a></li>
						<li><a href="<?=url('about.php')?>">Tentang Kami</a></li>
						<li><a href="<?=url('logout.php')?>">Logout</a></li>
					</ul>
				</li>
			</ul>
		</nav>
		<div id="nav-mini">
			<a href="<?=url('riwayat_transaksi/riwayat.php')?>" class="link-nav" style="font-size: 18px;">Riwayat Transaksi</a>
			<a href="<?=url('karyawan/karyawan.php')?>" class="link-nav" style="font-size: 18px;">Kelola Karyawan</a>
			<a href="<?=url('paket/paket.php')?>" class="link-nav" style="font-size: 18px;">Daftar Paket</a>
		</div>
	</header>