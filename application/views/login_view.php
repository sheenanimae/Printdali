<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Printdali Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/jpg" href="<?= base_url()?>assets/img/logo_yellow.png" />

</head>

<body style="background-color:#FFBD59;">

    <div class="container">
        <div class="row" style="margin-top:20%;">
            <div class="col-4 text-center">
                <div class="container text-center" style="margin-top:15%;">
                    <div>
                        <img src="<?=base_url()?>assets/img/logo_white.png" alt="logo" width="500" height="400">
                    </div>
                </div>
            </div>
            <div class="col-3 w-100">
            </div>
            <div class="col-5 mx-auto border border-light shadow-lg rounded" style="background-color:white;">
                <div class="panel panel-default py-5 text-right">
                    <div class="panel-heading text-center">
                        <h3 class="panel-title">LOGIN</h3>
                    </div>
                    <div class="panel-body">
                        <form accept-charset="UTF-8" role="form" class="login-form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control username" placeholder="Username" name="username"
                                        type="text" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control password" placeholder="Password" name="password"
                                        type="password" required>

                                </div>
                                <div class="text-right">
                                    <label>
                                        <a href="#"> Forget Password</a>
                                    </label>
                                </div>
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                                <div class="alert alert-danger text-center d-none error-msg" style="margin-top:20px;">
                                    Invalid login. User not found
                                </div>
                                <hr>
                                <a href="<?=base_url()?>Login/signup" class="btn btn-lg btn-primary btn-block">Create
                                    Account</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
    integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Sweetalert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$(".login-form").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: window.location.origin + "/Printdali/Login/logindata",
        data: {
            username: $(".username").val(),
            password: $(".password").val(),
        },
        success: function(result) {
            console.log(window.location.origin);

            if (result == "1") {
                window.location.href =
                    window.location.origin + "/Printdali/Login/shop";
            } else if (result == "0") {
                window.location.href =
                    window.location.origin + "/Printdali/Login/CostumerIncoming";
            } else if (result == "404") {
                swal({
                    title: "Account Not Validated!",
                    text: "Email us: printdali@gmail.com!",
                    icon: "warning",
                    button: "Ok!",
                });
            } else {
                $(".error-msg").removeClass("d-none");
            }

        }
    })
});
</script>


</html>