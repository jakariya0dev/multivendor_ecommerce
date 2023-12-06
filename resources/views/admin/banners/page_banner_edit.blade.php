@extends('admin.admin_master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Banners</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Banner</li>
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
                                    <form action="{{ route('banner.update', $banner->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="old_pic" value="{{ $banner->banner_image }}">
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Banner Title</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input value="{{ $banner->banner_title }}" name="banner_title" type="text" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Banner Url</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input value="{{ $banner->banner_url }}" name="banner_url" type="text" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Photo</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="old_pic" type="hidden" value="{{$banner->banner_image}}" />
                                                <input name="banner_image" id="banner_image" type="file" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0"></h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <img id="image" class="mb-0" src="{{ !empty($banner->banner_name) ? asset($banner->banner_image) : asset('images/no_image.jpg') }}" style="height: 120px; width: 120px;" alt=""/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
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
            $('#banner_image').change(function (e) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result)
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection

