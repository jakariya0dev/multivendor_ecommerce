@extends('frontend.master')

@section('content')

    <!--Hero slider-->
    @include('frontend.home.slider')
    <!--End hero slider-->

    <!--Category slider-->
    @include('frontend.home.feature_categories')
    <!--End categories slider-->

    <!--Banners-->
    @include('frontend.home.banner')
    <!--End banners-->

    <!--Products Tabs-->
    @include('frontend.home.new_products')
    <!--Products Tabs-->

    <!--Best Sales-->
    @include('frontend.home.feature_products')
    <!--End Best Sales-->

    <!-- TV Category -->
    @include('frontend.home.category_one')
    <!--End TV Category -->

    <!-- T-shirt Category -->
    @include('frontend.home.category_two')
    <!--End T-shirt Category -->

    <!-- Computer Category -->
    @include('frontend.home.category_three')
    <!--End Computer Category -->

    <!--4 columns-->
    @include('frontend.home.hot_deals')
    <!--End 4 columns-->

    <!--Vendor List -->
    @include('frontend.home.vendor_list')
    <!--End Vendor List -->

@endsection
