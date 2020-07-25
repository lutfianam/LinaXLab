<?php
// konfigurasi
define('DB_H', 'localhost');
define('DB_U', 'root');
define('DB_P', '');
define('DB_N', 'linaxlab');

$db_kon = mysqli_connect(DB_H, DB_U, DB_P, DB_N);

if (mysqli_connect_errno()) {
	echo 'Tidak dapat terhubung ke database : ' . mysqli_connect_error();
	exit();
}
// Turn off all error reporting
error_reporting(0);
// Mengambil Author
function GetAuthor($link){
     $data = curl_init();
     curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($data, CURLOPT_URL, $link);
     $hasil = curl_exec($data);
     curl_close($data);
     return $hasil;
}
// Tambah data
if (isset($_POST['tambah'])) {
  $link = addslashes(htmlspecialchars($_POST['link']));
  $author =  GetAuthor($link);
  $author_name = explode('<meta name="author" content="',$author);
  $author_hasil = explode('">',$author_name[1]);
  $nama = $author_hasil[0];
  if (!filter_var($link, FILTER_VALIDATE_URL)) {
    echo("<script>alert('$link Tidak valid!')</script>");
  } else {
    $queryvalid = mysqli_query($db_kon, "SELECT * FROM `lxl_data` WHERE link='$link' OR author='$nama' LIMIT 1");
    $validator  = mysqli_num_rows($queryvalid);
    if ($validator > "0") {
      echo "<script>alert('Data link dan author sudah ada')</script>";
    } else {
      $query = mysqli_query($db_kon, "INSERT INTO `lxl_data` (link, author, date) VALUES('$link', '$nama', NOW())");
      echo "<script>alert('Data berhasil ditambahkan')</script>";
    }
  }
}
// bersihkan data
if (isset($_GET['bersihkan'])) {
    $hapus = mysqli_query($db_kon, "delete FROM lxl_data");
    if($hapus) {
      echo "<script>alert('Data Telah Terhapus Semua')</script>";
    } else {
      echo "<script>alert('Data Gagal Terhapus')</script>";
    }
   echo "<meta http-equiv='refresh' content='1; url=index.php'>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sqli Insert Data | LinaXLab</title>
	<meta charset="UTF-8">
	<meta name="author" content="<marquee>Lutfi Anam</marquee>">
	<style>
	table {
	  font-family: arial, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	}

	td, th {
	  border: 1px solid #dddddd;
	  text-align: left;
	  padding: 8px;
	}

	tr:nth-child(even) {
	  background-color: #dddddd;
	}
	</style>
</head>
<body>
<center><h1>Sqli Insert Data Crawl</h1></center>
<form action="" method="post">
	<input type="text" name="link" placeholder="http://wegihngetik.blogspot.com/">
	<input type="submit" name="tambah" value="+">
</form>
<br>
<table>
  <tr>
    <th>No.</th>
    <th>Author</th>
    <th>Link</th>
    <th>Date</th>
  </tr>
<?php
$linax_q_data = mysqli_query($db_kon, "SELECT * FROM `lxl_data` ORDER BY id");
while ($row_m = mysqli_fetch_assoc($linax_q_data)) {
?>
  <tr>
    <td>1</td>
    <td><?= addslashes(htmlspecialchars($row_m['author'])); ?></td>
    <td><?= addslashes(htmlspecialchars($row_m['link'])); ?></td>
    <td><?= addslashes(htmlspecialchars($row_m['date'])); ?></td>
  </tr>
<?php
}
?>
</table>
<p>Klik <b></b><a href="?bersihkan">disini </a></b>untuk membersihkan table</p>
<p>Copyright By <a href="https://github.com/lutfianam">Lutfi Anam</a></p>
</body>
</html>
