<?php 
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
?>

  
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
            <ul class="nav navbar-right top-nav">
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                    <?php 
                        echo "Selamat Datang <strong>".$_SESSION['username']."</strong>";
                    ?>  
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i><b> Halaman Utama</b></a>
                    </li>
                    

</body>

</html>

    
  
