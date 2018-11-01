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
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <b>Beranda</b>
                        </h1>
                    </div>
                </div>
            </center>
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Pastikan pengunduhan data dari sistem sudah dilakukan.</strong>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

<?php
    $kategori = $_GET["kategori"];
    $tanggal_file = $_GET["tanggal_file"];
    $storagename = $kategori . $tanggal_file . ".xlsx";
    echo $storagename;
                
    if ($kategori == "pen_pln_")
        {
            include('query_pln.php');
        }
    elseif ($kategori == "pen_sopp_")
        {
            include('query_sopp.php');
        }
    elseif ($kategori == "pen_pdam_")
        {
            include('query_pdam.php');
        }
    elseif ($kategori == "pen_fax_")
        {
            include('query_fax.php');
        }
    elseif ($kategori == "pen_voucher_")
        {
            include('query_voucher.php');
        }
        elseif ($kategori == "pen_indovision")
        {
            include('query_indovision.php');
        }
        elseif ($kategori == "pen_arindo")
        {
            include('query_arindo.php');
        }
    else 
        {
            echo "Upload Error. Category Not Found";
        }
?>

    <form name="import" method="post" enctype="multipart/form-data">
    Click submit store data in mysql
        <input type="submit" name="submit" value="Submit" style="margin-left:100px;"/>
        
    </form>

                </div>
            </div>
        </div>



</body>

</html>
