@extends('admin.admin_master')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Product</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add New</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Add New Product</h5>
                    <hr/>
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Name</label>
                                        <input name="product_name" type="text" class="form-control" id="inputProductTitle" placeholder="Enter product title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTagName" class="form-label">Product Tags</label>
                                        <input name="product_tags" id="inputProductTagName" type="text" class="form-control visually-hidden" data-role="tagsinput" value="new product,top product">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductSize" class="form-label">Product Size</label>
                                        <input name="product_size" id="inputProductSize" type="text" class="form-control visually-hidden" data-role="tagsinput" value="Small, Medium, Large ">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductColor" class="form-label">Product Color</label>
                                        <input name="product_color" class="form-control visually-hidden" id="inputProductColor" type="text" data-role="tagsinput" value="Red, Blue, Black">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Short Description</label>
                                        <textarea name="short_description" class="form-control" id="inputProductDescription" rows="3"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="mytextarea" class="form-label">Long Description</label>
                                        <textarea id="mytextarea" name="long_description">Hello, World!</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Main Thumbnail</label>
                                        <input name="product_thumbnail" class="form-control" type="file" id="formFile">
                                    </div>

                                    <div class="mb-3">
                                        <label for="formFileMultiple" class="form-label">Multiple Image</label>
                                        <input name="product_images[]" class="form-control" type="file" id="formFileMultiple" multiple="">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputPrice" class="form-label">Product Price</label>
                                            <input name="selling_price" type="email" class="form-control" id="inputPrice" placeholder="00.00">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="discount_price" class="form-label">Discount Price</label>
                                            <input name="discount_price" type="password" class="form-control" id="discount_price" placeholder="00.00">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="product_code" class="form-label">Product Code</label>
                                            <input name="product_code" type="email" class="form-control" id="product_code" placeholder="00.00">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="product_quantity" class="form-label">Product Quantity</label>
                                            <input name="product_quantity" type="password" class="form-control" id="product_quantity" placeholder="00.00">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputProductType" class="form-label">Product Brand</label>
                                            <select class="form-select" id="inputProductType">
                                                <option></option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputVendor" class="form-label">Category</label>
                                            <select class="form-select" id="inputVendor">
                                                <option></option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputCollection" class="form-label">Sub-category</label>
                                            <select class="form-select" id="inputCollection">
                                                <option></option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputCollection" class="form-label">Vendor</label>
                                            <select class="form-select" id="inputCollection">
                                                <option></option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault"> Hot Deals</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault"> Hot Deals</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault"> Hot Deals</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault"> Hot Deals</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="button" class="btn btn-primary">Save Product</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end row-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
