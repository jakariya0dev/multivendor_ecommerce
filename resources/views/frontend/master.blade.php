<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>Nest - Multipurpose eCommerce HTML Template</title>
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

        <script>

                function quickView(id) {
                    $.ajax({
                        type: 'GET',
                        url: '/product/view/modal/' + id,
                        dataType: 'json',
                        success: function (data) {
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
        </script>
    </body>
</html>
