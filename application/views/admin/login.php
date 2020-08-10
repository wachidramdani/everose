<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>sepatoe.id - Login Admin</title>

  <!-- Tell the browser to be responsive to screen width -->

  <meta name="viewport" content="width=device-width, initial-scale=1">



  <!-- Font Awesome -->

  <link rel="stylesheet" href="<?=base_url();?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- icheck bootstrap -->

  <link rel="stylesheet" href="<?=base_url();?>assets/adminlte/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="<?=base_url();?>assets/adminlte/dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">



  <link rel="stylesheet" href="<?=base_url();?>assets/adminlte/plugins/sweetalert2/sweetalert2.min.css">



</head>

<body class="hold-transition login-page" style="background-color: #e6e6e6">

<!-- jQuery -->

<script src="<?=base_url();?>assets/adminlte/plugins/jquery/jquery.min.js"></script>

<div class="login-box">

  <div class="card">

    <div class="card-body login-card-body">

      <img class="login-box-msg" src="<?=base_url();?>assets/vector/isolated-monochrome-black.svg" style="display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;">
      <p class="login-box-msg">Login ke akun anda untuk mengakses admin panel</p>

      <form action="<?=base_url('admin/auth/login');?>" method="post" class="login-form">

        <div class="input-group mb-3">

          <input type="text" class="form-control" placeholder="Username" name="usn">

          <div class="input-group-append">

            <div class="input-group-text">

              <span class="fas fa-user"></span>

            </div>

          </div>

        </div>

        <div class="input-group mb-3">

          <input type="password" class="form-control" placeholder="Password" name="pass">

          <div class="input-group-append">

            <div class="input-group-text">

              <span class="fas fa-lock"></span>

            </div>

          </div>

        </div>

        <div class="row">

          <div class="col-8">

          </div>

          <!-- /.col -->

          <div class="col-4">

            <button type="button" class="btn btn-primary btn-block btn-auth">Sign In</button>

          </div>

          <!-- /.col -->

        </div>

      </form>

    </div>

    <!-- /.login-card-body -->

  </div>

</div>

<script>

$('.btn-auth').on('click',function(){

  $.ajax({

        url: "<?=base_url('index.php/admin/auth/login');?>",

        method: "POST",

        data: new FormData($('.login-form')[0]),

        contentType: false,

        cache: false,

        processData: false,

        dataType: "json",

        success:function(result){

          if(result['status']) {

            location.href = "<?=base_url('index.php/admin/dashboard');?>";

          } else {

            Swal.fire(

                    'Gagal',

                    result['msg'],

                    'error'

                );

          }

        }

      });

});

</script>

<!-- /.login-box -->



<!-- Bootstrap 4 -->

<script src="<?=base_url();?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->

<script src="<?=base_url();?>assets/adminlte/dist/js/adminlte.min.js"></script>



<script src="<?=base_url();?>assets/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>





</body>

</html>

