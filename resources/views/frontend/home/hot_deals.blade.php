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
                                <a href="{{ url('/product/'.$hot_deal->id.'/'.$hot_deal->product_slug) }}"><img src="{{ asset($hot_deal->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{ url('/product/'.$hot_deal->id.'/'.$hot_deal->product_slug) }}">{{ $hot_deal->product_name }}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div class="product-price d-flex justify-between">
                                    @if($hot_deal->discount_price == null)
                                        <span>${{ $hot_deal->selling_price }}</span>
                                    @else
                                        <span>${{ $hot_deal->selling_price - $hot_deal->discount_price }}</span>
                                        <span class="old-price">${{ $hot_deal->selling_price }}</span>
                                    @endif

                                    <div style="margin-left: auto; background-color: rgba(250, 0, 0, 0.1); padding: 5px 10px; border-radius: 5px;" class="add-cart">
                                        <a style="font-size: 16px" class="add" type="submit" onclick="addToCart(this.id)" id="{{ $hot_deal->id }}"><i class="fi-rs-shopping-cart mr-5"></i>Add</a>
                                    </div>
                                </div>

                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0.1">
                <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach($special_offers as $special_offer)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('/product/'.$special_offer->id.'/'.$special_offer->product_slug) }}"><img src="{{ asset($special_offer->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{ url('/product/'.$special_offer->id.'/'.$special_offer->product_slug) }}">{{ $special_offer->product_name }}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div class="product-price d-flex justify-between">
                                    @if($special_offer->discount_price == null)
                                        <span>${{ $special_offer->selling_price }}</span>
                                    @else
                                        <span>${{ $special_offer->selling_price - $special_offer->discount_price }}</span>
                                        <span class="old-price">${{ $special_offer->selling_price }}</span>
                                    @endif

                                    <div style="margin-left: auto; background-color: rgba(250, 0, 0, 0.1); padding: 5px 10px; border-radius: 5px;" class="add-cart">
                                        <a style="font-size: 16px" class="add" type="submit" onclick="addToCart(this.id)" id="{{ $special_offer->id }}"><i class="fi-rs-shopping-cart mr-5"></i>Add</a>
                                    </div>
                                </div>

                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0.2">
                <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach($featured_items as $featured_item)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('/product/'.$featured_item->id.'/'.$featured_item->product_slug) }}"><img src="{{ asset($featured_item->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{ url('/product/'.$featured_item->id.'/'.$featured_item->product_slug) }}">{{ $featured_item->product_name }}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div class="product-price d-flex justify-between">
                                    @if($featured_item->discount_price == null)
                                        <span>${{ $featured_item->selling_price }}</span>
                                    @else
                                        <span>${{ $featured_item->selling_price - $featured_item->discount_price }}</span>
                                        <span class="old-price">${{ $featured_item->selling_price }}</span>
                                    @endif

                                    <div style="margin-left: auto; background-color: rgba(250, 0, 0, 0.1); padding: 5px 10px; border-radius: 5px;" class="add-cart">
                                        <a style="font-size: 16px" class="add" type="submit" onclick="addToCart(this.id)" id="{{ $featured_item->id }}"><i class="fi-rs-shopping-cart mr-5"></i>Add</a>
                                    </div>
                                </div>

                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0.3">
                <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach($special_deals as $special_deal)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('/product/'.$special_deal->id.'/'.$special_deal->product_slug) }}"><img src="{{ asset($special_deal->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{ url('/product/'.$special_deal->id.'/'.$special_deal->product_slug) }}">{{ $special_deal->product_name }}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div class="product-price d-flex justify-between">
                                    @if($special_deal->discount_price == null)
                                        <span>${{ $special_deal->selling_price }}</span>
                                    @else
                                        <span>${{ $special_deal->selling_price - $special_deal->discount_price }}</span>
                                        <span class="old-price">${{ $special_deal->selling_price }}</span>
                                    @endif

                                    <div style="margin-left: auto; background-color: rgba(250, 0, 0, 0.1); padding: 5px 10px; border-radius: 5px;" class="add-cart">
                                        <a style="font-size: 16px" class="add" type="submit" onclick="addToCart(this.id)" id="{{ $special_deal->id }}"><i class="fi-rs-shopping-cart mr-5"></i>Add</a>
                                    </div>
                                </div>

                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
