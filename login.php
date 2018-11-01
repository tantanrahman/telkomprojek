<?php
session_start();

if (!empty($_SESSION['username'])) {
	header('location:index.php?id=1');
}
?>
<html>
<head>
	<link href='assets/images/icon.png' rel='shortcut icon'>
	<title>Kopeg Aplikasi</title>
	<script type="text/javascript" src="assets/bootstrap/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="assets/bootstrap/js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/style.css">
</head>

<body>

<?php 
//kode php ini kita gunakan untuk menampilkan pesan eror
if (!empty($_GET['error'])) {
	if ($_GET['error'] == 1) {
		echo '<h3><center>Username dan Password belum diisi!</center></h3>';
	} else if ($_GET['error'] == 2) {
		echo '<h3><center>Username belum diisi!</center></h3>';
	} else if ($_GET['error'] == 3) {
		echo '<h3><center>Password belum diisi!</center></h3>';
	} else if ($_GET['error'] == 4) {
		echo '<h3><center>Username dan Password tidak terdaftar!</center></h3>';
	}
}
?>

<form name="login" action="otentikasi.php" method="post">
<center>
	<div class="container">
		<div class="row">
			<div class="col-md-offset-4 col-md-4 login-from">
				<h4><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Halaman Login</h4>
					<div class="form-group">
					    <input type="text" class="form-control" placeholder="Username" name="username">
					</div>
					<div class="form-group">
					    <input type="password" class="form-control" placeholder="Password" name="password">
					</div>
					<hr>
					<div>
	                    <button class="btn btn-default">Login</a></button>
	                </div>
	                <hr>
			</div>
		</div>
	</div>
</center>
</form>
</body>
</html>