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
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#reset-password" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Reset Password</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Hello Rosie!</h3>
                                        </div>
                                        <div class="card-body">
                                            <p>
                                                From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>,<br />
                                                manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Your Orders</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>Order</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Total</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>#1357</td>
                                                        <td>March 45, 2020</td>
                                                        <td>Processing</td>
                                                        <td>$125.00 for 2 item</td>
                                                        <td><a href="#" class="btn-small d-block">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>#2468</td>
                                                        <td>June 29, 2020</td>
                                                        <td>Completed</td>
                                                        <td>$364.00 for 5 item</td>
                                                        <td><a href="#" class="btn-small d-block">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>#2366</td>
                                                        <td>August 02, 2020</td>
                                                        <td>Completed</td>
                                                        <td>$280.00 for 3 item</td>
                                                        <td><a href="#" class="btn-small d-block">View</a></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Orders tracking</h3>
                                        </div>
                                        <div class="card-body contact-from-area">
                                            <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <form class="contact-form-style mt-30 mb-50" action="#" method="post">
                                                        <div class="input-style mb-20">
                                                            <label for="order_id">Order ID</label>
                                                            <input name="order_id" id="order_id" placeholder="Found in your order confirmation email" type="text" />
                                                        </div>
                                                        <div class="input-style mb-20">
                                                            <label for="billing_email">Billing email</label>
                                                            <input name="billing_email" id="billing_email" placeholder="Email you used during checkout" type="email" />
                                                        </div>
                                                        <button class="submit submit-auto-width" type="submit">Track</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h3 class="mb-0">Billing Address</h3>
                                                </div>
                                                <div class="card-body">
                                                    <address>
                                                        3522 Interstate<br />
                                                        75 Business Spur,<br />
                                                        Salt Ste. <br />Marie, MI 49783
                                                    </address>
                                                    <p>New York</p>
                                                    <a href="#" class="btn-small">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Shipping Address</h5>
                                                </div>
                                                <div class="card-body">
                                                    <address>
                                                        4299 Express Lane<br />
                                                        Sarasota, <br />FL 34249 USA <br />Phone: 1.941.227.4444
                                                    </address>
                                                    <p>Sarasota</p>
                                                    <a href="#" class="btn-small">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--  User Profile  --}}
                                <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" id="update-user-profile-form">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="name">Full Name <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="name" id="name" type="text" value="{{$user->name}}"/>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="user_name">User Name <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="user_name" id="user_name" type="text" value="{{$user->user_name}}" disabled/>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="email">Email Address <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="email" id="email" type="email" value="{{$user->email}}"/>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="email">Mobile Number <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="email" id="email" type="email" value="{{$user->mobile}}"/>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="email">Billing Address <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="email" id="email" type="email" value="{{$user->address}}"/>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button id="update-profile-button" type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{--  Reset Password  --}}
                                <div class="tab-pane fade" id="reset-password" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Reset Account Password</h5>
                                        </div>
                                        @if ($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div class="alert alert-danger">{{$error}}</div>
                                            @endforeach
                                        @endif
                                        <div class="card-body">
                                            <form method="post" id="reset-user-password-form" action="{{ route('user.password.reset') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="password">Current Password <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="current_password" id="current_password" type="password" />
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="new_password">New Password <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="new_password" id="new_password" type="password" />
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="confirm_password">Confirm Password <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="confirm_password" id="confirm_password" type="password" />
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button id="reset-user-password-button" type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let form = document.getElementById("reset-user-password-form");

        document.getElementById("reset-user-password-button").addEventListener("click", function (e) {
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
