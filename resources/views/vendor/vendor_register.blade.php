<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/backend/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/backend/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('assets/backend/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/backend/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/css/icons.css') }}" rel="stylesheet">
    <title>Rukada - Responsive Bootstrap 5 Admin Template</title>
</head>

<body class="bg-login">
<!--wrapper-->
<div class="wrapper">
    <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                <div class="col mx-auto">
                    <div class="my-4 text-center">
                        <img src="assets/images/logo-img.png" width="180" alt="" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center">
                                    <h3 class="">Became a Seller</h3>
                                    <p>Already a seller? <a href="{{ route('vendor.login') }}">Log in here</a>
                                    </p>
                                </div>
                                @if($errors->any())
                                    <div class="alert alert-warning" role="alert">
                                        @foreach( $errors->all() as $error)
                                            <p> {{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="form-body">
                                    <form id="vendor-signup-form" class="row g-3" action="{{ route('vendor.register') }}" method="post">
                                        @csrf
                                        <div class="col-sm-12">
                                            <label for="shopName" class="form-label">Shop Name</label>
                                            <input name="name" type="text" class="form-control" id="shopName" placeholder="Adiba's Shop">
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="userName" class="form-label">User Name</label>
                                            <input name="user_name" type="text" class="form-control" id="userName" placeholder="adiba_shop">
                                        </div>
                                        <div class="col-12">
                                            <label for="phoneNumber" class="form-label">Mobile Number</label>
                                            <input name="mobile" type="text" class="form-control" id="phoneNumber" placeholder="01700000000">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                                            <input name="email" type="email" class="form-control" id="inputEmailAddress" placeholder="example@user.com">
                                        </div>
                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input name="password" type="password" class="form-control border-end-0" id="password" value="12345678" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password_confirmation" class="form-label">Confirmed Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control border-end-0" value="12345678" placeholder="Enter Password"> <a href="javascript:" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-switch">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button id="signUpButton" type="submit" class="btn btn-primary"><i class='bx bx-user'></i>Became a Vendor</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
<!--end wrapper-->
<!-- Bootstrap JS -->
<script src="{{ asset('assets/backend/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<!--Password show & hide js -->
<script>
    $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
</script>

<script>
    let form = document.getElementById("vendor-signup-form");

    document.getElementById("signup-submit-button").addEventListener("click", function (e) {
        e.preventDefault();
        let password = document.getElementById("password").value;
        let confirmPassword = document.getElementById("password_confirmation").value;

        if (password !== confirmPassword) {
            alert("Password didnt match try again.");
            return false;
        } else if (password === confirmPassword) {
            form.submit();
        }
    });
</script>
<!--app JS-->
<script src="{{ asset('assets/backend/js/app.js') }}"></script>
</body>

</html>
