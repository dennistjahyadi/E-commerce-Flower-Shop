@extends('layouts.app')

@section('content')
<div id="breadcrumb" class="clearfix">
    <div class="container">
        <div class="breadcrumb clearfix">
            <ul class="ul-breadcrumb">
                <li><a href="/" title="Home">Home</a></li>
                <li><span>Shopping cart</span></li>
            </ul>
            <h2 class="bread-title">Shopping cart</h2>
        </div>
    </div>
</div><!-- end breadcrumb -->

<div id="columns" class="columns-container">
    <!-- container -->
    <div class="container">
        <div id="order-detail-content" class="table_block table-responsive">
            <table id="cart_summary" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="cart_delete last_item">&nbsp;</th>
                        <th class="cart_product first_item">Product</th>
                        <th class="cart_description item">Name</th>
                        <th class="cart_description item">Size</th>
                        <th class="cart_unit item text-right">Unit price</th>
                        <th class="cart_quantity item text-center">Qty</th>
                        <th class="cart_total item text-right">Total</th>
                    </tr>
                </thead>
                <tbody id="shopping-cart">
                 <!--   <tr>
                        <td class="cart_delete text-center">
                            <a title="Remove this item" class="remove" href="#">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                        <td class="cart_product">
                            <a href="page-detail.html">
                                <img width="80" height="107" alt="" class="img-responsive" src="img/product/1.jpg">
                            </a>
                        </td>
                        <td class="cart_description">
                            <a href="page-detail-wines.html">Tulipa floriade - red</a>
                        </td>
                        <td class="cart_unit text-right">
                            <span class="amount">$299</span>
                        </td>
                        <td class="cart_quantity text-center">
                            <div class="quantity">
                                <input type="button" class="minus" value="-">
                                <input type="text" class="input-text qty text" title="Qty" value="1" name="quantity">
                                <input type="button" class="plus" value="+">
                            </div>
                        </td>
                        <td class="cart_total text-right">
                            <span class="amount">$299</span>
                        </td>
                    </tr>-->

                </tbody>
                <tfoot>

                    <tr class="cart_total_price">
                        <td rowspan="3" colspan="4"></td>
                        <td colspan="2" class="total_price_container text-right">
                            <span>Total</span>
                            <div class="hookDisplayProductPriceBlock-price"></div>
                        </td>
                        <td colspan="1" class="price text-right" id="total_price_container">
                            <span id="total_price">Rp 0</span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div><!-- end order-detail-content -->
        <div class="cart_navigation">
            <a href="#" class="button btn btn-primary standard-checkout pull-right checkoutBtn" title="Proceed to checkout">
                <span>Proceed to checkout</span>
                <i class="fa fa-angle-right ml-xs"></i>
            </a>
        </div><!-- end cart_navigation -->
    </div> <!-- end container -->
</div><!--end columns -->
@endsection

@section("script")
    <script>
        //fetch item cart
        fetchShoppingCart();
        function fetchShoppingCart(){

            $.ajax({
                url: "/fetch-item-cart",
                type: "post",
                success: function (response) {
                    var products = response;
                    var quantity = 0;
                    var productString = "";
                    var total = 0;
                    for (i=0;i<products.length;i++){
                        quantity += Number(products[i]["quantity"]);
                        productString += "<tr>" +
                            "                        <td class=\"cart_delete text-center\">" +
                            "                            <a title=\"Remove this item\" product-id=\""+products[i]["product_id"]+"\" size-id=\""+products[i]["size_id"]+"\" class=\"remove remove-cart-item\" href=\"#\">" +
                            "                                <i class=\"fa fa-times\"></i>" +
                            "                            </a>" +
                            "                        </td>" +
                            "                        <td class=\"cart_product\">" +
                            "                            <a href=\"/products-detail/"+products[i]["product_id"]+"\">" +
                            "                                <img width=\"80\" height=\"107\" alt=\"\" class=\"img-responsive\" src=\"storage/products/"+products[i]["image_name"]+"\">" +
                            "                            </a>" +
                            "                        </td>" +
                            "                        <td class=\"cart_description\">" +
                            "                            <a href=\"/products-detail/"+products[i]["product_id"]+"\">"+products[i]["product_name"]+"</a>" +
                            "                        </td>" +
                            "                        <td class=\"cart_description\">" +
                            "                            "+products[i]["size_name"]+
                            "                        </td>" +
                            "                        <td class=\"cart_unit text-right\">" +
                            "                            <span class=\"amount\">Rp "+Number(products[i]["price"]).toLocaleString()+"</span>" +
                            "                        </td>" +
                            "                        <td class=\"cart_quantity text-center\">" +
                            "                            <div class=\"quantity\" product-id=\""+products[i]["product_id"]+"\" size-id=\""+products[i]["size_id"]+"\">" +
                            "                                <input type=\"button\" class=\"minus minusQuantity\" value=\"-\">" +
                            "                                <input type=\"text\" id=\""+products[i]["product_id"]+""+products[i]["size_id"]+"\" class=\"input-text qty text\" readonly title=\"Qty\" value=\""+products[i]["quantity"]+"\" name=\"quantity\">" +
                            "                                <input type=\"button\" class=\"plus plusQuantity\" value=\"+\">" +
                            "                            </div>" +
                            "                        </td>" +
                            "                        <td class=\"cart_total text-right\">" +
                            "                            <span id=\"totalAmount"+products[i]["product_id"]+""+products[i]["size_id"]+"\" class=\"amount\">Rp "+(Number(products[i]["price"])*Number(products[i]["quantity"])).toLocaleString()+"</span>" +
                            "                        </td>" +
                            "                    </tr>";
                            total += (Number(products[i]["price"])*Number(products[i]["quantity"]));
                    }

                    $("#shopping-cart").html(productString);
                    $("#total_price").html("Rp "+total.toLocaleString());

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            });
        }
        $('#shopping-cart').on('click', '.minusQuantity', function(){

            var con = $(this);
            var productId = con.parent().attr("product-id");
            var sizeId = con.parent().attr("size-id");
            var quantity = Number($("#"+productId+""+sizeId).val());
            var num = -1;

            if(quantity>1) {
                con.prop("disabled", true);
                var data = {product_id:productId,size_id:sizeId,num:num};


                $.ajax({
                    url: "/change-quantity-item-cart",
                    type: "post",
                    data:  data,
                    success: function (response) {

                       /* con.prop("disabled", false);

                        $("#"+productId+""+sizeId).val(quantity - 1);
                        $("#totalAmount"+productId+""+sizeId).html();
                        location.reload();*/
                        fetchShoppingCart();

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }


                });




            }
        });
        $('#shopping-cart').on('click', '.plusQuantity', function(){
            var con = $(this);
            var productId = con.parent().attr("product-id");
            var sizeId = con.parent().attr("size-id");
            var quantity = Number($("#"+productId+""+sizeId).val());
            var num = 1;

            con.prop("disabled", true);
            var data = {product_id:productId,size_id:sizeId,num:num};


            $.ajax({
                url: "/change-quantity-item-cart",
                type: "post",
                data:  data,
                success: function (response) {
                 /*   con.prop("disabled", false);

                    $("#"+productId+""+sizeId).val(quantity + 1);
                    $("#totalAmount"+productId+""+sizeId).html();
                    location.reload();*/
                    fetchShoppingCart();

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }


            });


        });
        // remove item in cart
        $('#shopping-cart').on('click', '.remove-cart-item', function(){
            var context = $(this);
            var productId = $(this).attr("product-id");
            var sizeId = $(this).attr("size-id");
            var data = {product_id:productId,size_id:sizeId};

            $.ajax({
                url: "/remove-item-cart",
                type: "post",
                data:  data,
                success: function (response) {
                    // you will get response from your php page (what you echo or print)
                    //   var products = response;
                    var products = response;

                    $(".ajax_cart_quantity").html(products.length);
                    fetchShoppingCart();

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }


            });
        });

    </script>
@endsection
