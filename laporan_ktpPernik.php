<?php
require('assets/phpfpdf/fpdf.php');
include'koneksi.php';

class PDF extends FPDF
{
  function Header(){
    //logo
    $this->Image('assets/logo/logo.png',45,12,27);
     
     //geser kanan 35 mm
     $this->Cell(60);
     //judul
     $this->SetFont('Arial','B',16);
     $this->Cell(30,7,'PEMERINTAH KOTA BANDUNG',0,1,'L');
      $this->Cell(67);
     $this->SetFont('Arial','B',16);
     $this->Cell(30,7,'KECAMATAN LENGKONG',0,1,'L');
     
     $this->Cell(60);
     $this->SetFont('Arial','i',10  );
     $this->Cell(30,7,'Jl.Talaga Bodas No.35  Tel/Fax 022-7310219 Bandung-40262',0,1,'L');
     //garis bawah double
     $this->Cell(185,1,'','B',1,'L');
     $this->Cell(185,1,'','B',0,'L');

     //line break 5mm
      $this->Ln(5);
  } 
  
}
//instance objek dan memberikan pengaturan halaman pdf
$pdf=new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->SetMargins(15,15,15);
$pdf->AddPage();

 if(ISSET($_POST['cetak'])){
        
       $cari=mysqli_real_escape_string($koneksi,$_POST['txtcari']);
       

 
                      $query="SELECT * FROM tb_permohonanktp as p JOIN tb_penduduk as d ON p.nik=d.nik where p.nik='$cari' OR no_permohonanKtp='$cari' OR nama LIKE '%$cari%'";
                      $result=mysqli_query($koneksi,$query);
                      if(!$result){
                        die("query error:".mysqli_errno($koneksi)."-".mysqli_error($koneksi));
                      }
                      if(mysqli_num_rows($result) > 0){
                      $data=mysqli_fetch_assoc($result);    
                  
$fo=$data['foto'];
$tglRekam=$data['tglRekam'];

$foto='assets/foto/penduduk/'.$fo;


$pdf->SetFont('Arial','B',14);
$pdf->Cell(180,7,'Laporan Permohonan KTP Per Penduduk',0,1,'C');


$pdf->Ln(3);
//memberikan space kebawah agar tidak rapat
$pdf->Cell(180,0.5,'','B',1,'L');
$pdf->SetFont('Arial','','11');
$pdf->Cell(30,8,'I. Data Diri Penduduk',0,1);
$pdf->Cell(180,0.5,'','B',1,'L');
//=====Baris==================

$pdf->SetFont('Arial','','11');
$pdf->Cell(10,8,'NIK  ',0,0);

$pdf->Image($foto,150,70,40,55);
$pdf->Cell(42);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,$data['nik'],0,1);
//=====Baris==================
$pdf->Cell(10,8,'Nama Lengkap  ',0,0);
$pdf->Cell(42);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,$data['nama'],0,1);
//=====Baris==================
$pdf->Cell(10,8,'Tempat, Tanggal Lahir  ',0,0);
$pdf->Cell(42);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,$data['tempatLahir'].', '.$data['tanggalLahir'],0,1);
//=====Baris==================
$pdf->Cell(10,8,'Jenis Kelamin  ',0,0);
$pdf->Cell(42);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,$data['jenisKelamin'],0,1);
//=====Baris==================
$pdf->Cell(10,8,'Alamat  ',0,0);
$pdf->Cell(42);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,$data['alamat'],0,1);
//=====Baris==================
$pdf->Cell(10);
$pdf->Cell(10,8,'RT/RW ',0,0);
$pdf->Cell(32);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,$data['rt'].'/'.$data['rw'],0,1);
//=====Baris==================
$pdf->Cell(10);
$pdf->Cell(10,8,'Kelurahan/Desa',0,0);
$pdf->Cell(32);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,$data['kelurahan'],0,1);
//=====Baris==================
$pdf->Cell(10);
$pdf->Cell(10,8,'Kecamatan',0,0);
$pdf->Cell(32);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,'Lengkong',0,1);
//=====Baris==================
$pdf->Cell(10,8,'Agama ',0,0);
$pdf->Cell(42);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,$data['agama'],0,1);
//=====Baris==================
$pdf->Cell(10,8,'Status Perkawinan ',0,0);
$pdf->Cell(42);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,$data['statusPerkawinan'],0,1);
//=====Baris==================
$pdf->Cell(10,8,'Pekerjaan ',0,0);
$pdf->Cell(42);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,$data['pekerjaan'],0,1);
//=====Baris==================
$pdf->Cell(10,8,'Kewarganegaraan ',0,0);
$pdf->Cell(42);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,'Indonesia',0,1);

$pdf->Cell(180,0.5,'','B',1,'L');
$pdf->Cell(30,8,'II. Data Permohonan E-KTP',0,1);
$pdf->Cell(180,0.5,'','B',1,'L');
//=====Baris==================
$pdf->Cell(10,8,'Nomor Permohonan ',0,0);
$pdf->Cell(42);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,$data['no_permohonanKtp'],0,1);
//=====Baris==================
$pdf->Cell(10,8,'Jenis Permohonan ',0,0);
$pdf->Cell(42);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,$data['jenisPermohonan'],0,1);
//=====Baris==================
$pdf->Cell(10,8,'Tanggal Penyerahan Berkas ',0,0);
$pdf->Cell(42);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,$data['tgl_penyerahanBerkas'],0,1);
//=====Baris==================
$pdf->Cell(10,8,'Tanggal Rekam ',0,0);
$pdf->Cell(42);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,$data['tglRekam'],0,1);
//=====Baris==================
$pdf->Cell(10,8,'Tanggal Pengambilan ',0,0);
$pdf->Cell(42);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,$data['tgl_pengambilan'],0,1);
//=====Baris==================
$pdf->Cell(10,8,'Status ',0,0);
$pdf->Cell(42);
$pdf->Cell(5,8,' : ',0,0);
$pdf->Cell(10,8,$data['status'],0,1);


$pdf->Ln(3);


//tanda tangan
$tgl=date("d F Y");
$pdf->Ln(10);
      $pdf->SetFont('Arial','B',9);
      $pdf->Cell(140);
     $pdf->Cell(30,5,'Bandung, '.$tgl,0,1,'C');
     $pdf->SetFont('Arial','B',9);
     $pdf->Cell(140);
     $pdf->Cell(30,7,'Camat Lengkong,',0,1,'C');
     $pdf->Ln(15);
     $pdf->SetFont('Arial','B',9);  
     $pdf->Cell(140);
     $pdf->Cell(30,4,'TB.Agus Mulyadi',0,1,'C');
     $pdf->Cell(135);
     $pdf->Cell(38,0.5,'','B',1,'L');
     $pdf->Cell(140);
      $pdf->SetFont('Arial','B',9);
      $pdf->Cell(30,4,'NIP.19600131189738838',0,1,'C');

$pdf->Output();
}
else{
  echo"<script>alert('Maaf data tidak ditemukan!')</script>";
     echo"<script>location='formlaporan_sktmPend.php';</script>";
   }
 }
?>