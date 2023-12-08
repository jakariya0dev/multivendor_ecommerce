@php
    $hot_deals = \App\Models\Product::where('hot_deals',1)->where('discount_price','!=', NULL)->orderBy('id','DESC')->limit(3)->get();
    $special_offers = \App\Models\Product::where('special_offer',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
    $featured_items = \App\Models\Product::where('featured_item',1)->orderBy('id','DESC')->limit(3)->get();
    $special_deals = \App\Models\Product::where('special_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
@endphp

<section class="section-padding mb-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach($hot_deals as $hot_deal)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="#"><img src="{{ asset($hot_deal->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="#">{{ $hot_deal->product_name }}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div class="product-price">
                                    @if($hot_deal->discount_price == null)
                                        <span>${{ $hot_deal->selling_price }}</span>
                                    @else
                                        <span>${{ $hot_deal->selling_price - $hot_deal->discount_price }}</span>
                                        <span class="old-price">${{ $hot_deal->selling_price }}</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                <h4 class="section-title style-1 mb-30 animated animated">  Special Offer </h4>
                <div class="product-list-small animated animated">
                    @foreach($special_offers as $special_offer)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="#"><img src="{{ asset($special_offer->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="#">{{ $special_offer->product_name }}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div class="product-price">
                                    @if($special_offer->discount_price == null)
                                        <span>${{ $special_offer->selling_price }}</span>
                                    @else
                                        <span>${{ $special_offer->selling_price - $special_offer->discount_price }}</span>
                                        <span class="old-price">${{ $special_offer->selling_price }}</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                <h4 class="section-title style-1 mb-30 animated animated">Featured Items</h4>
                <div class="product-list-small animated animated">
                    @foreach($featured_items as $featured_item)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="#"><img src="{{ asset($featured_item->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="#">{{ $featured_item->product_name }}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div class="product-price">
                                    @if($featured_item->discount_price == null)
                                        <span>${{ $featured_item->selling_price }}</span>
                                    @else
                                        <span>${{ $featured_item->selling_price - $featured_item->discount_price }}</span>
                                        <span class="old-price">${{ $featured_item->selling_price }}</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach($special_deals as $special_deal)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="#"><img src="{{ asset($special_deal->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="#">{{ $special_deal->product_name }}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div class="product-price">
                                    @if($hot_deal->discount_price == null)
                                        <span>${{ $special_deal->selling_price }}</span>
                                    @else
                                        <span>${{ $special_deal->selling_price - $special_deal->discount_price }}</span>
                                        <span class="old-price">${{ $special_deal->selling_price }}</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
