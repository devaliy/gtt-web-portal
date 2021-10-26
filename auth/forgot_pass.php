<?php 

include('../config/init.php');

include('../config/configuration.php');

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
<base href="<?=BASE_URL;?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GTT Password Recovery </title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="assets/vendor/perfect-scrollbar.css" rel="stylesheet">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

    <!-- App CSS -->
    <link type="text/css" href="assets/css/app.css" rel="stylesheet">
    <link type="text/css" href="assets/css/app.rtl.css" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="assets/css/vendor-material-icons.css" rel="stylesheet">
    <link type="text/css" href="assets/css/vendor-material-icons.rtl.css" rel="stylesheet">

    <!-- Font Awesome FREE Icons -->
    <link type="text/css" href="assets/css/vendor-fontawesome-free.css" rel="stylesheet">
    <link type="text/css" href="assets/css/vendor-fontawesome-free.rtl.css" rel="stylesheet">

    <!-- ion Range Slider -->
    <link type="text/css" href="assets/css/vendor-ion-rangeslider.css" rel="stylesheet">
    <link type="text/css" href="assets/css/vendor-ion-rangeslider.rtl.css" rel="stylesheet">




</head>

<body class="layout-login-centered-boxed">





    <div class="layout-login-centered-boxed__form">
        <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-2 navbar-light">
            <a href="index.html" class="navbar-brand text-center mb-2 mr-0" style="min-width: 0">
                <!-- LOGO -->
                <span class="mr-1">
                    <!-- LOGO -->
                    <img src="assets/images/logos/icon_logoo.png" alt="">
                </span>

                <span class="ml-1">Global Trade Tutors</span>
            </a>
        </div>

        <div class="card card-body">


            <div class="alert alert-soft-warning d-flex" role="alert">
                <i class="material-icons mr-3">check_circle</i>
                <div class="text-body">Please Enter your Email Address in the box bellow.<p class="text-danger">To Reset your password.</p></div>
            </div>

           

         

            <form action="forgot_password" method="post" novalidate>
                <div class="form-group">
                    <label class="text-label" for="email_2">Email Address:</label>
                    <div class="input-group input-group-merge">
                        <input id="email_2" type="email" required name="email" class="form-control form-control-prepended" placeholder="john@doe.com">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="far fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                </div>
             
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-block btn-primary" type="submit">Submit </button>
                </div>
              
            </form>
        </div>
    </div>


    <!-- jQuery -->
    <script src="assets/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/vendor/popper.min.js"></script>
    <script src="assets/vendor/bootstrap.min.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="assets/vendor/perfect-scrollbar.min.js"></script>

    <!-- DOM Factory -->
    <script src="assets/vendor/dom-factory.js"></script>

    <!-- MDK -->
    <script src="assets/vendor/material-design-kit.js"></script>

    <!-- Range Slider -->
    <script src="assets/vendor/ion.rangeSlider.min.js"></script>
    <script src="assets/js/ion-rangeslider.js"></script>

    <!-- App -->
    <script src="assets/js/toggle-check-all.js"></script>
    <script src="assets/js/check-selected-row.js"></script>
    <script src="assets/js/dropdown.js"></script>
    <script src="assets/js/sidebar-mini.js"></script>
    <script src="assets/js/app.js"></script>


  <!-- SweetAlert2 -->
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="plugins/toastr/toastr.min.js"></script>
 
    <!-- App Settings (safe to remove) -->
    <script src="assets/js/app-settings.js"></script>




</body>


<!-- Mirrored from educate.frontted.com/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 14:34:18 GMT -->


<?php 
    if(isset($_POST['submit'])){
        $email = $_POST['email'];

        $check = $getFromGeneric->get_singly_g('user', 'email', $email);
      //  var_dump($check);
        if(!empty($check)){

    $subject = 'GTT Password Reset Link';        
  $bodys = "
  <html>
  <head>
  <title>Global Trade Tutor Password Reset </title>
  </head>
  <body>
  <p>Follow the link bellow to reset your login Password </p>
  <p><a href='https://globaltradetutor.com/reset/".$check->id."'>Click here</a></p>
  <p>Thanks</p>
  <h3>Global Trade College</h3>
  </body>
  </html>
  ";

  $send_mail = $getFromGeneric->sendmail($email,$subject,$bodys);



if($send_mail){ 


  echo "<script type='text/javascript'>
    $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      toastr.success(' Please Check Your Mail for to proceed.')
     
     
    });
  
  
  </script>";
 
  }else{
    echo "<script type='text/javascript'>
    $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      toastr.error('  Failed !! Try Again.')
    
    
    
    });
  
                
  
  </script>"; 

}



        }else{
            echo "<script type='text/javascript'>
            $(function() {
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
              });
          
                Toast.fire({
                  type: 'error',
                  title: '    Invalid Email Address.'
                })
             
            });
          
          </script>";
        }
    }


?>