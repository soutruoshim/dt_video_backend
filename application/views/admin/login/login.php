<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $settinglist=get_setting(); 
    foreach($settinglist as $set){
        $setn[$set->key]=$set->value;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $setn['app_name'];?></title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="<?php echo base_url().'assets/images/app/'.$setn['app_logo']; ?>">
</head>
<body>
    <div class="h-100">
        <div class="h-100 no-gutters row">
            <div class="d-none d-lg-block h-100 col-lg-5 col-xl-4">
                <div class="left-caption">
                    <img src="<?php echo base_url();?>assets/imgs/login.jpg" class="bg-img" />
                    <div class="caption">
                        <div>
                            <h1><?php echo string_cut($setn['app_name'], 15); ?></h1>
                            <?php echo string_cut($setn['app_desripation'], 300); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h-100 d-flex login-bg justify-content-center align-items-lg-center col-md-12 col-lg-7 col-xl-8">
                <div class="mx-auto app-login-box col-sm-12 col-md-10 col-xl-8">
                    <div class="py-5 p-3">

                        <!-- logo -->
                        <div class="app-logo mb-4">
                            <a href="#" class="mb-4 d-block d-lg-none">
                                <img src="<?php echo base_url().'assets/images/app/'.$setn['app_logo']; ?>" alt=""
                                    class="img-fluid" />
                            </a>
                            <h3 class="primary-color mb-0 font-weight-bold">Login</h3>
                        </div>
                        <!-- end logo -->

                        <h4 class="mb-0 font-weight-bold">
                            <span class="d-block mb-2">Welcome back,</span>
                            <span>Please sign in to your account.</span>
                        </h4>
                        <form class="">
                            <div class="form-row mt-4">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail" class="">Email</label>
                                        <input name="email" id="email" value="admin@admin.com"
                                            placeholder="Email here..." type="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword" class="">Password</label>
                                        <input id="password" name="password" placeholder="Password here..."
                                            value="admin" type="password" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mt-4">
                                <div class="col-sm-6 text-center text-sm-left">
                                    <button class="btn btn-default my-3 mw-120" type="button"
                                        onclick="login_ajax()">Login</button>
                                </div>
                                <div
                                    class="col-sm-6 d-flex align-items-center justify-content-center justify-content-sm-end">
                                    <!-- <a href="javascript:void(0);" class="btn-lg btn btn-link">Recover Password</a> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/js.js"></script>
    <script src="<?php echo base_url();?>assets/js/toastr.min.js"></script>
</body>
</html>

<script type="text/javascript">
function login_ajax() {
    console.log('test');
    var email = $("#email").val();
    var password = $("#password").val();
    if (email == '') {
        toastr.error('Please enter email address.');
        return false;
    } else if (!validateEmail($("#email").val())) {
        toastr.error('Please enter valid email address');
        return false;
    } else if (password == '') {
        toastr.error('Please enter password.');
        return false;
    } else {
        // if ($("#remember_me").is(":checked")) {
        //     var remember_me = 1;
        // } else {
        //     var remember_me = 0;
        // }
        var dataString = "email=" + email + "&password=" + password;

        $.ajax({
            type: 'post',
            url: '<?php  header('Access-Control-Allow-Origin: *'); echo base_url() ?>admin/login/adminlogin',
            data: dataString,
            dataType: 'json',
            success: function(data) {

                if (data.status == 200) {
                    window.location.replace(
                        "<?php echo base_url() ?>admin/dashboard");
                } else {
                    toastr.error('Please enter valid email adress and password.');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });
    }
    event.preventDefault();
    return false;
}

function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
}
</script>