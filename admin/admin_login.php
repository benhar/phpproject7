<?php

include('header.php');
?>

<?php if(isset($_SESSION['message'])){ ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-<?php echo $_SESSION['message']['class'];?>" role="alert">
                <p><?php echo  $_SESSION['message']['message'];?></p>
            </div>
        </div>
    </div>
    <?php
    unset($_SESSION['message']);
} ?>
<div class="main-content col-md-12 zoomIn animated">
    <form class="form" role="form" action="admin_dologin.php" method="post">

        <div class="well col-md-6 col-md-offset-3 login-form">
            <h2 class="login-heading">Login to your account</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="login-level"> Your Email </label>
                        <input class="form-control login-input" type="text" name="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label class="login-level"> Your Password </label>
                        <input class="form-control login-input" type="password" name="password" placeholder="**********">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label><input class="" type="checkbox" name="remember"> Remember Me</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="submit" name="submit_login" class="btn btn-primary" value="Login">
                        <button type="reset" class="btn btn-default">Reset</button>
                    </div>
                    <div class="form-group">
                        <a href="#" class="">Forgot password?</a>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <div>


<?php
include('footer.php');
?>
