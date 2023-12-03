@extends('admin.admin_master')
@section('content')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Product</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:"><i class="bx bx-home-alt"></i></a></li>
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
                    <form id="myForm" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Name</label>
                                        <input name="product_name" type="text" class="form-control" id="inputProductTitle" placeholder="Enter product title">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="inputProductTagName" class="form-label">Product Tags</label>
                                        <input name="product_tags" id="inputProductTagName" type="text" class="form-control visually-hidden" data-role="tagsinput" value="new product,top product">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="inputProductSize" class="form-label">Product Size</label>
                                        <input name="product_size" id="inputProductSize" type="text" class="form-control visually-hidden" data-role="tagsinput" value="Small, Medium, Large ">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="inputProductColor" class="form-label">Product Color</label>
                                        <input name="product_color" class="form-control visually-hidden" id="inputProductColor" type="text" data-role="tagsinput" value="Red, Blue, Black">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="inputProductDescription" class="form-label">Short Description</label>
                                        <textarea name="short_description" class="form-control" id="inputProductDescription" rows="3"></textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="mytextarea" class="form-label">Long Description</label>
                                        <textarea id="mytextarea" name="long_description">Hello, World!</textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="formFile" class="form-label">Main Thumbnail</label>
                                        <input name="product_thumbnail" class="form-control" type="file" id="formFile" onChange="mainThumbUrl(this)">

                                        <img style="margin-top: 5px" src="" id="mainThumbImage"  alt=""/>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="multiImg" class="form-label">Multiple Image</label>
                                        <input name="product_images[]" class="form-control" type="file" id="multiImg" multiple="">

                                        <div style="margin-top: 5px"  class="row" id="preview_img"></div>

                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="form-group col-md-6">
                                            <label for="inputPrice" class="form-label">Product Price</label>
                                            <input name="selling_price" type="text" class="form-control" id="inputPrice" placeholder="00.00">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="discount_price" class="form-label">Discount Price</label>
                                            <input name="discount_price" type="text" class="form-control" id="discount_price" placeholder="00.00">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="product_code" class="form-label">Product Code</label>
                                            <input name="product_code" type="text" class="form-control" id="product_code" placeholder="00.00">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="product_quantity" class="form-label">Product Quantity</label>
                                            <input name="product_quantity" type="text" class="form-control" id="product_quantity" placeholder="00.00">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="inputProductType" class="form-label">Product Brand</label>
                                            <select name="brand_id" class="form-select" id="inputProductType">
                                                <option>Select Brand</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="selectCategory" class="form-label">Category</label>
                                            <select name="category_id" class="form-select" id="selectCategory">
                                                <option>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="selectSubCategory" class="form-label">Sub-category</label>
                                            <select name="sub_category_id" class="form-select" id="selectSubCategory">
                                                <option>Select Subcategory</option>

                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="inputCollection" class="form-label">Vendor</label>
                                            <select name="vendor_id" class="form-select" id="inputCollection">
                                                <option>Select Vendor</option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault"> Hot Deals</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault"> Hot Deals</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault"> Hot Deals</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault"> Hot Deals</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Save Product</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end row-->
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--    Thumbnail Image--}}
    <script type="text/javascript">
        function mainThumbUrl(input){
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e){
                    $('#mainThumbImage').attr('src',e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    {{--    Multi Image--}}
    <script>
        $(document).ready(function(){
            $('#multiImg').on('change', function(){ //on file input change
                if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                {
                    let data = $(this)[0].files; //this file data

                    $.each(data, function(index, file){ //loop though each file
                        if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                            const fRead = new FileReader();
                            fRead.onload = (function(file){ //trigger function on successful read
                                return function(e) {
                                    let img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                                        .height(80); //create image element
                                    $('#preview_img').append(img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                }else{
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>

    {{--    Fetch Sub-category --}}
    <script>

        document.getElementById('selectCategory').addEventListener('change', function (){
            getSubCategoriesByCategory(this.value);
        });

        async function getSubCategoriesByCategory(id) {

           let select_subcategory_element = document.getElementById('selectSubCategory');
           select_subcategory_element.innerHTML = '';
           let response = await axios.get(`/subcategory/category/${id}`);

           response.data.forEach((item) => {
               select_subcategory_element.innerHTML += `<option value="${item.id}">${item.subcategory_name}</option>`;
           });

        }

    </script>

    {{--    JQuery Form Validation --}}
    <script>
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    product_name: {
                        required : true,
                    },
                    short_description: {
                        required : true,
                    },
                    product_thumbnail: {
                        required : true,
                    },
                    product_images: {
                        required : true,
                    },
                    selling_price: {
                        required : true,
                    },
                    product_code: {
                        required : true,
                    },
                    product_quantity: {
                        required : true,
                    },
                    brand_id: {
                        required : true,
                    },
                    category_id: {
                        required : true,
                    },
                    subcategory_id: {
                        required : true,
                    },
                },
                messages :{
                    product_name: {
                        required : 'Please Enter Product Name',
                    },
                    short_description: {
                        required : 'Please Enter Short Description',
                    },
                    product_thumbnail: {
                        required : 'Please Select Product Thumbnail Image',
                    },
                    product_images: {
                        required : 'Please Select Product Multi Image',
                    },
                    selling_price: {
                        required : 'Please Enter Selling Price',
                    },
                    product_code: {
                        required : 'Please Enter Product Code',
                    },
                    product_quantity: {
                        required : 'Please Enter Product Quantity',
                    },
                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

    </script>
@endsection
