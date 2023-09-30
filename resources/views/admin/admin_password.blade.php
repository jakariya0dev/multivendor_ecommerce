@extends('admin.admin_master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Admin Password Update</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href=""><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Admin Password Update</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="update-password-form" action="{{ route('admin.password.update') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @if(session("status"))
                                            <div class="alert alert-success">{{ session("status") }}</div>
                                        @elseif(session("error"))
                                            <div class="alert alert-danger">{{ session("error") }}</div>
                                        @endif
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Current password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="old_password" id="old_password" type="password" class="form-control" required />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">New password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="new_password" id="new_password" type="password" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Confirm password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="confirm_password_" id="confirm_password_" type="password" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input id="submit_button" type="submit" class="btn btn-primary px-4" value="Change Password" />
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

    <script>
        let form = document.getElementById("update-password-form");

        document.getElementById("submit_button").addEventListener("click", function (e) {
            e.preventDefault();
            let newPassword = document.getElementById("new_password").value;
            let confirmPassword = document.getElementById("confirm_password_").value;

            if (newPassword !== confirmPassword) {
                alert("Password didnt match try again.");
                return false;
            } else if (newPassword === confirmPassword) {
                form.submit();
            }
        });
    </script>
@endsection
