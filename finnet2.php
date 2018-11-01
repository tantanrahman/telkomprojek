<!DOCTYPE html>
<?php 
         
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

include('cek-login.php');


$tanggalsekarang = date("d-m-Y")
?>
<html lang="en">

<head>
    <link href='assets/images/icon.png' rel='shortcut icon'>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kopeg 2.01</title>

    <script type="text/javascript" src="assets/bootstrap/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.js"></script>
    <script src="assets/bootstrap/js/plugins/morris/morris.min.js"></script>
    <script src="assets/bootstrap/js/plugins/morris/raphael.min.js"></script>
    <script src="assets/bootstrap/js/plugins/morris/morris-data.js"></script>
    <script src="assets/bootstrap/js/dropzone.js"></script>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap/css/sb-admin.css" rel="stylesheet">
    <link href="assets/bootstrap/css/plugins/morris.css" rel="stylesheet">  
    <link href="assets/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/bootstrap/css/dropzone.css" />
    <link rel="stylesheet" href="themes/base/jquery.ui.all.css">
    <script src="js/jquery-1.7.2.js"></script>
    <script src="ui/jquery.ui.core.js"></script>
    <script src="ui/jquery.ui.widget.js"></script>
    <script src="ui/jquery.ui.datepicker.js"></script>
    <script>
    $(function() {
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true
        });
    });
    </script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-left top-nav">             
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-edit fa-fw"></i><b> Lembar Pendapatan </b><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="index.php?id=100"><i class="fa fa-edit fa-fw"></i> Finnet</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?id=123"><i class="fa fa-edit fa-fw"></i> Arindo</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?id=128"><i class="fa fa-edit fa-fw"></i> Indovision</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-edit fa-fw"></i><b> Upload </b><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <?php  
                            if($_SESSION['tipe_user']=="admin") {
                        ?>
                            <li>
                                <a href="index.php?id=7"><i class="glyphicon glyphicon-upload"></i> Upload Data </a>
                            </li>
                            <li>
                                <a href="fee_arindo.php"><i class="glyphicon glyphicon-upload"></i> Upload Fee Arindo </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-edit fa-fw"></i><b> Pengawasan </b><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="index.php?id=63"><i class="fa fa-edit fa-fw"></i> View</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?id=78"><i class="fa fa-print fa-fw"></i> Cetak</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?id=79"><i class="fa fa-pencil fa-fw"></i> Input RK/Transfer</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?id=79"><i class="fa fa-pencil fa-fw"></i> Input (Talangan/Titipan)</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-edit fa-fw"></i><b> Lap. Keuangan </b><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="index.php?id=9"><i class="fa fa-edit fa-fw"></i> Keuangan</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-edit fa-fw"></i><b> Colfee </b><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="index.php?id=119"><i class="fa fa-edit fa-fw"></i> Finnet</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?id=121"><i class="fa fa-edit fa-fw"></i> Arindo</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-edit fa-fw"></i><b> Kinerja </b><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="index.php?id=104"><i class="fa fa-edit fa-fw"></i> Per Loker</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?id=117"><i class="fa fa-edit fa-fw"></i> Per User</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?id=115"><i class="fa fa-pencil fa-fw"></i> Input User/Loket</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-cog fa-fw"></i><b> Pengaturan </b><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="manage_admin.php"><i class="fa fa-user fa-fw"></i> User Profile </a></li>
                        <li><a href="index.php?id=147"><i class="fa fa-cog fa-fw"></i> Fee PDAM </a></li>
                        <li><a href="index.php?id=148"><i class="fa fa-cog fa-fw"></i> Harga Pulsa</a></li>
                        <li><a href="index.php?id=149"><i class="fa fa-cog fa-fw"></i> Konpensasi </a></li>
                        <li><a href="index.php?id=150"><i class="fa fa-cog fa-fw"></i> Kode Awal </a></li>
                        <li><a href="index.php?id=27"><i class="fa fa-pencil fa-fw"></i> Edit Kali User</a></li>
                        <li><a href="index.php?id=103"><i class="fa fa-pencil fa-fw"></i> Input Tanggal</a></li>
                        <li><a href="index.php?id=26"><i class="fa fa-pencil fa-fw"></i> Input Fax</a></li>
                        <li><a href="index.php?id=107"><i class="fa fa-pencil fa-fw"></i> Input Saldo Awal</a></li>
                        <li><a href="index.php?id=101"><i class="fa fa-trash fa-fw"></i> Hapus Pendapatan</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                    </ul>
                </li>
                
            </ul>

            <ul class="nav navbar-right top-nav">
                <li class="disabled">
                    <a data-toggle="dropdown" href="#">
                       <b> <?php 
                        echo "sebagai <strong>".$_SESSION['tipe_user']."</strong>";
                    ?>  </b>
                    </a>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
           
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
          <center>
            <h2 class="page-header">
                Upload Data Finnet
            </h2>
          </center>
          <div class="panel panel-primary">
          <div class="panel-heading">
            <center>Berikut adalah halaman <strong>Upload Data Finnet</strong> silakan masukan File yang akan diupload.</center>
          </div>
          </div>
           <div>
  


  
<form name="myForm" id="myForm" onSubmit="return validateForm()" method="post" enctype="multipart/form-data">
  <table>
    
    <tr>
      <td>Laporan</td><td class="col-md-1"></td><td><select name="laporan" class="form-control">
                    <option value="pln">PLN</option>
                    <option value="pdam">PDAM</option>
                    <option value="sopp">SOPP</option>
                    <option value="voucher">Voucher</option>
                    <option value="indovision">Indovision</option>
                </select></td>
    </tr>
  </table>   
    <input type="file" id="filepegawaiall" name="filepegawaiall">
    <br>
    <center>
      <input type="submit" name="submit" value="Import" class="btn btn-primary">
    </center>
    <br>
    <hr>
</form>

<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db(kopeg);
$tanggal1 = $_POST['nilai'];

$date = explode("-", $tanggal1);

                    $arr = array("$date[2]","$date[1]","$date[0]");

                    $tampil_date = implode("-", $arr);


?>

<?php 

//disini

if (isset($_POST['submit'])) {
?>
<div id="progress" style="width:500px;border:1px solid #ccc;"></div>
<div id="info"></div>
<?php
}
?>

<script type="text/javascript">
//    validasi form (hanya file .xls yang diijinkan)
    function validateForm()
    {
        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }

        if(!hasExtension('filepegawaiall', ['.xls'])){
            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>

<?php
//koneksi ke database, username,password  dan namadatabase menyesuaikan 



//memanggil file excel_reader
require "excel_reader.php";

//jika tombol import ditekan
if(isset($_POST['submit'])){
    $laporan = $_POST['laporan'];

    $target = basename($_FILES['filepegawaiall']['name']) ;
    move_uploaded_file($_FILES['filepegawaiall']['tmp_name'], $target);
    
    $data = new Spreadsheet_Excel_Reader($_FILES['filepegawaiall']['name'],false);
    
//    menghitung jumlah baris file xls
    $baris = $data->rowcount($sheet_index=0);
    
//    jika kosongkan data dicentang jalankan kode berikut
    
    $id=1;
//    import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
    for ($i=2; $i<=$baris; $i++)
    {
//        menghitung jumlah real data. Karena kita mulai pada baris ke-2, maka jumlah baris yang sebenarnya adalah 
//        jumlah baris data dikurangi 1. Demikian juga untuk awal dari pengulangan yaitu i juga dikurangi 1
        $barisreal = $baris-1;
        $k = $i-1;
        
// menghitung persentase progress
        $percent = intval($k/$barisreal * 100)."%";

// mengupdate progress
        echo '<script language="javascript">
        document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.'; background-color:lightblue\">&nbsp;</div>";
        document.getElementById("info").innerHTML="'.$k.' data berhasil diinsert ('.$percent.' selesai).";
        </script>';

//       membaca data (kolom ke-1 sd terakhir)
        if ($laporan == "pln")
        {
      $tanggal        = $data->val($i, 1);
      $date = explode("-", $tanggal);
      $arr = array("$date[2]","$date[1]","$date[0]");
      $tampil_date = implode("-", $arr);
                    
      $divre          = $data->val($i, 2);
      $kode_kopegtel  = $data->val($i, 3);
      $kopegtel       = $data->val($i, 4);
      $loket        = $data->val($i, 5);
      $nomor        = $data->val($i, 6);
      $trx          = $data->val($i, 7);
      $bill  = $data->val($i, 8);
      $amount       = $data->val($i, 9);
      $fee_admin       = $data->val($i, 10);
      $total_kopeg         = $data->val($i, 11);

      $cari = "select id from loket where loket=$loket";
      $caridata = mysql_query($cari,$koneksi);
      $row = mysql_fetch_array($caridata,MYSQL_ASSOC);
      $id_user = $row['id'];

      $inputdata = "insert into kinerja_user values ('$id','$loket','$tampil_date',0,$trx,0,0,0)";


//      setelah data dibaca, masukkan ke tabel pegawai sql
      $query = "INSERT into pln values($id,'$tampil_date','$divre','$kode_kopegtel','$kopegtel','$loket','$nomor',$trx,$bill,$amount,$fee_admin,$total_kopeg)";
      
        }
        else if ($laporan=="pdam")
        {
      $tanggal        = $data->val($i, 1);
      $pecah2 = explode("/", $tanggal);

      $tampil = implode("-",$pecah2);
      $date = explode("-", $tampil);
      $arr = array("$date[2]","$date[1]","$date[0]");
      $tampil_date = implode("-", $arr);
      $jam        = $data->val($i, 2);
      $kopegtel       = $data->val($i, 3);
      $loket        = $data->val($i, 4);
      $virtual_account        = $data->val($i, 5);
      $nama_area        = $data->val($i, 6);
      $fee_admin        = $data->val($i, 7);
      $no_pdam        = $data->val($i, 8);
      $trx          = $data->val($i, 9);
      $bill  = $data->val($i, 10);
      $amount       = $data->val($i, 11);
      $total_fee       = $data->val($i, 12);
      $total_kopeg         = $data->val($i, 13);


      $cari = "select id from loket where loket=$loket";
      $caridata = mysql_query($cari);
      $row = mysql_fetch_array($caridata,MYSQL_ASSOC);
      $id_user = $row['id'];

      $inputdata = "insert into kinerja_user values ('$id','$loket','$tampil_date',0,0,$trx,0)";

      $query = "INSERT into pdam values($id,'$tampil_date','$jam','$kopegtel','$loket',
        $virtual_account,'$nama_area',$fee_admin,$no_pdam,$trx,$bill,$amount,$total_fee,$total_kopeg)";
        }
         else if ($laporan=="sopp")
        {
            $tanggal        = $data->val($i, 1);
            $date = explode("-", $tanggal);
      $arr = array("$date[2]","$date[1]","$date[0]");
      $tampil_date = implode("-", $arr);
      $divre          = $data->val($i, 2);
      $kode_kopegtel  = $data->val($i, 3);
      $kopegtel       = $data->val($i, 4);
      $kodeloket    = $data -> val($i,5);
      $loket        = $data->val($i, 6);
      $trx          = $data->val($i, 7);
      $bill  = $data->val($i, 8);
      $amount       = $data->val($i, 9);
      $surcharge       = $data->val($i, 10);
      $fee_admin       = $data->val($i, 11);
      $total_kopeg         = $data->val($i, 12);
      $divre_bill       = $data->val($i, 13);
      $user       = $data->val($i, 14);


$cari = "select id from loket where loket=$user";
      $caridata = mysql_query($cari);
      $row = mysql_fetch_array($caridata,MYSQL_ASSOC);
      $id_user = $row['id'];

      $inputdata = "insert into kinerja_user values ('$id','$user','$tampil_date',$trx,0,0,0,0)";

      $query = "INSERT into sopp values($id,'$tampil_date','$divre','$kode_kopegtel','$kopegtel','$kodeloket',
        '$loket',$trx,$bill,$amount,$surcharge,$fee_admin,$total_kopeg,$divre_bill,'$user')";
        }

        else if ($laporan=="voucher")
        {



            $tanggal        = $data->val($i, 1);


$pecah = explode(" ",$tanggal);
$pecah2 = explode("/", $pecah[0]);

$tampil = implode("-",$pecah2);
$date = explode("-", $tampil);
      $arr = array("$date[2]","$date[1]","$date[0]");
      $tampil_date = implode("-", $arr);
            $divre        = $data->val($i, 2);
      $kode_kopegtel  = $data->val($i, 3);
      $kopegtel       = $data->val($i, 4);
      $kodeloket    = $data -> val($i,5);
      $loket        = $data->val($i, 6);
      $user       = $data->val($i, 7);
      $denom        = $data->val($i, 8);
      $no_telp          = $data->val($i, 9);
      $nama_cust          = $data->val($i, 10);
      $amount       = $data->val($i, 11);
      $surcharge       = $data->val($i, 12);
      $fee_ca       = $data->val($i, 13);
      $total_kopeg         = $data->val($i, 14);
      $kode_biller       = $data->val($i, 15);

      $cari = "select id from loket where loket=$loket";
      $caridata = mysql_query($cari);
      $row = mysql_fetch_array($caridata,MYSQL_ASSOC);
      $id_user = $row['id'];

      $inputdata = "insert into kinerja_user values ('$id','$user','$tampil_date',0,0,0,1,0)";

      $query = "INSERT into voucher values($id,'$divre','$tampil_date','$kode_kopegtel','$kopegtel','$kodeloket',
        '$loket','$user',$denom,'$no_telp','$nama_cust',$amount,$surcharge,$fee_ca,$total_kopeg,$kode_biller)";
        }
        else 
        {



            $tanggal        = $data->val($i, 1);


$pecah = explode(" ",$tanggal);
$pecah2 = explode("/", $pecah[0]);

$tampil = implode("-",$pecah2);
$date = explode("-", $tampil);
      $arr = array("$date[2]","$date[1]","$date[0]");
      $tampil_date    = implode("-", $arr);
      $divre          = $data->val($i, 2);
      $kode_kopegtel  = $data->val($i, 3);
      $kopegtel       = $data->val($i, 4);
      $kodeloket      = $data->val($i, 5);
      $loket          = $data->val($i, 7);
      $nama_biller    = $data->val($i, 8);
      $account          = $data->val($i, 9);
      $customer        = $data->val($i, 10);
      $tagihan      = $data->val($i, 11);
      $surcharge         = $data->val($i, 12);
      $fee_ca      = $data->val($i, 13);
      $fee_finnet         = $data->val($i, 14);
      $kewajiban    = $data->val($i, 15);
      $kode_biller    = $data->val($i, 16);

      $cari = "select id from loket where loket=$loket";
      $caridata = mysql_query($cari);
      $row = mysql_fetch_array($caridata,MYSQL_ASSOC);
      $id_user = $row['id'];

      $inputdata = "insert into kinerja_user values ('$id','$user','$tampil_date',0,0,0,0,1)";

      $query = "INSERT into indovision 
      values
      ('$tampil_date','$divre','$kode_kopegtel','$kopegtel','$kodeloket','$loket','$nama_biller','$account','$customer',$tagihan,$surcharge,$fee_ca,$fee_finnet,$kewajiban,'$kode_biller'
      )";
        }



      $hasil = mysql_query($query);
      $hasil2 = mysql_query($inputdata);
      
      
      flush();


$id++;
    }




}
$cari = "select * from status_tanggal where tanggal='$tampil_date'";
$eksekusi = mysql_query($cari);
$row = mysql_fetch_array($eksekusi,MYSQL_ASSOC);

if ($row == NULL)
{
  $insert = "INSERT into status_tanggal values ('$tampil_date','masuk')";
  $eksekusi = mysql_query($insert);
}
else
{
  $insert = "Update status_tanggal set status='masuk' where tanggal='$tampil_date'";
  $eksekusi = mysql_query($insert);
}



function cek_pln($teks)
 
{
 
  $kata_input = array("MKMSettleLoket");
  $hasil = 0;
  $jml_kata = count($kata_input);
  for ($i=0;$i<$jml_kata;$i++)
  {
    if (stristr($teks,$kata_input[$i]))
   
    { 
      $hasil=1; 
    }
   
  }
 
return $hasil;
 
}

function cek_pdam($teks)
 
{
 
  $kata_input = array("PDAM");
  $hasil = 0;
  $jml_kata = count($kata_input);
  for ($i=0;$i<$jml_kata;$i++)
  {
    if (stristr($teks,$kata_input[$i]))
   
    { 
      $hasil=1; 
    }
   
  }
 
return $hasil;
 
}

function cek_sopp($teks)
 
{
 
  $kata_input = array("P2HSUM");
  $hasil = 0;
  $jml_kata = count($kata_input);
  for ($i=0;$i<$jml_kata;$i++)
  {
    if (stristr($teks,$kata_input[$i]))
   
    { 
      $hasil=1; 
    }
   
  }
 
return $hasil;
 
}

function cek_voucher0($teks)
 
{
 
  $kata_input = array("_0(695)");
  $hasil = 0;
  $jml_kata = count($kata_input);
  for ($i=0;$i<$jml_kata;$i++)
  {
    if (stristr($teks,$kata_input[$i]))
   
    { 
      $hasil=1; 
    }
   
  }
 
return $hasil;
 
}

function cek_voucher10($teks)
 
{
 
  $kata_input = array("_10000(695)");
  $hasil = 0;
  $jml_kata = count($kata_input);
  for ($i=0;$i<$jml_kata;$i++)
  {
    if (stristr($teks,$kata_input[$i]))
   
    { 
      $hasil=1; 
    }
   
  }
 
return $hasil;
 
}

function cek_voucher20($teks)
 
{
 
  $kata_input = array("_20(695)");
  $hasil = 0;
  $jml_kata = count($kata_input);
  for ($i=0;$i<$jml_kata;$i++)
  {
    if (stristr($teks,$kata_input[$i]))
   
    { 
      $hasil=1; 
    }
   
  }
 
return $hasil;
 
}

function cek_voucher25($teks)
 
{
 
  $kata_input = array("_0(695)");
  $hasil = 0;
  $jml_kata = count($kata_input);
  for ($i=0;$i<$jml_kata;$i++)
  {
    if (stristr($teks,$kata_input[$i]))
   
    { 
      $hasil=1; 
    }
   
  }
 
return $hasil;
 
}

function cek_voucher50($teks)
 
{
 
  $kata_input = array("_50000(695)");
  $hasil = 0;
  $jml_kata = count($kata_input);
  for ($i=0;$i<$jml_kata;$i++)
  {
    if (stristr($teks,$kata_input[$i]))
   
    { 
      $hasil=1; 
    }
   
  }
 
return $hasil;
 
}

function cek_voucher100($teks)
 
{
 
  $kata_input = array("_100000(695)");
  $hasil = 0;
  $jml_kata = count($kata_input);
  for ($i=0;$i<$jml_kata;$i++)
  {
    if (stristr($teks,$kata_input[$i]))
   
    { 
      $hasil=1; 
    }
   
  }
 
return $hasil;
 
}

function cek_voucher($teks)
 
{
 
  $kata_input = array("TSEL");
  $hasil = 0;
  $jml_kata = count($kata_input);
  for ($i=0;$i<$jml_kata;$i++)
  {
    if (stristr($teks,$kata_input[$i]))
   
    { 
      $hasil=1; 
    }
   
  }
 
return $hasil;
 
}
$denomm="-";
if (cek_sopp($target)) 
  {
    $pen = "sopp";
  }
 

else if (cek_pdam($target)) 
  {
    $pen = "pdam";
  }

  else if (cek_pln($target)) 
  {
    $pen = "pln";
  }
  else if (cek_voucher0($target)) 
  {
    $pen = "voucher";
    $denomm = "0";
  }
   else if (cek_voucher10($target)) 
  {
    $pen = "voucher";
    $denomm = "10";
  }
   else if (cek_voucher20($target)) 
  {
    $pen = "voucher";
    $denomm = "20";
  }
   else if (cek_voucher25($target)) 
  {
    $pen = "voucher";
    $denomm = "25";
  }
   else if (cek_voucher50($target)) 
  {
    $pen = "voucher";
    $denomm = "50";
  }
   else if (cek_voucher100($target)) 
  {
    $pen = "voucher";
    $denomm = "100";
  }
  else if (cek_voucher($target)) 
  {
    $pen = "voucher";
  }
 

 $cari2 = "select * from Upload where nama='$target' and tanggal='$tampil_date'";
$eksekusi2 = mysql_query($cari2);
$row2 = mysql_fetch_array($eksekusi2,MYSQL_ASSOC);

if ($row2 == NULL)
{
  $insert2 = "INSERT into upload values ('$tampil_date','$target','$pen','$denomm')";
  $eksekusi2 = mysql_query($insert2);
}
else
{
  $insert2 = "Update upload set nama='$target' where tanggal='$tampil_date'";
  $eksekusi2 = mysql_query($insert2);
}




?>
           </div>



</body>

</html>
s