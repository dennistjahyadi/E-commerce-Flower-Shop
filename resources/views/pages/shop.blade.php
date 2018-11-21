@extends('layouts.app')

@section('content')
    <div id="breadcrumb" class="clearfix">
        <div class="container">
            <div class="breadcrumb clearfix">
                <ul class="ul-breadcrumb">
                    <li><a href="/" title="Home">Home</a></li>
                    <li><span>Bouquets</span></li>
                </ul>
                <h2 class="bread-title">Products List</h2>
            </div>
        </div>
    </div><!-- end breadcrumb -->

    <div id="columns" class="columns-container">
        <!-- container -->
        <div class="container">
            <div class="row">
                <div id="left_column" class="sidebar col-lg-3 col-md-3">
                    <div id="categories_block_left" class="block">
                        <h4 class="title_block">Categories</h4>
                        <div class="block_content">
                            <ul class="list-block">
                                <li class="parent">
                                    @if(isset($categories) &&count($categories) > 0)
                                        @foreach($categories as $category)
                                            <a href="#" id="{{$category->id}}" class="selectCategory" title="Bouquets">
                                                {{$category->name}}
                                                <span class="count">({{$category->total}})  </span>
                                            </a>
                                        @endforeach
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div><!-- end categories_block_left -->

                </div><!-- end left_column -->
                <div id="center_column" class="col-lg-9 col-md-9">

                    <div class="content_sortPagiBar top clearfix">
                        <div class="pull-left hidden-xs">
                            <nav class="tiva-nav-tabs-box">
                                <ul class="nav tiva-nav-tabs" role="tablist">
                                    <li class="active"><a href="#tiva-grid" data-toggle="tab" aria-expanded="true"><i class="fa fa-th"></i></a></li>
                                    <li class=""><a href="#tiva-list" data-toggle="tab" aria-expanded="false"><i class="fa fa-list-ul"></i></a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="sort pull-right">
                            <form id="productsSortForm" action="#" class="form-inline pull-right">
                                <div class="select">
                                    <label for="selectProductSort">Sort by</label>
                                    <select id="selectProductSort" class="selectProductSort form-control">
                                        <option value="newest" selected="selected">Newest</option>
                                        <option value="priceLow">Price: Lowest first</option>
                                        <option value="priceHigh">Price: Highest first</option>
                                        <option value="nameAsc">Product Name: A to Z</option>
                                        <option value="nameDesc">Product Name: Z to A</option>
                                        <option value="stock">Stock</option>
                                    </select>
                                </div>
                            </form>
                            <form id="productsShowForm" action="#" class="form-inline pull-right">
                                <div class="select">
                                    <label for="selectProductShow">Show</label>
                                    <select id="selectProductShow" class="selectProductShow form-control">
                                        <option value="9" selected="selected">9</option>
                                        <option value="15">15</option>
                                        <option value="25">25</option>
                                        <option value="45">45</option>
                                        <option value="60">60</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tiva-grid">
                            <div class="row">
                                @if(isset($products) &&count($products) > 0)
                                    @foreach($products as $product)
                                        <div class="type_block_product col-sp-12 col-xs-6 col-sm-4 col-md-4 col-lg-4">
                                            <div class="product-container">
                                                <div class="left-block">
                                                    <div class="product-image-container">
                                                        <a class="product_img_link" href="/products-detail/{{$product->id}}" title="Tulipa floriade - red">
                                                            <img src="/storage/products/{{$product->image_name}}" alt="Tulipa floriade - red" class="img-responsive image-effect">
                                                        </a>
                                                        @if($product->new==1)
                                                            <span class="label-new label">New</span>
                                                        @endif
                                                    <!--    <span class="label-sale label">Sale</span>
                                                        <span class="label-reduction label">-5%</span> -->
                                                    </div>

                                                </div><!--end left block -->
                                                <div class="right-block">
                                                    <div class="product-box">
                                                        <h5 class="name">
                                                            <a class="product-name" href="products-detail/{{$product->id}}">
                                                                {{$product->name}}
                                                            </a>
                                                        </h5>
                                                        <div class="content_price">

                                                            <span class="price product-price">Rp {{number_format( $product->price , 0 , '.' , ',' )}}</span>
                                                            <!--
                                                            <span class="old-price product-price">$30.51</span>-->
                                                        </div>
                                                        <div class="product_comments clearfix">
                                                            <div class="product-rating">
                                                                <div class="star_content">
                                                                    <div class="star star_on"></div>
                                                                    <div class="star star_on"></div>
                                                                    <div class="star star_on"></div>
                                                                    <div class="star star_on"></div>
                                                                    <div class="star star_on"></div>
                                                                </div>
                                                            </div>
                                                        </div><!-- end product_comments -->
                                                    </div><!--end right block -->
                                                </div>
                                            </div><!-- end product-container-->
                                        </div><!-- end type_block_product -->
                                    @endforeach
                                @endif
                            </div><!-- end row -->
                        </div><!-- end tiva-grid -->
                        <div class="tab-pane fade" id="tiva-list">
                            <div class="row">
                                @if(isset($products) &&count($products) > 0)
                                    @foreach($products as $product)
                                        <div class="type_block_product col-sp-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="product-container">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4">
                                                        <div class="left-block">
                                                            <div class="product-image-container">
                                                                <a class="product_img_link" href="products-detail/{{$product->id}}" title="Tulipa floriade - red">
                                                                    <img src="/storage/products/{{$product->image_name}}" alt="Tulipa floriade - red" class="img-responsive image-effect" width="480" height="640">
                                                                </a>
                                                                <span class="label-new label">New</span>
                                                                <span class="label-sale label">Sale</span>
                                                                <span class="label-reduction label">-5%</span>
                                                            </div>

                                                        </div><!--end left block -->
                                                    </div>
                                                    <div class="col-lg-8 col-md-8">
                                                        <div class="right-block">
                                                            <div class="product-box">
                                                                <h5 class="name">
                                                                    <a class="product-name" href="products-detail/{{$product->id}}" title="Tulipa floriade - red">
                                                                        {{$product->name}}
                                                                    </a>
                                                                </h5>
                                                                <div class="product-des">
                                                                    {{$product->description}}
                                                                </div>
                                                                <div class="content_price">
                                                                    <span class="price product-price">Rp {{number_format( $product->price , 0 , '.' , ',' )}}</span>
                                                                    <!--  <span class="old-price product-price">$30.51</span>-->
                                                                </div>
                                                                <div class="product_comments clearfix">
                                                                    <div class="product-rating">
                                                                        <div class="star_content">
                                                                            <div class="star star_on"></div>
                                                                            <div class="star star_on"></div>
                                                                            <div class="star star_on"></div>
                                                                            <div class="star star_on"></div>
                                                                            <div class="star star_on"></div>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- end product_comments -->
                                                            </div><!--end product-box -->
                                                        </div><!-- end right block -->
                                                    </div>
                                                </div>
                                            </div><!-- end product-container-->
                                        </div><!-- end type_block_product -->
                                    @endforeach
                                @endif
                            </div><!-- end row -->
                        </div><!-- end tiva-list -->
                    </div>
                    <div class="content_sortPagiBar bottom clearfix">
                        <nav>
                        {{$products->links()}}
                        <!--
                      <ul class="pagination">
                        <li>
                          <a href="#" aria-label="Previous">
                            <span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
                          </a>
                        </li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li class="truncate"><span>...</span></li>
                        <li><a href="#">12</a></li>
                        <li>
                          <a href="#" aria-label="Next">
                            <span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
                          </a>
                        </li>
                      </ul>
                        -->
                        </nav>
                    </div>
                </div><!-- end center_column -->
            </div>
        </div> <!-- end container -->
    </div><!--end columns-->
@endsection
@section("script")
    <script>
        $("#selectProductShow").val({{$show}});
        $("#selectProductSort").val("{{$sortBy}}");

        $("#selectProductSort").change(function(){
            var sortBy = $(this).val();
            var show = $("#selectProductShow").val();

            window.location.href = '{{url('')}}'+'/shop/'+show+'/'+sortBy;
        });
        $("#selectProductShow").change(function(){
            var show = $(this).val();
            var sortBy = $("#selectProductSort").val();

            window.location.href = '{{url('')}}'+'/shop/'+show+'/'+sortBy;

        });
        $(".selectCategory").click(function(){
            var id = $(this).attr('id');
            var show = $("#selectProductShow").val();
            var sortBy = $("#selectProductSort").val();
            window.location.href = '{{url('')}}'+'/shop/'+show+'/'+sortBy+'/'+id;

        });
    </script>
@endsection


