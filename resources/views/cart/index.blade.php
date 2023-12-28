@extends('frontend.master')

@section('content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
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
                            <h4 class="mb-10">Apply Coupon</h4>
                            <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code> </span></p>
                            <form action="#">
                                <div class="d-flex justify-content-between">
                                    <input class="font-medium mr-15 coupon" name="Coupon" placeholder="Enter Your Coupon">
                                    <button class="btn"><i class="fi-rs-label mr-10"></i>Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="col-lg-7">
                        <div class="divider-2 mb-30"></div>

                        <div class="border p-md-4 cart-totals ml-30">
                            <div class="table-responsive">
                                <table class="table no-border">
                                    <tbody>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 id="subTotalAmount" class="text-brand text-end"></h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Shipping</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-heading text-end">Free</h5></td> </tr> <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Estimate for</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-heading text-end">United Kingdom</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 id="amountTotal" class="text-brand text-end"></h4>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="#" class="btn mb-20 w-100">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
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
                    console.log(response);
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
                                    <h4 class="text-body">$2.51 </h4>
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
                                    <h4 class="text-brand">${value.price}</h4>
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
    </script>
@endsection
