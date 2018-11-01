<?php
include('config.php');

//tangkap data dari form
$id = $_POST['user_id'];
$password = $_POST['password'];
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$agama = $_POST['agama'];
$no_hp = $_POST['no_hp'];

//update data di database sesuai user_id
$query = mysql_query("update user set password='$password', fullname='$fullname', email='$email', agama='$agama', no_hp='$no_hp' where user_id='$id'") or die(mysql_error());

if ($query) {
	header('location:view.php?message=success');
}
?>