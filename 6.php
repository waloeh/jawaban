<?php 

$koneksi = mysqli_connect('localhost', 'root', '', 'gudang');

function tambah($data){
	global $koneksi;
	$nama = htmlspecialchars($data["nama"]);
	$stok = htmlspecialchars($data["stok"]);
	$kategori = htmlspecialchars($data["kategori"]);
	$deskripsi = htmlspecialchars($data["deskripsi"]);

	$query = "INSERT INTO prodak (name, stock, description, id_category) VALUES ('$nama', '$stok', '$deskripsi', '$kategori')";

	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);	
}

function hapus($id){
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM prodak WHERE id = '$id'");

	return mysqli_affected_rows($koneksi);
}

$kategori = mysqli_query($koneksi, "SELECT nama FROM kategori");

$prodakperkategori = mysqli_query($koneksi, "SELECT kategori.nama, prodak.stock, prodak.name FROM kategori INNER JOIN prodak ON kategori.id_category = prodak.id_category");

$detaiProdak = mysqli_query($koneksi, "SELECT kategori.nama, prodak.stock, prodak.name, prodak.description, prodak.id FROM prodak INNER JOIN kategori ON prodak.id_category = kategori.id_category");

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<h1>Bagian A</h1>
 	<h3>Tampilkan semua kategori</h3>
 	<?php 
 		foreach ($kategori as $key ) { ?>

 			<ul>
 				<li><?php echo $key['nama']; ?></li>
 			</ul>
 			
 	<?php } ?>

 	<h3>Prodak per kategori</h3>
 	<?php 
 		foreach ($prodakperkategori as $key) {  ?>
 			<ul>
 				<li>nama kategori => <?php echo $key['nama']; ?></li>
 				<li>stok => <?php echo $key['stock']; ?></li>
 				<li>nama prodak => <?php echo $key['name']; ?></li>
 			</ul>
 	<?php } ?>

 	<h3>Detail Prodak</h3>
 	<?php 
 		foreach ($detaiProdak as $key) { ?>
 			<ul>
 				<li>Kategori :<?php echo $key['nama'];?></li>
 				<li>Nama prodak :<?php echo $key['name'];?></li>
 				<li>Stok :<?php echo $key['stock'];?></li>
 				<li>Deskripsi :<?php echo $key['description'];?></li>
 			</ul>
 	<?php } ?>

	<h1>Bagian B</h1>
	<h3>Membuat CRUD</h3>
	<table border="1" cellspacing="0" cellpadding="10">

	<tr>	
		<th>No</th>
		<th>Nama Produk</th>
		<th>Stok</th>
		<th>Kategori</th>
		<th>Deskripsi</th>
		<th>Aksi</th>
	</tr>

	<?php $i = 1; ?>
	<?php foreach ($detaiProdak as $prd) : ?>
	<tr>
		<td><?php echo $i; ?></td>
	
		<td><?php echo $prd["name"]; ?></td>
		<td><?php echo $prd["stock"]; ?></td>
		<td><?php echo $prd["nama"]; ?></td>
		<td><?php echo $prd["description"]; ?></td>
		<td>
			<a href="#?id=<?php echo $prd['id']; ?>" onclick='confirm("yakin mau dihapus?");'>Hapus</a> |
			<a href="#?id=<?php echo $prd['id']; ?>">Ubah</a>
		</td>
	</tr>
<?php $i++; ?>
<?php endforeach; ?>
</table>

	<h1>Tambah data mahasiswa</h1>

	<form action="#" method="post">
	<ul>
		<li>
			<label for="nrp">Nama prodak :</label>
			<input type="text" name="nama" >
		</li>
		<br>
		<li>
			<label for="name">Stok :</label>
			<input type="text" name="stok" >
		</li>
		<br>
		<li>
			<label for="email">Kategory :</label>
			<select name="kategori">
				<option value="1">Makanan</option>
				<option value="2">Minuman</option>
				<option value="3">Cemilan</option>
			</select>
		</li>
		<br>
		<li>
			<label for="jurus">Deskripsi :</label>
			<input type="text" name="deskripsi">
		</li>
		<br>
		<li>
			<button type="submit" name="simpan">Simpan</button>
		</li>
	</ul>	
			
	</form>
 <?php 
 if (isset($_POST["simpan"])) {
 	if (tambah($_POST) > 0) {
 		echo "<script>alert('berhasil');</script>";
 	}
 	else{
 		echo "<script>alert('gagal');</script>";
 	}
 }
  ?>
 </body>
 </html>
