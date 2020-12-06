<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Page </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets') ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url('assets') ?>/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets') ?>/build/css/custom.min.css" rel="stylesheet">

</head>

<body style="background-size: 100%;">

    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <div>
                    <img src="<?php echo base_url() ?>assets/images/polda.png" width="100px;" height="120px;">
                    <h3 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: chocolate;">Sistem Informasi</h3>

                    <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: chocolate;">POLDA JAWA TENGAH</h1>
                </div>
                <?php echo form_open("Auth/", array('method' => 'POST', 'class' => 'login-form')); ?>
                <hr>
                <div>
                    <div class="text-left"><?php echo form_error('username'); ?></div>
                    <?php echo form_input(array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Username', 'name' => 'username', 'id' => 'username')); ?>
                </div>
                <div>
                    <div class="text-left"> <?php echo form_error('password'); ?> </div>
                    <?php echo form_input(array('type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'name' => 'password', 'id' => 'password')); ?>
                </div>
                <div>
                    <button class="btn btn-danger btn-sm" style="width: 100%;" type="submit"> <i class='fa fa-user'></i> Masuk</button>
                </div>

                <div class="clearfix"></div>
                <label class="text-left">
                    <?php
                    $message = $this->session->flashdata('result_login');
                    if ($message) { ?>
                        <div style="color: red;"><?php echo $message; ?></div>
                    <?php } ?>
                </label>
                <div class="separator">
                    <div class="clearfix"></div>
                    <br />

                </div>
                <?php echo form_close(); ?>
                <div class="text" style="color:white;">
                    <p><?php echo date('Y'); ?> All Rights Reserved. <br> Developed by. Privacy and Terms</p>
                </div>
            </section>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form>
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" required="" />
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="Email" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div>
                        <a class="btn btn-default submit" href="index.html">Submit</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                            <p>@<?php echo date('Y'); ?> All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>



</body>

</html>