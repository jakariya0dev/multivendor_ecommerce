@extends('frontend.master')

@section('content')

    <!--Hero slider-->
    @include('frontend.layouts.home.slider')
    <!--End hero slider-->

    <!--Category slider-->
    @include('frontend.layouts.home.feature_categories')
    <!--End categories slider-->

    <!--Banners-->
    @include('frontend.layouts.home.banner')
    <!--End banners-->

    <!--Products Tabs-->
    @include('frontend.layouts.home.new_products')
    <!--Products Tabs-->

    <!--Best Sales-->
    @include('frontend.layouts.home.feature_products')
    <!--End Best Sales-->

    <!-- TV Category -->
    @include('frontend.layouts.home.category_one')
    <!--End TV Category -->

    <!-- T-shirt Category -->
    @include('frontend.layouts.home.category_two')
    <!--End T-shirt Category -->

    <!-- Computer Category -->
    @include('frontend.layouts.home.category_three')
    <!--End Computer Category -->

    <!--4 columns-->
    @include('frontend.layouts.home.hot_deals')
    <!--End 4 columns-->

    <!--Vendor List -->
    @include('frontend.layouts.home.vendor_list')
    <!--End Vendor List -->

@endsection
