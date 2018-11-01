<?php 
         
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

include('cek-login.php');


$tanggalsekarang = date("d-m-Y")
?>
<html lang="en">

<head>
    <link href='assets/images/icon.png' rel='shortcut icon'>
<style type="text/css">
    th {
        text-align:center!important;
        vertical-align:middle!important;

    }
</style>
    


    <title>Kopeg Aplikasi</title>

        <!-- CSS -->

        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="assets/bootstrap/css/datepicker.css">
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/bootstrap/css/sb-admin.css" rel="stylesheet">
        <link href="assets/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        

        <link rel="stylesheet" href="assets/datatable/css/dataTables.bootstrap.css"/>

        <!-- JavaScript JS -->

        <script src="assets/js/main.js"></script>
        <script src="assets/bootstrap/jquery-1.11.3.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.js"></script>
        <script src="assets/js/bootstrap-datepicker.js"></script>
               
        <script src="assets/bootstrap/js/bootstrap.min.js"></script> 
        <script src="assets/datatable/js/bootstrap.min.js"></script>
        <script src="assets/datatable/js/jquery.dataTables.js"></script>
        <script src="assets/datatable/js/dataTables.bootstrap.js"></script>
        <script src="assets/datatable/js/dataTables.buttons.js"></script>
        <script src="assets/datatable/js/dataTables.buttons.min.js"></script>
        <script src="assets/datatable/js/dataTables.select.min.js"></script>
        <script type="text/javascript">
            $(function(){
             $('.datepicker').datepicker();
            });

            $(function(){
             $('.datepicker2').datepicker();
            });

            $(function(){
             $('.datepicker3').datepicker();
            });
             $(function(){
             $('.datepicker4').datepicker();
            });

            $(function() {
                $("#datatable").dataTable();
                $('#select-all').click(function() {
                    if (this.checked) {
                        $(':checkbox').each(function(){
                            this.checked=true;
                        });
                    } else {
                        $(':checkbox').each(function(){
                            this.checked=false;
                        });
                    }

                });
                $('#select-all2').click(function() {
                    if (this.checked) {
                        $(':checkbox').each(function(){
                            this.checked=true;
                        });
                    } else {
                        $(':checkbox').each(function(){
                            this.checked=false;
                        });
                    }

                });
            });

            (function($) {
                // fungsi dijalankan setelah seluruh dokumen ditampilkan
                $(document).ready(function(e) {
                    
                    // aksi ketika tombol cetak ditekan
                    $("#cetak").bind("click", function(event) {
                        // cetak data pada area <div id="#pen_pln"></div>
                        $('#pen_pln').printArea();
                    });
                });
            }) (jQuery);

            
            
        </script>

        <link href="print.css" rel="stylesheet" media="print">
        <script src="jquery.PrintArea.js"></script>
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
    
<style type="text/css">
   
   table td, th
   {
    font-size: 11px!important;
   }
#autocomplete
 {
 position:relative;
 }
 #lokasi
 {
 width:200px;
 }
 #autocomplete span
 {
 width:500px;
 max-height:250px;
 border: 1px solid#ccc;
 background:#fff;
 overflow:hidden;
 overflow: scroll;
 padding:0;
 position:absolute;
 left:0;
 top:23px;
 z-index:10;
 }
 #autocomplete ul
 {
 padding:0;
 margin:0;
 }
 #autocomplete li
 {
 list-style:none;
 height:15px;
 padding:0 0 10px 10px;
 cursor:pointer;
 }
 #autocomplete li:hover
 {
 background:#eee;
 }

.fixed_headers {
  width: 100%;
  table-layout: fixed;
  border-collapse: collapse;
}
.fixed_headers th {
  text-decoration: underline;
}
.fixed_headers th,
 {
  padding: 5px;
  text-align: left;
}

.fixed_headers th:nth-child(1) {
  min-width: 200px;
}

.fixed_headers th:nth-child(2) {
  min-width: 200px;
}

.fixed_headers th:nth-child(3) {
  width: 350px;
}
.fixed_headers thead {
  background-color: #333;
  color: #FDFDFD;
}
.fixed_headers thead tr {
  display: block;
  position: relative;
}
.fixed_headers tbody {
  display: block;
  overflow: auto;
  width: 100%;
  height: 300px;
}
.fixed_headers tbody tr:nth-child(even) {
  background-color: #DDD;
}
.old_ie_wrapper {
  height: 300px;
  width: 750px;
  overflow-x: hidden;
  overflow-y: auto;
}
.old_ie_wrapper tbody {
  height: auto;
}


</style>


<script type="text/javascript">
    $('document').ready(function()
    {
        $('#lokasi').attr('autocomplete','off');
        $('#lokasi').after('<span></span>');
        $('#autocomplete span').hide();
        $('#lokasi').keyup(function(e){
            var kata = $(this).val();
            var lokasi = $(this);
            
            $('#autocomplete span').show().html('<img src="img/loading.gif">');
            if(kata.length == 0)
            {
                $('#autocomplete span').hide();
            }
        
        $.ajax
        (
            {
                type : "POST",
                url : "autocompletelokasi.php",
                data : "kata="+kata,
                success : function(data)
                {
                    $('#autocomplete span').html(data);
                    $('#autocomplete li').click(function(e)
                    {
                        var ul = $(this).parent();
                        ul.parent().hide;
                        lokasi.val($(this).text());
                    });
                }
            }
        );
    });
    
    $(window).click(function()
    {
        $('#autocomplete span').hide();
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
                Upload Data Arindo
            </h2>
          </center>
          <br>
          <div class="panel panel-primary">
          <div class="panel-heading">
            <center>Berikut adalah halaman <strong>Upload Data Arindo</strong> silakan masukan File yang akan diupload.</center>
          </div>
          </div>
           <div>
  
<?php


?>

<center>  
<form name="myForm" id="myForm" onSubmit="return validateForm()" method="post" enctype="multipart/form-data">
<table>
                    <tr>
                        <td>
                            <input class="datepicker form-control" type="text" name="nilai" placeholder="Tanggal">
                        </td>
                        <td class="col-md-3"></td>
                        <td>
                            <input type="file" id="filepegawaiall" name="filepegawaiall">
                        </td>
                    </tr>
                </table>
    
    
    <br>
    <center>
      <input type="submit" name="submit" value="Import" class="btn btn-primary">
    </center>
    <br>
    <hr>
</form>

<?php

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
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db(kopeg);



//memanggil file excel_reader
require "excel_reader.php";

//jika tombol import ditekan
if(isset($_POST['submit'])){
    

    $target = basename($_FILES['filepegawaiall']['name']) ;
    move_uploaded_file($_FILES['filepegawaiall']['tmp_name'], $target);
    
    $data = new Spreadsheet_Excel_Reader($_FILES['filepegawaiall']['name'],false);
    
//    menghitung jumlah baris file xls
    $baris = $data->rowcount($sheet_index=0);
    
//    jika kosongkan data dicentang jalankan kode berikut
    
    $id=1;
//    import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
    for ($i=4; $i<=$baris; $i++)
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
        $tanggal1 = $_POST['nilai'];

$date = explode("-", $tanggal1);

                    $arr = array("$date[2]","$date[1]","$date[0]");

                    $tampil_date = implode("-", $arr);

       $tanggal = $tampil_date;
      $kode_user          = $data->val($i, 2);
      $pln_lembar    = $data->val($i, 4);
      $pln_trx       = $data->val($i, 5);
      $telepon_lembar    = $data->val($i, 8);
      $telepon_trx       = $data->val($i, 11);
      $indovision_lembar    = $data->val($i, 12);
      $indovision_trx       = $data->val($i, 13);
      $halo_lembar    = $data->val($i, 14);
      $halo_trx       = $data->val($i, 15);
      $pulsa_lembar    = $data->val($i, 18);
      $pulsa_trx       = $data->val($i, 19);
      $pdam_lembar    = $data->val($i, 20);
      $pdam_trx       = $data->val($i, 21);
      $adira_lembar    = $data->val($i, 28);
      $adira_trx       = $data->val($i, 29);
      $baf_lembar    = $data->val($i, 44);
      $baf_trx       = $data->val($i, 45);
      $fif_lembar    = $data->val($i, 48);
      $fif_trx       = $data->val($i, 49);
      $bpjs_lembar    = $data->val($i, 54);
      $bpjs_trx       = $data->val($i, 55);
      $total_lembar    = $data->val($i, 56);
      $total_trx       = $data->val($i, 57);
      $plnp_lembar    = $data->val($i, 6);
      $plnp_trx       = $data->val($i, 7);
      $wom_lembar    = $data->val($i, 26);
      $wom_trx       = $data->val($i, 27);

      


//      setelah data dibaca, masukkan ke tabel pegawai sql
      $query = "INSERT into arindo_trx 
      values('$kode_user','$tanggal',$pln_lembar,$pln_trx,
        $telepon_lembar,$telepon_trx,
        $indovision_lembar,$indovision_trx,$halo_lembar,
        $halo_trx,$pulsa_lembar,$pulsa_trx,
        $pdam_lembar,$pdam_trx,$adira_lembar,$adira_trx,
        $baf_lembar,$baf_trx,$fif_lembar,
        $fif_trx,$bpjs_lembar,$bpjs_trx,$plnp_lembar,$plnp_trx,$wom_lembar,$wom_trx,$total_lembar,
        $total_trx)";
      
       

      $hasil = mysql_query($query);
      echo "$query";
      if (!$hasil)
      {
        echo "<br>gagal : ".mysql_error();
      }
      
      flush();


$id++;
    }


//    hapus file xls yang udah dibaca
    unlink($_FILES['filepegawaiall']['name']);
}


?>
           </div>



</body>

</html>
