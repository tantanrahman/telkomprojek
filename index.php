<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED); 
include('cek-login.php');
?>

<html>

<head>
     <script type="text/javascript"> 
    function stopRKey(evt) { 
      var evt = (evt) ? evt : ((event) ? event : null); 
      var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
      if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
    } 

    document.onkeypress = stopRKey; 
    </script> 
    
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
    font-size: 10px!important;
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
                    <a href="index.php?id=1"><i class="fa fa-home fa-fw"></i><b> Home</b>
                    </a>
                </li>

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
                        <li class="divider"></li>
                        <li><a href="index.php?id=153"><i class="fa fa-edit fa-fw"></i> Transvision</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?id=155"><i class="fa fa-edit fa-fw"></i> Aora TV</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?id=157"><i class="fa fa-edit fa-fw"></i> Voucher TRI</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?id=159"><i class="fa fa-edit fa-fw"></i> Voucher SMART</a></li>
                    </ul>
                </li>

                <?php  
                            if($_SESSION['tipe_user']=="admin") {
                        ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-upload fa-fw"></i><b> Upload </b><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a href="finnet.php"><i class="glyphicon glyphicon-upload"></i> Upload Data </a>
                            </li>
                            <li>
                                <a href="fee_arindo.php"><i class="glyphicon glyphicon-upload"></i> Upload Fee Arindo </a>
                            </li>       
                            <li>
                                <a href="index.php?id=151"><i class="glyphicon glyphicon-upload"></i>Status Upload </a>
                            </li>
                    </ul>
                </li>
                <?php } ?>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-edit fa-fw"></i><b> Keuangan / Pengawasan </b><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="index.php?id=9"><i class="fa fa-edit fa-fw"></i> Keuangan</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?id=63"><i class="fa fa-edit fa-fw"></i> View Pengawasan</a></li>
                        <li><a href="index.php?id=78"><i class="fa fa-print fa-fw"></i> Cetak Pengawasan</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?id=161"><i class="fa fa-print fa-fw"></i> VIEW REKAP PER TEMPAT</a></li>
                        <?php  
                            if($_SESSION['tipe_user']=="admin") {
                        ?>
                        <li class="divider"></li>
                        <li><a href="index.php?id=79"><i class="fa fa-pencil fa-fw"></i> Input RK/Transfer</a></li>
                        <li><a href="index.php?id=125"><i class="fa fa-pencil fa-fw"></i> Input (Talangan/Titipan)</a></li>
                        
                        <?php } ?>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-edit fa-fw"></i><b> Colfee </b><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="index.php?id=119"><i class="fa fa-edit fa-fw"></i> Finnet</a></li>
                        <li><a href="index.php?id=121"><i class="fa fa-edit fa-fw"></i> Arindo</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-edit fa-fw"></i><b> Kinerja </b><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="index.php?id=104"><i class="fa fa-edit fa-fw"></i> Per Loker</a></li>
                        <li><a href="index.php?id=117"><i class="fa fa-edit fa-fw"></i> Per User</a></li>
                        <?php  
                            if($_SESSION['tipe_user']=="admin") {
                        ?>
                        <li class="divider"></li>
                        <li><a href="index.php?id=115"><i class="fa fa-pencil fa-fw"></i> Input User/Loket</a></li>
                        <?php } ?>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-cog fa-fw"></i><b> Pengaturan </b><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                    <?php  
                            if($_SESSION['tipe_user']=="admin") {
                        ?>
                        <li><a href="manage_admin.php"><i class="fa fa-user fa-fw"></i> User Profile </a></li>
                        <li><a href="index.php?id=147"><i class="fa fa-cog fa-fw"></i> Fee PDAM </a></li>
                        <li><a href="index.php?id=167"><i class="fa fa-cog fa-fw"></i> Lokasi</a></li>
                        <li><a href="index.php?id=177"><i class="fa fa-cog fa-fw"></i> Lokasi Arindo</a></li>
                        <li><a href="index.php?id=148"><i class="fa fa-cog fa-fw"></i> Harga Pulsa</a></li>
                        <li><a href="index.php?id=149"><i class="fa fa-cog fa-fw"></i> Konpensasi </a></li>
                        <li><a href="index.php?id=150"><i class="fa fa-cog fa-fw"></i> Kode Awal </a></li>
                        <li><a href="index.php?id=27"><i class="fa fa-pencil fa-fw"></i> Edit Kali User</a></li>
                        <li><a href="index.php?id=103"><i class="fa fa-pencil fa-fw"></i> Input Tanggal</a></li>
                        <li><a href="index.php?id=26"><i class="fa fa-pencil fa-fw"></i> Input Fax</a></li>
                        <li><a href="index.php?id=107"><i class="fa fa-pencil fa-fw"></i> Input Saldo akhir</a></li>
                        <li><a href="index.php?id=101"><i class="fa fa-trash fa-fw"></i> Hapus Pendapatan</a></li>
                        <li class="divider"></li>
                     <?php } ?>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                    </ul>
                </li>
                
            </ul>

            <ul class="nav navbar-right top-nav">
                <li class="disabled">
                    <a data-toggle="dropdown" href="#">
                       <b> <?php 
                        echo $_SESSION['username']. ", (<strong>".$_SESSION['tipe_user']."</strong>)";
                    ?>  </b>
                    </a>
                </li>
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->


            <!-- /.navbar-collapse -->
        </nav>

		<div id="page-wrapper">

		<?php 

		switch ($_GET['id'])
			{
			case 1:
				include ("halamanutama.php");
				break;
			case 2:
				include ("form_pen_pln.php");
				break;
            case 3:
                include ("rekap.php");
                break;
            case 4:
                include ("filter_pen_pln.php");
                break;
            case 5:
                include ("pen_sopp.php");
                break;
            case 6:
                include ("pen_pdam.php");
                break;
            case 7:
                include ("upload_data.php");
                break;
            case 8:
                include ("tutorial.php");
                break;
            case 9:
                include ("lembar_keu.php");
                break;
            case 10:
                include ("rincian_sopp.php");
                break;
            case 11:
                include ("pen_fax.php");
                break;
            case 12:
                include ("pen_voucher.php");
                break;
            case 13:
                include ("filter_pen_pln_satuan.php");
                break;
            case 14:
                include ("pengawasan_rk.php");
                break;
            case 15:
                include ("filter_pen_pdam.php");
                break;
            case 16:
                include ("filter_pen_sopp.php");
                break;
            case 17:
                include ("filter_pen_pdam_satuan.php");
                break;
            case 18:
                include ("filter_pen_sopp_satuan.php");
                break;
            case 19:
                include ("pen_pln_hapus.php");
                break;
            case 20:
                include ("pen_pln_hapus_dua.php");
                break;
            case 21:
                include ("pengawasan_rk_dua.php");
                break;
            case 22:
                include ("pen_pdam_hapus.php");
                break;
            case 23:
                include ("pen_pdam_hapus_dua.php");
                break;
            case 24:
                include ("pen_sopp_hapus.php");
                break;
            case 25:
                include ("pen_sopp_hapus_dua.php");
                break;
                case 26:
                include ("input_fax.php");
                break;
                case 27:
                include ("kaliuser.php");
                break;
                case 28:
                include ("carikaliuser.php");
                break;
                case 29:
                include ("editkaliuser.php");
                break;
			
             case 30:
                include ("form_rekap.php");
                break;
                case 31:
                include ("form_rekap2.php");
                break;
                case 32:
                include ("input_rk.php");
                break;
                case 33:
                include ("proses_input_rk.php");
                break;
                 case 34:
                include ("form_rekap3.php");
                break;
                 case 35:
                include ("cetak_rekap.php");
                break;
                case 36:
                include ("pen_pln.php");
                break;
                case 37:
                include ("cetak_pen_pln.php");
                break;
                case 38:
                include ("proses_cetak_pen_pln.php");
                break;

                case 39:
                include ("form_pen_pdam.php");
                break;
                case 40:
                include ("pen_pdam.php");
                break;
                case 41:
                include ("cetak_pen_pdam.php");
                break;
                case 42:
                include ("proses_cetak_pen_pdam.php");
                break;

                case 43:
                include ("form_pen_sopp.php");
                break;
                case 44:
                include ("pen_sopp.php");
                break;
                case 45:
                include ("cetak_pen_sopp.php");
                break;
                case 46:
                include ("proses_cetak_pen_sopp.php");
                break;
                

                case 47:
                include ("form_pen_voucher.php");
                break;
                case 48:
                include ("pen_voucher.php");
                break;
                case 49:
                include ("cetak_pen_voucher.php");
                break;
                case 50:
                include ("proses_cetak_pen_voucher.php");
                break;

                case 51:
                include ("form_pen_fax.php");
                break;
                case 52:
                include ("pen_fax.php");
                break;
                case 53:
                include ("cetak_pen_fax.php");
                break;
                case 54:
                include ("proses_cetak_pen_fax.php");
                break;

                case 55:
                include ("form_rincian_sopp.php");
                break;

                case 56:
                include ("form_input_sopp.php");
                break;
                case 57:
                include ("input_sopp.php");
                break;
                case 58:
                include ("proses_input_sopp.php");
                break;

                case 59:
                include ("form_cetak_sopp.php");
                break;
                case 60:
                include ("proses_cetak_sopp.php");
                break;

                case 61:
                include ("form_cetak_surat.php");
                break;
                case 62:
                include ("proses_cetak_surat.php");
                break;


                 case 63:
                include ("form_pengawasan.php");
                break;
                case 64:
                include ("proses_view_pengawasan.php");
                break;
                case 65:
                include ("input_saldo.php");
                break;
                case 66:
                include ("pen_pln2.php");
                break;
                case 67:
                include ("pen_pdam2.php");
                break;
                case 68:
                include ("pen_sopp2.php");
                break;
                case 69:
                include ("pen_voucher2.php");
                break;

                 case 70:
                include ("input_titipan.php");
                break;
                 case 71:
                include ("simpan_titipan.php");
                break;
                 case 72:
                include ("input_titipan3.php");
                break;
                case 73:
                include ("input_saldo2.php");
                break;
                 case 74:
                include ("proses_cetak_pen_pln2.php");
                break;
                 case 75:
                include ("proses_cetak_pen_pdam2.php");
                break;
                 case 76:
                include ("proses_cetak_pen_sopp2.php");
                break;
                case 77:
                include ("proses_cetak_pen_voucher2.php");
                break;
                 case 78:
                include ("form_pengawasan2.php");
                break;
                case 79:
                include ("input_pengawasan1.php");
                break;
                 case 80:
                include ("input_pengawasan2.php");
                break;
                case 81: 
                include ("input_pengawasan3.php");
                break;
                case 82: 
                include ("form_cetak_fax.php");
                break;


                case 100:
                include ("lembar_pendapatan.php");
                break;
                case 101:
                include ("form_hapus.php");
                break;
                case 102:
                include ("hapus_pendapatan.php");
                break;
                case 103:
                include ("input_tanggal.php");
                break;
                case 104:
                include ("form.php");
                break;
                case 105:
                include ("rekap2.php");
                break;
                case 106:
                include ("form_finnet.php");
                break;
                case 107:
                include ("form_inputsaldo.php");
                break;
                case 108:
                include ("proses_input_saldo.php");
                break;
                case 109:
                include ("form_arindo.php");
                break;
                case 110:
                include ("form_cetak_pln.php");
                break;
                case 111:
                include ("form_cetak_pdam.php");
                break;
                case 112:
                include ("form_cetak_sopp2.php");
                break;
                case 113:
                include ("form_cetak_voucher.php");
                break;
                case 114:
                include ("form_simpan_rekap.php");
                break;

                case 115:
                include ("input_user.php");
                break;
                case 116:
                include ("proses_input_user.php");
                break;

                case 117:
                include ("rekap_user.php");
                break;
                case 118:
                include ("proses_rekap_user.php");
                break;

                case 119:
                include ("form_kolpi_finnet.php");
                break;
                case 120:
                include ("proses_kolpi_finnet.php");
                break;

                case 121:
                include ("form_kolpi_arindo.php");
                break;
                case 122:
                include ("proses_kolpi_arindo.php");
                break;

                case 123:
                include ("form_pen_arindo.php");
                break;
                case 124:
                include ("proses_pen_arindo.php");
                break;

                case 125:
                include ("form_input_pengawasan.php");
                break;
                case 126:
                include ("proses_input_pengawasan.php");
                break;
                case 127:
                include ("proses_input_pengawasan2.php");
                break;

                case 128:
                include ("form_pen_indovision.php");
                break;
                case 129:
                include ("pen_indovision.php");
                break;

                case 130:
                include ("form_input_konpensasi.php");
                break;

                case 131:
                include ("form_cetak_konpensasi.php");
                break;

                
                case 132:
                include ("view_konpensasi.php");
                break;
                 case 133:
                include ("edit_konpensasi.php");
                break;

                case 134:
                include ("hapus_konpensasi.php");
                break;

                case 135:
                include ("view_kode_awal.php");
                break;
                 case 136:
                include ("edit_kode_awal.php");
                break;

                case 137:
                include ("view_harga_pulsa.php");
                break;
                 case 138:
                include ("edit_harga_pulsa.php");
                break;                
                case 139:
                include ("tambah_kode_awal.php");
                break;
                case 140:
                include ("tambah_harga_pulsa.php");
                break;

                case 141:
                include ("hapus_kode_awal.php");
                break; 
                case 142:
                include ("hapus_harga_pulsa.php");
                break; 
                
                 case 143:
                include ("view_fee_pdam.php");
                break;
                 case 144:
                include ("edit_fee_pdam.php");
                break;   
                 case 145:
                include ("tambah_fee_pdam.php");
                break;
                case 146:
                include ("hapus_fee_pdam.php");
                break; 
                case 147:
                include ("tampil_fee_pdam.php");
                break; 
                case 148:
                include ("tampil_harga_pulsa.php");
                break; 
                case 149:
                include ("tampil_konpensasi.php");
                break; 
                case 150:
                include ("tampil_kode_awal.php");
                break; 
                 case 151:
                include ("status_upload.php");
                break;

                case 152:
                include ("form_input_user.php");
                break;

                case 153:
                include ("form_pen_transvision.php");
                break;
                case 154:
                include ("pen_transvision.php");
                break;

                case 155:
                include ("form_pen_aora.php");
                break;
                case 156:
                include ("pen_aora.php");
                break;

                

                case 157:
                include ("form_pen_tri.php");
                break;
                case 158:
                include ("pen_tri.php");
                break;
                case 159:
                include ("form_pen_smart.php");
                break;
                case 160:
                include ("pen_smart.php");
                break;
                case 161:
                include ("form_rekap_tempat.php");
                break;
                case 162:
                include ("rekap_tempat.php");
                break;



                case 163:
                include ("view_lokasi.php");
                break;
                 case 164:
                include ("edit_lokasi.php");
                break;   
                 case 165:
                include ("tambah_lokasi.php");
                break;
                case 166:
                include ("hapus_lokasi.php");
                break; 
                case 167:
                include ("tampil_lokasi.php");
                break; 

                case 173:
                include ("view_lokasi_arindo.php");
                break;
                 case 174:
                include ("edit_lokasi_arindo.php");
                break;   
                 case 175:
                include ("tambah_lokasi_arindo.php");
                break;
                case 176:
                include ("hapus_lokasi_arindo.php");
                break; 
                case 177:
                include ("tampil_lokasi_arindo.php");
                break;

                default:
                include ("halamanutama.php");
				break;
			};
		?>		
		</div>
    </div>

</body>


</html>
