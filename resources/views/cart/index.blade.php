@extends('frontend.master')

@section('content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop
                <span></span> Cart
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h1 class="heading-2 mb-10">Your Cart</h1>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are <span class="text-brand">3</span> products in your cart</h6>
                    <h6 class="text-body"><a href="#" class="text-muted"><i class="fi-rs-trash mr-5"></i>Clear Cart</a></h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                        <tr class="main-heading">
                            <th class="custome-checkbox start pl-30">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                <label class="form-check-label" for="exampleCheckbox11"></label>
                            </th>
                            <th scope="col" colspan="2">Product</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col" class="end">Remove</th>
                        </tr>
                        </thead>
                        <tbody id="cartListBody">

                        </tbody>
                    </table>
                </div>

                <div class="row mt-50">

                    <div class="col-lg-5">
                        <div class="p-40">
                            @if(Session::has('coupon'))
                                <h4 class="mb-10">Coupon Applied</h4>
                                <p class="mb-20"><span class="font-lg text-muted">You used a promo code> </span></p>
                                <div class="d-flex justify-content-between">
                                    <input value="{{ Session::get('coupon')['coupon_name'] }}" class="font-medium mr-15 coupon" readonly>
                                    <button class="btn" disabled><i class="fi-rs-label mr-10"></i>Apply</button>
                                </div>
                            @else
                                <h4 class="mb-10">Apply Coupon</h4>
                                <p class="mb-20"><span class="font-lg text-muted">Using A Promo Code> </span></p>
                                <div class="d-flex justify-content-between">
                                    <input id="couponValue" name="couponName" class="font-medium mr-15 coupon" placeholder="Enter Your Coupon">
                                    <a type="submit" onclick="applyCoupon()" class="btn"><i class="fi-rs-label mr-10"></i>Apply</a>
                                </div>
                            @endif
                        </div>
                        <div id="couponFeedbackMessage" class="alert alert-warning d-none"></div>
                    </div>

                    <div class="col-lg-7">
                        <div class="divider-2 mb-30"></div>

                        <div class="border p-md-4 cart-totals ml-30">
                            <div class="table-responsive">
                                <table class="table no-border">
                                    <tbody>
                                    @if(Session::has('coupon'))

                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Total</h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 id="subTotalAmount" class="text-brand text-end">${{ Cart::total() }}</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Coupon Applied</h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 id="subTotalAmount" class="text-brand text-end">{{ Session::get('coupon')['coupon_name'] }} <a type="submit" onclick="removeCoupon()"><i class="fi-rs-trash"></i> </a></h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Discount</h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 id="subTotalAmount" class="text-brand text-end">${{ Session::get('coupon')['discount_amount'] }} ({{ Session::get('coupon')['coupon_discount'] }}%)</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Total</h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 id="subTotalAmount" class="text-brand text-end">${{ Session::get('coupon')['total_amount'] }}</h4>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Total</h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 id="subTotalAmount" class="text-brand text-end">${{ Cart::total() }}</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Grand Total</h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 id="subTotalAmount" class="text-brand text-end">${{ Cart::total() }} </h4>
                                            </td>
                                        </tr>

                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <a href="#" class="m-auto btn mb-20 w-50">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        getAllCartData();

        function getAllCartData() {

            $.ajax({
                type: 'get',
                dataType: 'json',
                url: '/all-cart-data',
                success: function (response) {

                    let cartList = '';
                    $.each(response.carts, function (key, value) {

                        cartList += `
                            <tr class="pt-30">
                                <td class="custome-checkbox pl-30">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                    <label class="form-check-label" for="exampleCheckbox1"></label>
                                </td>
                                <td class="image product-thumbnail pt-40">
                                    <img src="/${value.options.image}" alt="#">
                                </td>
                                <td class="product-des product-name">
                                    <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">${value.name}</a></h6>
                                </td>
                                <td class="price" data-title="Price">
                                    <h4 class="text-body">${value.price}</h4>
                                </td>
                                <td class="text-center detail-info" data-title="Stock">
                                    <div class="detail-extralink mr-15">
                                        <div class="detail-qty border radius">
                                            <a onclick="cartQuantityDecrement(this.id)" id="${value.rowId}" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                            <input type="text" name="quantity" class="qty-val" value="${value.qty}" min="1">
                                            <a onclick="cartQuantityIncrement(this.id)" id="${value.rowId}" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                    </div>
                                </td>
                                <td class="price" data-title="Price">
                                    <h4 class="text-brand">${value.subtotal}</h4>
                                </td>
                                <td class="action text-center" data-title="Remove">
                                    <a id="${value.rowId}" onclick="removeItemFromCart(this.id)" class="text-body"><i class="fi-rs-trash"></i></a>
                                </td>
                            </tr>
                        `;
                    });

                    $('#cartListBody').html(cartList);
                    $('#subTotalAmount').html(`\$${response.cart_total}`);
                    $('#amountTotal').html(`\$${response.cart_total}`);

                }
            })
        }

        function removeItemFromCart(id) {
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

                        getAllCartData();
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

        function cartQuantityIncrement(id){
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: `/cart/increment/${id}`,
                success: function (response) {
                    console.log(response.message);
                    getAllCartData();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        function cartQuantityDecrement(id){
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: `/cart/decrement/${id}`,
                success: function () {
                    getAllCartData();
                }
            });
        }

        function applyCoupon(){
            let couponName = $('#couponValue').val();
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '/cart/apply/coupon',
                data: {
                    couponName: couponName
                },
                success: function (response) {
                    console.log(response);
                    let couponFeedbackMessage = $('#couponFeedbackMessage');
                    if (response.validity === true){
                        $('#couponValue').prop('readonly', true);
                        couponFeedbackMessage.removeClass('d-none');
                        couponFeedbackMessage.text(response.message);
                        location.reload(true);
                    }
                    else {
                        couponFeedbackMessage.removeClass('d-none');
                        couponFeedbackMessage.text(response.message);
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });

        }

        function removeCoupon() {
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: '/cart/remove/coupon',
                success: function (data) {
                    console.log(data);
                    location.reload(true);
                },
                error: function (data) {
                    console.log(data);
                },
            })
        }

    </script>
@endsection
