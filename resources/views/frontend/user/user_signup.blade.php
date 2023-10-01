@extends('frontend.master')

@section('content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Pages <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">
                        <div class="col-lg-6 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h1 class="mb-5">Create an Account</h1>
                                        <p class="mb-30">Already have an account? <a href="{{ route('user.login') }}">Login</a></p>
                                    </div>
                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger">{{$error}}</div>
                                        @endforeach
                                    @endif
                                    <form id="user-signup-form" method="post" action="{{ route('user.signup') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" id="name" name="name" placeholder="Full Name" required="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="user_name" name="user_name" placeholder="User Name" required />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="email" name="email" placeholder="Email Address" required />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="mobile" name="mobile" placeholder="Mobile Number" required />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="password" name="password" placeholder="Your Password" required/>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required />
                                        </div>
                                        <div class="login_footer form-group mb-50">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="" />
                                                    <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                                </div>
                                            </div>
                                            <a href="#"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                        </div>
                                        <div class="form-group mb-30">
                                            <button id="signup-submit-button" type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="login">Submit &amp; Register</button>
                                        </div>
                                        <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy</p>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 pr-30 d-none d-lg-block">
                            <div class="card-login mt-115">
                                <a href="#" class="social-login facebook-login">
                                    <img src="{{ asset('assets/imgs/theme/icons/logo-facebook.svg') }}" alt="" />
                                    <span>Continue with Facebook</span>
                                </a>
                                <a href="#" class="social-login google-login">
                                    <img src="{{ asset('assets/imgs/theme/icons/logo-google.svg') }}" alt="" />
                                    <span>Continue with Google</span>
                                </a>
                                <a href="#" class="social-login apple-login">
                                    <img src="{{ asset('assets/imgs/theme/icons/logo-apple.svg') }}" alt="" />
                                    <span>Continue with Apple</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let form = document.getElementById("user-signup-form");

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
@endsection
