<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>Nest - Multipurpose eCommerce HTML Template</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta property="og:title" content=""/>
        <meta property="og:type" content=""/>
        <meta property="og:url" content=""/>
        <meta property="og:image" content=""/>
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/imgs/theme/favicon.svg') }}" />
        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/animate.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css?v=5.3') }}" />
    </head>
    <body>
        <!-- Modal -->

        <!-- Quick view -->
        @include('frontend.layouts.quick_view')
        <!-- Header  -->
        @include('frontend.layouts.header')
        <!--End header-->

        <main class="main">
            @yield('content')
        </main>

        @include('frontend.layouts.footer')
        <!-- Preloader Start -->
        @include('frontend.layouts.pre_loader')
        <!-- Vendor JS-->
        <script src="{{ asset('assets/frontend/js/vendor/modernizr-3.6.0.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/vendor/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/vendor/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/slick.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/jquery.syotimer.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/waypoints.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/wow.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/magnific-popup.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/select2.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/counterup.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/images-loaded.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/isotope.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/scrollup.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/jquery.vticker-min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/jquery.theia.sticky.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/jquery.elevatezoom.js') }}"></script>
        <!-- Template  JS -->
        <script src="{{ asset('assets/frontend/js/main.js?v=5.3') }}"></script>
        <script src="{{ asset('assets/frontend/js/shop.js?v=5.3') }}"></script>

{{--         Sweet Alert--}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $.ajaxSetup({
                headers:{

                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            addDataToMiniCart();

            function quickView(id) {
                $.ajax({
                    type: 'GET',
                    url: '/product/view/modal/' + id,
                    dataType: 'json',
                    success: function (data) {
                        $('#product_id').val(data.product.id);
                        $('#productName').text(data.product.product_name);
                        $('#productCode').text(data.product.product_code);
                        $('#brandName').text(data.product.brand.brand_name);
                        $('#productCategory').text(data.product.category.category_name);
                        $('#productThumbnail').html(`<img  src="{{ asset('${data.product.product_thumbnail}') }}"  alt=""/>`);


                        if(data.product.discount_price == null){
                            $('#productDiscount').css('display', 'none');
                            $('#oldPrice').text('');
                            $('#productPrice').text(`\$${data.product.selling_price}`);
                        }else{
                            $('#productDiscount').text(`\$${data.product.discount_price} off`);
                            $('#oldPrice').text(`\$${data.product.selling_price}`);
                            $('#productPrice').text(`\$${data.product.selling_price-data.product.discount_price}`);
                        }

                        if (data.product.product_size == null){
                            $('#productSize').hide();
                        }else {
                            $('#productSize').empty();
                            data.size.forEach((value) => {
                                $('#productSize').append(`<option value="${value}">${value}</option>`);
                            });
                        }

                        if (data.product.product_color == null){
                            $('#productColor').hide();
                        }else {
                            $('#productColor').empty();
                            data.color.forEach((value) => {
                                $('#productColor').append(`<option value="${value}">${value}</option>`);
                            });
                        }

                        if (data.product.product_quantity > 0){
                            $('#stockOut').hide();
                        }else {
                            $('#available').hide();
                        }

                    }
                })
        }

            function addToCart() {

                let id = $('#product_id').val();
                let quantity = $('#selectedQuantity').val();
                let color = $('#productColor').val();
                let size = $('#productSize').val();

                $.ajax({
                    type: "POST",
                    dataType : 'json',
                    data:{
                        color:color, size:size, quantity:quantity,
                    },
                    url: "/product-add-to-cart/"+id,
                    success:function(response){

                        // addDataToMiniCart(response);

                        $('#closeModal').click();

                        if($.isEmptyObject(response.error)){
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Added to cart",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                        else {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: "Failed to cart",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }

                        $.each(response.carts, function (key, value) {
                            $('#headerCart').html(`
                                <li>
                                    <div class="shopping-cart-img">
                                        <a href=""><img alt="Nest" src="" /></a>
                                    </div>
                                    <div class="shopping-cart-title">
                                        <h4><a href="">${value.name}</a></h4>
                                        <h4><span>${value.qty} × </span>$${value.qty}</h4>
                                    </div>
                                    <div class="shopping-cart-delete">
                                        <a href="#"><i class="fi-rs-cross-small"></i></a>
                                    </div>
                                </li>
                        `)
                        });
                        addDataToMiniCart();
                    }
                });
            }

            function addDataToMiniCart() {

                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    url: '/all-cart-data',
                    success: function (response) {
                        let cartList = '';
                        $.each(response.carts, function (key, value) {

                            cartList += `
                                <li>
                                    <div class="shopping-cart-img">
                                        <a href="shop-product-right.html"><img alt="Nest" src="/${value.options.image} " style="width:50px;height:50px;" /></a>
                                    </div>
                                    <div class="shopping-cart-title" style="margin: -60px 74px 0; width: 146px;" >
                                        <h4><a href="shop-product-right.html"> ${value.name} </a></h4>
                                        <h4><span>${value.qty} × </span>${value.price}</h4>
                                    </div>
                                    <div class="shopping-cart-delete" style="margin: -85px 1px 0px;">
                                        <a id="${value.rowId}" onclick="removeCartItem(this.id)"><i class="fi-rs-cross-small"></i></a>
                                    </div>
                                </li>
                                <hr> <br>
                        `;

                        });
                        $('#headerCart').html(cartList);
                        $('#totalAmount').text(response.cart_total);
                    }
                })
            }

            function removeCartItem(id) {
                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    url: '/remove-cart-item/'+id,
                    success: function (response) {
                        if($.isEmptyObject(response.error)){
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Remove from cart",
                                showConfirmButton: false,
                                timer: 2000
                            });

                            addDataToMiniCart();
                        }
                        else {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: "Failed to remove from cart",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    }
                });
            }
        </script>
    </body>
</html>
