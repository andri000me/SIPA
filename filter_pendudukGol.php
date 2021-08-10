<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>SIPA</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
     <!-- JavaScript -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </head>
<body>
<?php
require_once('koneksi.php');

?>
 <div id="wrapper">
<?php 
include"header.php";
?>
</div>
<div id="page-wrapper">
<div class="row" id="contentInput" >
          <div class="col-lg-12">
            <h1>Laporan Penduduk</h1>
            <ol class="breadcrumb">
            <li class="active">Data Sebelum Cetak</li>
            </ol>
          </div>
      </div>
      <a   href="laporan_pendudukSemua.php" type="button" class="btn btn-danger"  style="align:center;"><i class="fa fa-print"></i> CETAK PDF</a>
      <div class="table-responsive-sm">
              <table class="table table-bordered table-hover table-striped">
                <tr>
                  <th>NO</th>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Tempat, Tanggal Lahir</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                  <th>Agama</th>
                  <th>Pendidikan</th>
                  <th>Pekerjaan</th>
                  <th>Status Perkawinan</th>
                  <th>Golongan Darah</th>
                  <th>Nomor Telpon</th>
                </tr>
      <?php
      if(ISSET($_POST['cari'])){
        $no= 1;
       
       $gol=mysqli_real_escape_string($koneksi,$_POST['txtcari']);
        $perintah="SELECT * FROM tb_penduduk WHERE golDarah='$gol'"   ;
         $da=mysqli_query($koneksi,$perintah)or die (mysqli_error($koneksi));;
        
          if(mysqli_num_rows($da) > 0){
           while($row=mysqli_fetch_assoc($da)){
        ?>
    
                <tr>
                  <td align="center"><?php echo $no++; ?></td>
                  <td><?php echo $row['nik']; ?></td>
                  <td><?php echo $row['nama']; ?></td>
                  <td><?php echo $row['tempatLahir'].", ".$row['tanggalLahir']; ?></td>
                  <td><?php echo $row['jenisKelamin']; ?></td>
                  <td><?php echo $row['alamat']." RT.".$row['rt']." RW.".$row['rw']." Kelurahan ".$row['kelurahan']." Kecamatan Lengkong Kota Bandung"; ?></td>
                  <td><?php echo $row['agama']; ?></td>
                  <td><?php echo $row['pendidikan']; ?></td>
                  <td><?php echo $row['pekerjaan']; ?></td>
                  <td><?php echo $row['statusPerkawinan']; ?></td>
                  <td><?php echo $row['golDarah']; ?></td>
                  <td><?php echo $row['nomorTlp']; ?></td>
                   </tr>

               
          <?php
          }
        }
      }
       ?>  