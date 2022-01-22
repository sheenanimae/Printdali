<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Printdali | Signup Form</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/adminlte.min.css">
    <link rel="shortcut icon" type="image/jpg" href="<?= base_url()?>assets/img/logo_yellow.png" />

</head>

<body style="background-color:#FFBD59;">

    <div class="container-fluid" style="margin-top:10%">
        <div class="row">
            <!-- left column -->
            <div class="col-3">

            </div>
            <div class="col-6">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Account <small>Form</small></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" role="form" id="signUpForm">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-5">
                                    <label for="fname">First Name</label>
                                    <input type="text" name="fname" class="form-control" id="fname"
                                        placeholder="First Name">
                                </div>
                                <div class="form-group col-2">
                                    <label for="mname">Middle Name</label>
                                    <input type="text" name="mname" class="form-control" id="mname"
                                        placeholder="Middle Name">
                                </div>
                                <div class="form-group col-5">
                                    <label for="lname">Last Name</label>
                                    <input type="text" name="lname" class="form-control" id="lname"
                                        placeholder="Last Name">
                                </div>
                                <div class="form-group col-8">
                                    <label for="storeAddress">Shop Address</label>
                                    <input type="text" name="storeAddress" class="form-control" id="storeAddress"
                                        placeholder="Shop Address">
                                </div>
                                <div class="form-group col-4">
                                    <label for="zipcode">Zip Code</label>
                                    <input type="number" name="zipcode" class="form-control" id="zipcode"
                                        placeholder="Zip Code">

                                </div>
                                <div class="form-group col-6 ExistEmail">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control " id="email"
                                        placeholder="Email Address">

                                </div>
                                <div class="form-group col-6">
                                    <label for="contactNumber">Phone Number</label>
                                    <input type="number" name="contactNumber" class="form-control" id="contactNumber"
                                        placeholder="Contact Number">
                                </div>
                                <div class="form-group col-6">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="username"
                                        placeholder="Username">
                                </div>
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name="password" class="form-control"
                                        id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <hr style="height: 1px;background-color: #ccc;border: none;width:100%">
                                <div class="form-group col-6">
                                    <label for="store_name">Shop Name</label>
                                    <input type="text" name="store_name" class="form-control" id="store_name"
                                        placeholder="Shop">
                                </div>
                                <div class="form-group col-12 my-2">
                                    <label for="bpermit">Business Permit</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="bpermit" name="bpermit"
                                                accept="image/jpg, image/jpeg, image/png">
                                            <label class="custom-file-label" for="bpermit">Clear copy of your
                                                Business permit</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12 my-2">
                                    <label for="validID">Valid ID</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="validID" name="validID"
                                                accept="image/jpg, image/jpeg, image/png">
                                            <label class="custom-file-label" for="validID">Clear copy of your
                                                Valid ID</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12 my-2">
                                    <label for="storeImg">Shop Picture</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="storeImg" name="storeImg"
                                                accept="image/jpg, image/jpeg, image/png">
                                            <label class="custom-file-label" for="storeImg">Clear copy of your
                                                Shop</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0 mt-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="terms" class="custom-control-input"
                                            id="exampleCheck1">
                                        <label class="custom-control-label" for="exampleCheck1">I agree to the
                                            <a href="#">terms of service</a>.</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6 text-center">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block"><i
                                            class="fas fa-align-right"></i> Submit</button>
                                </div>
                                <div class="col-6 text-center">
                                    <a type="button" class="btn btn-lg btn-success btn-block" href="<?=base_url()?>"> <i
                                            class="fas fa-sign-in-alt"></i> Login</a>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-3">

            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

    <!-- jQuery -->
    <script src="<?=base_url()?>assets/plugins/jquery/jquery.min.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
    <!-- Bootstrap 4 -->
    <script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- jquery-validation -->
    <script src="<?=base_url()?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url()?>assets/dist/js/adminlte.min.js"></script>

    <!-- Sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="<?=base_url()?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script type="text/javascript">
    $(function() {
        $.validator.setDefaults({
            submitHandler: function() {
                $.ajax({ //Check if Email Exist
                    type: "POST",
                    url: window.location.origin + "/Printdali/Login/checkemail",
                    data: {
                        email: $("#email").val(),
                    },
                    success: function(result) {
                        console.log(result);

                        if (result == "500") { //if result is exist
                            $('#email').addClass('is-invalid');
                            $('span').remove('.diserror');
                            $('.ExistEmail').append(
                                "<span class='diserror invalid-feedback'>Email Exist!</span>"
                            );
                            swal({
                                title: "Error!",
                                text: "Email Exist!",
                                icon: "warning",
                                button: "Ok!",
                            });


                        } else { //if result is not exist then insert data and upload files
                            var formdata = new FormData($("#signUpForm").get(0));
                            $.ajax({
                                type: "POST",
                                url: window.location.origin +
                                    "/Printdali/Login/UploadInsert",
                                data: formdata,
                                processData: false,
                                contentType: false,
                                cache: false,
                                async: false,
                                success: function(result) {
                                    console.log(result);
                                    if (result == "200") {
                                        swal({
                                            title: "Successfully Submited!",
                                            text: "Our Team will contact you once we Verify your application",
                                            icon: "success",
                                            html: true
                                        }).then(function() {
                                            window.location.href =
                                                window.location
                                                .origin +
                                                "/Printdali";
                                        });
                                    } else {
                                        swal({
                                            title: "Error!",
                                            text: "Email us: printdali@gmail.com!",
                                            icon: "warning",
                                            button: "Ok!",
                                        });
                                    }


                                }
                            })
                        }
                    }
                })
            }
        });
        $('#signUpForm').validate({
            rules: {
                fname: {
                    required: true,
                    minlength: 2
                },
                mname: {
                    minlength: 2
                },
                lname: {
                    required: true,
                    minlength: 2
                },
                storeAddress: {
                    required: true,
                    minlength: 10
                },
                zipcode: {
                    required: true,
                    minlength: 4,
                    maxlength: 10
                },
                contactNumber: {
                    required: true,
                    minlength: 10
                },
                username: {
                    required: true,
                    minlength: 10
                },
                store_name: {
                    required: true,
                    minlength: 5
                },
                bpermit: {
                    required: true,
                },
                validID: {
                    required: true,
                },
                storeImg: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 5
                },
                terms: {
                    required: true
                },
            },
            messages: {
                fname: {
                    required: "Please enter first name",
                    minlength: "Your first name must be at least 2 characters long"
                },
                mname: {
                    maxlength: "Your middle name must be at least 2 characters long"
                },
                lname: {
                    required: "Please enter last name",
                    minlength: "Your last name must be at least 2 characters long"
                },
                storeAddress: {
                    required: "Please enter store address",
                    minlength: "Your store address must be at least 10 characters long"
                },
                zipcode: {
                    required: "Please enter zip code",
                    minlength: "Your zip code must be at least 5 characters long",
                    maxlength: "Please enter valid zip code"
                },
                contactNumber: {
                    required: "Please enter contact number",
                    minlength: "Your username must be at least 10 characters long"
                },
                username: {
                    required: "Please enter username",
                    minlength: "Your username must be at least 10 characters long"
                },
                store_name: {
                    required: "Please enter Store Name",
                    minlength: "Your Store Name must be at least 5 characters long"
                },
                bpermit: {
                    required: "Business permit Required!"
                },
                validID: {
                    required: "Valid ID Required!"
                },
                storeImg: {
                    required: "Store picture Required!"
                },
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                terms: "Please accept our terms"
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
    </script>
    <script>
    $(function() {
        bsCustomFileInput.init();
    });
    </script>
</body>

</html>