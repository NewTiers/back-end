<?php 
if (isset($_POST['tambahkonfigurasi'])) {
	
	global $connect;

	$sql = mysqli_query($connect,"INSERT INTO konfigurasi (Nama,Tax,Isi,Link,Tipe) VALUES ('".$_POST['nama']."','".$_POST['tax']."','".$_POST['isi']."','".$_POST['link']."','konfigurasi') ");
}

if(isset($_POST['editkonfigurasi'])){

	$count = 0;

	foreach ($_POST['nama'] as $item) {
		
		$sql = "UPDATE konfigurasi SET Nama='".$_POST['nama'][$count]."', Tax='".$_POST['tax'][$count]."', Isi='".$_POST['isi'][$count]."', Link='".$_POST['link'][$count]."' WHERE ID='".$_POST['id'][$count]."' ";

		$hasil = mysqli_query($connect,$sql);

		$count++;

	}
}

if(isset($_GET['act']) && $_GET['act'] == 'hapus' ) {

	$id = (int)$_GET['id'];

	$hasil = mysqli_query($connect,"DELETE FROM konfigurasi WHERE ID='$id' ");

}

if (isset($_POST['uploadlogo'])) {

	if(!empty($_FILES['logositus']['name']) && ($_FILES['logositus']['error'] !== 4 ))
	{
		$filetype = $_FILES['logositus']['type'];

		$allowtype = array('image/jpeg', 'image/jpg', 'image/png');

		if(!in_array($filetype, $allowtype))
		{

			echo 'Invalid file type';

		}else {

			$dest = '../'.PATH_LOGO.'/'.FILE_LOGO;

			copy($_FILES['logositus']['tmp_name'], $dest);

		}

	}

}

if (isset($_POST['uploadicon'])) {

	if(!empty($_FILES['iconsitus']['name']) && ($_FILES['iconsitus']['error'] !== 4 ))
	{
		$filetype = $_FILES['iconsitus']['type'];

		$allowtype = array('image/png','iamge/gif');

		if(!in_array($filetype, $allowtype))
		{

			echo 'Invalid file type';

		}else {

			$dest = '../'.FILE_ICON;

			copy($_FILES['iconsitus']['tmp_name'], $dest);

		}

	}

}


 ?>
<div class="w60 fl">
<form action="./?mod=konfigurasi" method="POST" enctype="multipart/form-data">
	<fieldset>
		<legend>Logo Situs</legend>

		<img src="<?=URL_SITUS.PATH_LOGO.'/'.FILE_LOGO;?>" width="250">

		<div class="clear"></div>

		<input type="file" name="logositus">

		<input type="submit" name="uploadlogo" value="Upload Logo">

	</fieldset>
</form>
</div>

<div class="w40 fl">
<form action="./?mod=konfigurasi" method="POST" enctype="multipart/form-data">
	<fieldset>
		<legend>Icon Situs</legend>

		<img src="<?=URL_SITUS.'/'.FILE_ICON;?>" width="50">

		<div class="clear"></div>

		<input type="file" name="iconsitus">

		<input type="submit" name="uploadicon" value="Upload Icon">

	</fieldset>
</form>
</div>

<div class="clear"></div>

<div class="w100 fl">
	<form action="./?mod=konfigurasi" method="POST">
		<fieldset>
		<legend>Tambah Konfigurasi</legend>

		<div class="w20 fl pd5 bg_dark bold">Nama</div>
		<div class="w15 fl pd5 bg_dark bold">Tax</div>
		<div class="w30 fl pd5 bg_dark bold">Isi</div>
		<div class="w30 fl pd5 bg_dark bold">Link</div>

		<div class="w20 fl pd5 bg_grey">
			<input type="text" name="nama" placeholder="Nama" class="form100">
		</div>
		<div class="w15 fl pd5 bg_grey">
			<input type="text" name="tax" placeholder="Tax" class="form100">
		</div>
		<div class="w30 fl pd5 bg_grey">
			<input type="text" name="isi" placeholder="Isi" class="form100">
		</div>
		<div class="w30 fl pd5 bg_grey">
			<input type="text" name="link" placeholder="Link" class="form100">
		</div>
		<div class="clear pd5"></div>

		<input type="submit" name="tambahkonfigurasi" value="Tambah" class="btn-primary">

		<div class="clear"></div>


		</fieldset>
		

	</form>

</div>

<div class="clear"></div>

<div class="w100 fl">
	<form action="./?mod=konfigurasi" method="POST">
		<fieldset>
		<legend>List Konfigurasi</legend>

		<?php 

		global $connect;
		$hasil = mysqli_query($connect,"SELECT * FROM konfigurasi WHERE Tipe='konfigurasi' ");
		while($r = mysqli_fetch_array($hasil)){
			extract($r);
		 ?>

		 <input type="hidden" name="id[]" value="<?=$ID;?>">

		<div class="w20 fl pd5 bg_grey">
			<input type="text" name="nama[]" value="<?=$Nama?>" class="form100">
		</div>
		<div class="w15 fl pd5 bg_grey">
			<input type="text" name="tax[]" value="<?=$Tax?>" class="form100">
		</div>
		<div class="w30 fl pd5 bg_grey">
			<input type="text" name="isi[]" value="<?=$Isi?>" class="form100">
		</div>
		<div class="w30 fl pd5 bg_grey">
			<input type="text" name="link[]" value="<?=$Link?>" class="w90 fl"> 
			<a href="./?mod=konfigurasi&act=hapus&id=<?=$ID;?>"><span class="pl5 pr5 ml5 bg_dark center"> x </span></a>
		</div>
		<div class="clear pd5"></div>

		<?php 
		}
		 ?>

		<input type="submit" name="editkonfigurasi" value="Edit" class="btn-primary">

		<div class="clear"></div>




	</fieldset>
</form>
</div>
<div class="clear"></div>