<?php 
include('config.php');
include('cek-login.php');
?>

<html>
<head>
<title>Belajar PHP</title>
</head>

<body>
<h1>Data User</h1>

<?php 
if (!empty($_GET['message']) && $_GET['message'] == 'success') {
	echo '<h3>Berhasil meng-update data!</h3>';
} else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
	echo '<h3>Berhasil menghapus data!</h3>';
}
?>

<a href="index.php">+ Tambah Data</a>

<table border="1" cellpadding="5" cellspacing="0">
	<thead>
    	<tr>
        	<td>No.</td>
        	<td>Username</td>
        	<td>Password</td>
        	<td>Opsi</td>
        </tr>
    </thead>
    <tbody>
    <?php 
	$query = mysql_query("select * from user");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $no; ?></td>
        	<td><?php echo $data['username']; ?></td>
        	<td><?php echo $data['password']; ?></td>
            <td>
            	<a href="edit.php?id=<?php echo $data['user_id']; ?>">Edit</a> || 
                <a href="delete.php?id=<?php echo $data['user_id']; ?>">Hapus</a>
            </td>
        </tr>
    <?php 
		$no++;
	} 
	?>
    </tbody>
</table>
</body>
</html>