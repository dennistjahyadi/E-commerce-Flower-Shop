@extends('layouts.app')

@section('content')
    <div class="tiva-slideshow-wrapper">
        <div class="container">
            <div id="tiva-slideshow" class="nivoSlider">
                <a href="#" title="Slideshow image"><img class="img-responsive" src="/storage/slide/slide1-h2.jpg"
                                                         title="#caption1" alt="Slideshow image"></a>
                <a href="#" title="Slideshow image"><img class="img-responsive" src="/storage/slide/slide2-h2.jpg"
                                                         title="#caption2" alt="Slideshow image"></a>
            </div>

            <div id="caption1" class="nivo-html-caption">
                <div class="tiva-caption">
                    <div class="left-right tiva-caption-lr hidden-xs">
                        <div class="very_large_30">Save 30% off</div>
                        <div class="very_large_48">Bouquets</div>
                        <div class="medium_20">Coupon code</div>
                        <div class="medium_24"><span>ATM123VA</span></div>
                        <div class="slow"><a class="btn button btn-now" href="#" title="Shop now">Shop now</a></div>
                    </div>
                </div>
            </div>
            <div id="caption2" class="nivo-html-caption">
                <div class="tiva-caption">
                    <div class="right-left tiva-caption-lr hidden-xs">
                        <div class="very_large_30">Save 30% off</div>
                        <div class="normal very_large_48">Weddings</div>
                        <div class="medium_20">Coupon code</div>
                        <div class="medium_24"><span>ATM123VA</span></div>
                        <div class="slow"><a class="btn button btn-now" href="#" title="Shop now">Shop now</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- end tiva-slideshow-wrapper -->

    <div id="columns" class="columns-container">
        <div class="section section-tabsproduct">
            <div class="container">
                <!-- tabs-top -->
                <div class="tabs-top block">
                    <div class="block-title">
                        <h4 class="title_block">Shop By Collection</h4>
                        <!-- Nav tabs -->
                        <ul id="myTabs" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#bouquets" aria-controls="bouquets"
                                                                      role="tab" data-toggle="tab">Bouquets</a></li>
                            <!--<li role="presentation" class=""><a href="#popular" aria-controls="popular" role="tab" data-toggle="tab">Popular</a></li>-->
                        </ul>
                    </div>
                    <!--end title -->

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="bouquets">
                            <div class="block_content">
                                <div class="row">
                                    @if(isset($products) &&count($products) > 0)
                                        @foreach($products as $product)
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-sp-12">
                                                <div class="product-container">
                                                    <div class="left-block">
                                                        <div class="product-image-container">
                                                            <a class="product_img_link" href="products-detail/{{$product->id}}"
                                                               title="Tulipa floriade - red">
                                                                <img src="/storage/products/{{$product->image_name}}" alt="Tulipa floriade - red"
                                                                     class="img-responsive">
                                                            </a>
                                                            @if($product->new==1)
                                                                <span class="label-new label">New</span>
                                                            @endif
                                                            <!--   <span class="label-sale label">Sale</span> -->
                                                            <!-- <span class="label-reduction label">-5%</span> -->
                                                        </div>

                                                    </div>
                                                    <!--end left block -->
                                                    <div class="right-block">
                                                        <div class="product-box">
                                                            <h5 class="name">
                                                                <a class="product-name" href="products-detail/{{$product->id}}"
                                                                   title="Tulipa floriade - red">
                                                                    {{$product->name}}
                                                                </a>
                                                            </h5>
                                                            <div class="content_price">
                                                                <span class="price product-price">Rp {{number_format( $product->price , 0 , '.' , ',' )}}</span>
                                                                <!--  <span class="old-price product-price">$30.51</span>-->
                                                            </div>
                                                           <!-- <div class="product_comments clearfix">
                                                                <div class="product-rating">
                                                                    <div class="star_content">
                                                                        <div class="star star_on"></div>
                                                                        <div class="star star_on"></div>
                                                                        <div class="star star_on"></div>
                                                                        <div class="star star_on"></div>
                                                                        <div class="star star_on"></div>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                            <!-- end product_comments -->
                                                        </div>
                                                        <!-- end product-box -->
                                                    </div>
                                                    <!--end right block -->
                                                </div>
                                                <!-- end product-container-->
                                            </div>
                                        @endforeach
                                    @endif


                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end block_content -->
                        </div>
                    </div>
                </div>
                <!-- end tabs-top -->
            </div>
            <!-- end container -->
        </div>
        <!-- end section-tabsproduct -->

        <div class="section section-testimoniol">
            <div class="container">
                <div class="testimoniol-slider">
                    <div class="testimoniol-items">
                        <div class="item">
                            <img class="img-responsive" src="storage/testimonial/1.png" alt="">
                            <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum.
                                Mirum est
                                notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum
                                formas humanitatis
                                per seacula quarta decima et quinta decima</p>
                            <a href="#" title="">John Doe</a><br>
                            <span class="position">CEO & Founder</span>
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="storage/testimonial/2.png" alt="">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                                tincidunt
                                ut laoreet dolore magna aliquam erat, anteposuerit litterarum formas humanitatis per
                                seacula
                                quarta decima et quinta decima</p>
                            <a href="#" title="">Tivatheme</a><br>
                            <span class="position">CEO & Founder</span>
                        </div>
                    </div>
                </div>
                <!-- end testimoniol-slider -->
            </div>
            <!-- end container -->
        </div>
        <!--end section-testimoniol-->

    </div>
    <!--end columns -->


    <div class="go-up">
        <a href="#"><i class="fa fa-chevron-up"></i></a>
    </div>
    <!-- end go-up -->
@endsection
