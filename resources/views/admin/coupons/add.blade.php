@extends('admin.admin_master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Discount Coupon</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Coupon</li>
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
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li> {{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('coupon.store') }}" method="post">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Coupon Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="coupon_name" type="text" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Coupon Discount(%)</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="coupon_discount" type="number" class="form-control" max="100" required/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Expiry Date</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="expiry_date" type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="submit" class="btn btn-primary px-4" value="Add Coupon" />
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
        $(document).ready(function (){
            $('#category_image').change(function (e) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result)
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
