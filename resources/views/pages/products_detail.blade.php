@extends('layouts.app')

@section('content')

    <div id="breadcrumb" class="clearfix">
        <div class="container">
            <div class="breadcrumb clearfix">
                <ul class="ul-breadcrumb">
                    <li><a href="/" title="Home">Home</a></li>
                    <li><a href="/shop" title="Categories">Shop</a></li>
                    <li><span>{{$product->name}}</span></li>
                </ul>
                <h2 class="bread-title"></h2>
            </div>
        </div>
    </div>
    <!-- end breadcrumb -->

    <div id="columns" class="columns-container">
        <!-- container -->
        <div class="container">
            <div class="row">
                <div class="pb-left-column col-xs-12 col-sm-12 col-md-5">
                    <div id="image-block" class="clearfix">
                        <div id="view_full_size">
                            <img src="/storage/products/{{$product->image_name}}" alt="The Cottage Bouquet" class="img-responsive" width="470" height="627">
                        </div>
                    </div>
                    <!-- end #image-block -->
                    <div id="views_block" class="clearfix">
                        <div id="thumbs_list">
                            <ul id="thumbs_list_frame" class="list-inline">

                                @if(isset($productImage) && count($productImage) > 0)
                                    @foreach($productImage as $obj)
                                        @if($obj->name == $product->image_name)
                                            <li class="first">
                                                <img src="/storage/products/{{$obj->name}}" alt="The Cottage Bouquet" class="img-responsive" width="102" height="136">
                                            </li>
                                        @else
                                            <li>
                                                <img src="/storage/products/{{$obj->name}}" alt="The Cottage Bouquet" class="img-responsive" width="102" height="136">
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <!-- end views_block -->
                </div>
                <!-- end pb-left-column -->
                <div class="pb-center-column col-xs-12 col-sm-12 col-md-7">
                    <div class="pb-centercolumn">
                        <h1>{{$product->name}}</h1>
                        <div class="product_comments clearfix">
                            <!--<div class="product-rating">
                                <div class="star_content">
                                    <div class="star star_on"></div>
                                    <div class="star star_on"></div>
                                    <div class="star star_on"></div>
                                    <div class="star star_on"></div>
                                    <div class="star"></div>
                                </div>
                            </div> -->
                        </div>
                        <!-- end product_comments -->
                        <div class="price clearfix">
                            <p id="productPrice" class="our_price_display">
                                Rp {{number_format( $product->price , 0 , '.' , ',' )}}
                            </p>
                            <p id="productPriceHidden" hidden>{{$product->price}}</p>
                            <!-- <p class="old_price">
                                 $34.00
                             </p>-->
                        </div>
                        <!-- end price -->
                        <div class="product-boxinfo">
                            <!--
                            <p id="product_reference">
                                <label>Reference: </label>
                                <span class="editable">123456</span>
                            </p>
                            <p id="availability_statut">
                                <label>Available: </label>
                                <span id="availability_value" class="label label-success">In stock</span>
                            </p>
                            -->
                        </div>
                        <!-- end product-boxinfo -->
                        <div id="short_description_block">
                           <!-- <p>{{$product->description}}</p>-->
                        </div>
                        <!-- end short_description_block -->
                        <div class="box-info-product clearfix">
                            <div id="attributes">
                                <div class="attribute_fieldset clearfix">
                                    <label class="attribute_label">Size</label>
                                    <div class="attribute_list">
                                        <select id="productSize" class="form-control">
                                            @if(isset($productSize) && count($productSize) > 0)
                                                @foreach($productSize as $size)
                                                    <option value="{{$size->size_id}}">{{$size->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div id="quantity_wanted_p">
                                <label>Quantity</label>
                                <div class="group-quantity">
                                    <button id="btnQuantityMinus" class="btn status-enable btn-sm product_quantity_down">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input type="number" min="1" name="qty" id="quantity_wanted" class="text form-control" readonly value="1">
                                    <button id="btnQuantityPlus" href="#" class="btn status-enable btn-sm product_quantity_down">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- end box-info-product -->
                        <div class="box-cart-bottom clearfix">
                            <button id="add_to_cart" type="submit" name="Submit" class="exclusive btn button btn-primary" title="Add to cart">
                                Add to cart
                            </button>
                        </div>
                        <!-- end box-cart-bottom -->
                        <div class="share-social">
                            <span>Share:</span>
                            <ul class="links list-inline">
                                <li><a href="#"><em class="fa fa-facebook"></em></a></li>
                                <li><a href="#"><em class="fa fa-twitter"></em></a></li>
                                <li><a href="#"><em class="fa fa-google-plus"></em></a></li>
                                <li><a href="#"><em class="fa fa-linkedin"></em></a></li>
                                <li><a href="#"><em class="fa fa-pinterest"></em></a></li>
                                <li class="last"><a href="#"><em class="fa fa-instagram"></em></a></li>
                            </ul>
                        </div>
                        <!-- end share-social -->
                    </div>
                    <!-- end pb-centercolumn -->
                </div>
                <!-- end pb-center-column -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="tabs-top accordion-info">
                        <ul id="myTabs" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Description</a></li>
                            <li role="presentation"><a href="#additional-info" aria-controls="additional-info" role="tab" data-toggle="tab">Additional infomation</a></li>
                            <!-- <li role="presentation"><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Reviews</a></li> -->
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="description">
                                <div class="panel-body">
                                    {{$product->description}}
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="additional-info">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <th>Size</th>
                                            <th>Dimension</th>
                                            <th>Flower/Roses</th>
                                            </thead>
                                            <tbody>
                                            @if(isset($additionalInformation) && count($additionalInformation) > 0)
                                                @foreach($additionalInformation as $info)
                                                    <tr class="odd">
                                                        <td>{{$info->size_name}}</td>
                                                        <td>{{$info->dimension}}</td>
                                                        <td>{{$info->flower_amount}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <!--
                            <div role="tabpanel" class="tab-pane" id="reviews">
                                <div class="panel-body">
                                    <div class="comments-review">
                                        <div class="comments-list">
                                            <div class="media comments">
                                                <div class="pull-left">
                                                    <p class="avatar">
                                                        <img src="/storage/default/profile.png" alt="" width="70" height="70">
                                                    </p>
                                                    <div class="star_content clearfix">
                                                        <div class="star star_on"></div>
                                                        <div class="star star_on"></div>
                                                        <div class="star star_on"></div>
                                                        <div class="star star_on"></div>
                                                        <div class="star star_on"></div>
                                                    </div>
                                                    <p class="author">Tiva</p>
                                                </div>
                                                <div class="media-body">
                                                    <p class="comment-datetime">June 17, 2017</p>
                                                    <div class="comment-desc">Look at the sunset, life is amazing, life is beautiful, life is what you
                                                        make it. To succeed you must believe. When you believe, you will succeed.
                                                        In life there will be road blocks but we will over come it. Celebrate
                                                        success right, the only way, apple. The ladies always say Khaled you
                                                        smell good, I use no cologne. Cocoa butter is the key. </div>
                                                </div>
                                            </div>
                                        </div>
                                        @auth
                            <div class="review-form">
                                <h4 class="title_block">Write a review</h4>
                                <div class="reviews">
                                    <form id="form_review" action="http://tivatheme.com/vietnam-tours" method="post" class="form-validate width_common">
                                        <div class="form-group">
                                            <label>You rate</label>
                                            <div class="star_content clearfix">
                                                <div class="star"></div>
                                                <div class="star"></div>
                                                <div class="star"></div>
                                                <div class="star"></div>
                                                <div class="star"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>You review<sup class="required">*</sup></label>
                                            <textarea id="comment" name="comment" cols="45" rows="6" aria-required="true"></textarea>
                                        </div>
                                        <div class="form-group btn-send">
                                            <button class="btn btn-default">Send your review</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
@endauth
                            </div>
                        </div>
                    </div>
-->
                        </div>
                        <!-- end tab-content -->
                    </div>
                    <!-- end  accordion-info-->
                </div>
            </div>
            <!-- end row -->
            <div class="blockproductscategory block">
                <h4 class="title_block">Related Products</h4>
                <div class="block_content">
                    <div class="owl-row">
                        <div class="blockproductscategory_grid">
                            @if(isset($relatedProducts) && count($relatedProducts) > 0)
                                @foreach($relatedProducts as $relatedProduct)

                                    <div class="item">
                                        <div class="product-container">
                                            <div class="left-block">
                                                <div class="product-image-container">
                                                    <a class="product_img_link" href="/products-detail/{{$relatedProduct->id}}" title="{{$relatedProduct->name}}">
                                                        <img src="/storage/products/{{$relatedProduct->image_name}}" alt="{{$relatedProduct->name}}" class="img-responsive image-effect">
                                                    </a>
                                                    @if($relatedProduct->new==1)
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
                                                        <a class="product-name" href="page-detail.html" title="{{$relatedProduct->name}}">
                                                            {{$relatedProduct->name}}
                                                        </a>
                                                    </h5>
                                                    <div class="content_price">
                                                        <span class="price product-price">Rp {{number_format( $relatedProduct->price , 0 , '.' , ',' )}}</span>
                                                        <!--
                                                        <span class="old-price product-price">$30.51</span>
                                                        -->
                                                    </div>
                                                    <div class="product_comments clearfix">
                                                        <!--  <div class="product-rating">
                                                              <div class="star_content">
                                                                  <div class="star star_on"></div>
                                                                  <div class="star star_on"></div>
                                                                  <div class="star star_on"></div>
                                                                  <div class="star star_on"></div>
                                                                  <div class="star star_on"></div>
                                                              </div>
                                                          </div>-->
                                                    </div>
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
                        <!-- end blockproductscategory_grid -->
                    </div>
                    <!-- end tabproduct-carousel -->
                </div>
            </div>
            <!-- end blockproductscategory -->
        </div>
        <!-- end container -->
    </div>
    <!--end warp-->
    <div class="go-up">
        <a href="#"><i class="fa fa-chevron-up"></i></a>
    </div>
@endsection
@section("script")
    <script>

        $("#btnQuantityMinus").click(function(){
            var quantity = Number($("#quantity_wanted").val());
            if(quantity>1) {
                $("#quantity_wanted").val(quantity - 1);
            }
        });
        $("#btnQuantityPlus").click(function(){
            var quantity = Number($("#quantity_wanted").val());

            $("#quantity_wanted").val(quantity+1);

        });
        $("#productSize").change(function(){
            var sizeId = $(this).val();
            var productId = "{{$product->id}}";
            var productSizeList = <?= json_encode($productSize) ?>;

            for (i = 0; i < productSizeList.length; ++i) {
                if(productId == productSizeList[i].product_id && sizeId == productSizeList[i].size_id) {
                    $("#productPrice").html("Rp "+productSizeList[i].price.toLocaleString());
                    $("#productPriceHidden").html(productSizeList[i].price);
                }
            }


        });

        $("#add_to_cart").click(function(){


            var productId = "{{$product->id}}";
            var sizeId = $("#productSize").val();
            var sizeName = $("#productSize option:selected").text();
            var imageName = "{{$product->image_name}}";
            var productName = "{{$product->name}}";
            var price = $("#productPriceHidden").html();
            var quantity = $("#quantity_wanted").val();
            var data = {product_id:productId,size_id:sizeId,size_name:sizeName ,image_name:imageName,product_name:productName,price:price,quantity:quantity};

            $.ajax({
                url: "/add-to-cart",
                type: "post",
                data:  data,
                success: function (response) {
                    // you will get response from your php page (what you echo or print)
                    var products = response;
                    var quantity = 0;
                    var productString = "";
                    for (i=0;i<products.length;i++){
                        quantity += Number(products[i]["quantity"]);
                        productString += " <tr>" +
                            "<td class=\"product-thumbnail\">" +
                            "<a href=\"page-detail.html\">" +
                            "<img width=\"80\" height=\"107\" alt=\"\" class=\"img-responsive\" src=\"/storage/products/"+products[i]["image_name"]+"\">" +
                            "</a>" +
                            "</td>" +
                            "<td class=\"product-name\">" +
                            "<a href=\"page-detail.html\">"+products[i]["product_name"]+"</a>" +
                            "<br><span class=\"amount\">"+products[i]["size_name"]+" x "+products[i]["quantity"]+"</span>" +
                            "<br><span class=\"amount\"><strong>Rp "+(Number(products[i]["price"])).toLocaleString()+"</strong></span>" +
                            "</td>" +
                            "<td class=\"product-actions\">" +
                            "<a title=\"Remove this item\" product-id=\""+products[i]["product_id"]+"\" size-id=\""+products[i]["size_id"]+"\" class=\"remove-cart-item\">" +
                            "<i class=\"fa fa-times\"></i>" +
                            "</a>" +
                            "</td>" +
                            "</tr>";

                    }
                    $("#cart-container").html(productString);
                    $(".ajax_cart_quantity").html(quantity);
                    var element = document.getElementById("block-cart");
                    element.classList.add("open");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }


            });

        });




    </script>

@endsection

