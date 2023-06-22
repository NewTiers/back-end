<?php 
if (isset($_POST['tambahuser'])) {

	global $connect;
	
	$username = mysqli_real_escape_string($connect,$_POST['username']);
	$password = mysqli_real_escape_string($connect,$_POST['password']);


	$sql = mysqli_query($connect, "SELECT * FROM administrator WHERE username='".$username."' OR Email ='".$_POST['email']."' ");
	$hasil = mysqli_num_rows($sql);

	if ($hasil > 0) {
		
		$error = "Username dan email sudah pernah didaftarkan";

	}else{

		$sql = mysqli_query($connect,"INSERT INTO administrator (Nama,username,password,Email) VALUES ('".$_POST['nama']."','$username','$password','".$_POST['email']."')  ");

		$error = "Berhasil menambahkan user admin baru";

	}

}

if (isset($_POST['edituser'])) {

	$username = mysqli_real_escape_string($connect,$_POST['username']);

	$sql = mysqli_query($connect, "UPDATE administrator SET username='".$username."', Nama ='".$_POST['nama']."', Email='".$_POST['email']."' WHERE ID = '".$_POST['userid']."' ");
	
	$error = "Data user admin berhasil diperbaharui";

	}


if (isset($_GET['act']) && $_GET['act']=='edit') {

	$id = (int)$_GET['id'];
	global $connect;
	
	$sql = mysqli_query($connect,"SELECT * FROM administrator WHERE ID = '$id' ");
	while($b = mysqli_fetch_array($sql)) {
		extract($b);

		$username = $username;
		$nama= $Nama;
		$password = $password;
		$Email = $Email;
	}
	$b = mysqli_fetch_array($sql,MYSQLI_ASSOC);

}

if (isset($_GET['act']) && $_GET['act'] == 'hapus') {

	$id = (int)$_GET['id'];
	
	$sql = mysqli_query($connect,"DELETE FROM administrator WHERE ID = '$id' ");


	$error = "Data user admin berhasil dihapus";

}


?>

<br>
<form action="./?mod=useradmin" method="POST">
	<input type="hidden" name="userid" value="<?=$b['ID']?>">
	<fieldset>
		<legend>Tambah user</legend>

	<div class="formnama">
		<label>Nama User</label><br>
		<input type="text" name="nama" placeholder="Nama Lengkap" value="<?=(isset($_POST['nama']) ? $_POST['nama'] : '');?>" class="form20">
	</div>

	<div class="formnama">
		<label>Username</label><br>
		<input type="text" name="username" placeholder="Username" value="<?=(isset($username) ? $username : '');?>" class="form20">
	</div>

	<div class="formnama">
		<label>Password</label><br>
		<input type="password" name="password">
	</div>

	<div class="formnama">
		<label>Email</label><br>
		<input type="text" name="email" placeholder="Email Address" value="<?=(isset($email) ? $email : '');?>" class="form20">

		
	</div>

	<input type="submit" name="<?=(isset($ID) ? 'edituser' : 'tambahuser');?>" value="<?=(isset($ID) ? 'Edit' : 'Tambah');?>" class="btn-primary">
	</fieldset>
</form>

<fieldset>
	<legend>List user</legend>

	<div class="w100 ">
		<hr>
		<div class="w10 bold fl">No.</div>
		<div class="w30 bold fl">Username</div>
		<div class="w20 bold fl">Nama</div>
		<div class="w20 bold fl">Email</div>
		<div class="w20 bold fl">Aksi</div>
		<div class="clear"></div>
		<hr>
		
		<?php 
		$i= 1;

		$sql = mysqli_query($connect,"SELECT * FROM administrator ORDER BY ID ASC");
		while($r = mysqli_fetch_array($sql)){
			extract($r);

			echo'
			<div class="list">
			<div class="w10 fl">'.$i++.'</div>
			<div class="w30 fl">'.$username.'</div>
			<div class="w20 fl">'.$Nama.'</div>
			<div class="w20 fl">'.$Email.'</div>
			<div class="w20 fl">
			<a href="?mod=useradmin&act=edit&id='.$ID.'" class="small btn btn-primary">Edit</a> <a href="?mod=useradmin&act=hapus&id='.$ID.'" class="small btn btn-red">Hapus</a></div>
			<div class="clear"></div>
			</div>



			';



		}


		 ?>

	</div>

</fieldset>