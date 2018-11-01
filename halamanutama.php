
            <div class="container-fluid">

            <center>
                <h2 class="page-header">
                    Kopegtel Aplikasi
                </h2> 
            </center>

            <?php  
                            if($_SESSION['tipe_user']=="admin") {
                        ?>
            <div class="panel panel-primary">
              <div class="panel-heading">
                <center>
                     <?php echo "Selamat datang <strong>".$_SESSION['username']."</strong> di Halaman Utama Aplikasi Kopegtel" ; ?>
                </center>
              </div>
            </div>
            <?php } ?>

            <?php  
                            if($_SESSION['tipe_user']=="operator") {
                        ?>
            <div class="panel panel-danger">
              <div class="panel-heading">
                <center>
                     <?php echo "Selamat datang <strong>".$_SESSION['username']."</strong> di Halaman Utama Aplikasi Kopegtel" ; ?>
                     <br>
                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                      <span class="sr-only">Warning!</span>
                      Dikarenakan anda <strong>Login</strong> menggunakan <strong>Tipe User "Operator"</strong> maka hak akses anda dibatasi.
                </center>
              </div>
            </div>
            <?php } ?>