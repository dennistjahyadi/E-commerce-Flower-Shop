@extends("layouts.app")
@section("content")


    <div id="columns" class="columns-container">
        <!-- container -->
        <div class="container">
            <div class="page-checkout">
                <div class="row">

                    <div class="" style="width: 800px;max-width: 100%;margin-left: auto;margin-right: auto;margin-top: 40px;">
                        <div class="col-sm-12">
                            <div>
                                <div class="col-xs-12" > <h4>Order ID : {{$userOrders->id}}</h4></div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div>
                                <div class="col-xs-12" style="font-weight: bold; margin-top: 15px;">Order Status</div>
                                @if($userOrders->status_id == 1)
                                    <div class="col-xs-12">
                                        <span class="label label-default">Wait for payment</span>
                                    </div>
                                @elseif($userOrders->status_id == 2)
                                    <div class="col-xs-12">
                                        <span class="label label-warning">Wait for verification</span>
                                    </div>
                                @elseif($userOrders->status_id == 3)
                                    <div class="col-xs-12">
                                        <span class="label label-primary">{{$userOrders->status_name}}</span>
                                    </div>
                                @elseif($userOrders->status_id == 4)
                                    <div class="col-xs-12">
                                        <span class="label label-success">{{$userOrders->status_name}}</span>
                                    </div>
                                @elseif($userOrders->status_id == 11)
                                    <div class="col-xs-12">
                                        <span class="label label-danger">{{$userOrders->status_name}}</span>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <div class="col-xs-12" style="font-weight: bold;margin-top: 15px;">Payment</div>
                                <br/>
                                <div class="col-xs-12" >Bank Transfer (BCA, Mandiri, BNI)
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">


                            <!-- <div >
                                 <div class="col-xs-12" style="font-weight: bold; margin-top: 15px;">Delivery Status</div>
                                 <div class="col-xs-12" >...</div>
                             </div>
                             -->
                            <div >
                                <div class="col-xs-12" style="font-weight: bold; margin-top: 15px;">Shipping Address</div>
                                <br/>
                                <div class="col-xs-12" >{{$userOrders->fullname}}</div>
                                <div class="col-xs-12" >{{$userOrders->phone_number}}</div>
                                <div class="col-xs-12" >{{$userOrders->address}}</div>
                                <div class="col-xs-12" >{{$userOrders->city.', '.$userOrders->postal_code}}</div>
                                <div class="col-xs-12" >{{$userOrders->province.', '.$userOrders->country}}</div>
                            </div>

                        </div>

                        <div class="col-sm-12">
                            <div>
                                <div class="col-xs-12" style="font-weight: bold;margin-top: 15px;">Order Summary</div>
                                <br/>

                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered shop_tablecart">
                                    <thead>
                                    <tr>
                                        <th class="product-thumbnail text-center">
                                            Product
                                        </th>
                                        <th class="product-name">
                                            Name
                                        </th>
                                        <th class="cart_description item">
                                            Size
                                        </th>
                                        <th class="product-price text-right">
                                            Price
                                        </th>
                                        <th class="product-quantity text-center">
                                            Quantity
                                        </th>
                                        <th class="product-subtotal text-right">
                                            Total
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $shippingPrice = 0;
                                    $subtotal = 0;
                                    ?>
                                    @if(isset($orderDetails) &&count($orderDetails) > 0)
                                        @foreach($orderDetails as $obj)
                                            <tr>
                                                <td class="cart_product">
                                                    <img width="80" height="107" class="img-responsive" src="storage/products/{{$obj->image_name}}">
                                                </td>
                                                <td class="cart_description">
                                                    {{$obj->product_name}}
                                                </td>
                                                <td class="cart_description">
                                                    {{$obj->size}}
                                                </td>
                                                <td class="cart_unit text-right">
                                                    <span class="amount">Rp {{number_format($obj->price)}}</span>
                                                </td>
                                                <td class="cart_quantity text-center">
                                                    {{$obj->quantity}}
                                                </td>
                                                <td class="cart_total text-right">
                                                    <span id="totalAmount" class="amount">Rp {{number_format($obj->price * $obj->quantity)}}</span>
                                                </td>
                                            </tr>
                                            <?php
                                            $subtotal+=$obj->price * $obj->quantity;
                                            ?>
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>

                                <hr class="tall">

                                <h4 class="heading-primary">Cart Totals</h4>
                                <table class="table cart-totals">
                                    <tbody>
                                    <tr class="cart-subtotal">
                                        <th>
                                            <strong>Cart Subtotal</strong>
                                        </th>
                                        <td>
                                            <strong><span>Rp {{number_format($subtotal)}}</span></strong>
                                        </td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>
                                            Shipping
                                        </th>
                                        <td>
                                            Free Shipping<input type="hidden" value="free_shipping" class="shipping_method" name="shipping_method">
                                        </td>
                                    </tr>
                                    <tr class="total">
                                        <th>
                                            <strong>Order Total</strong>
                                        </th>
                                        <td>
                                            <strong><span>Rp {{number_format($subtotal + $shippingPrice)}}</span></strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <hr class="tall">
                            </div>
                        </div>
                    </div>

                </div>
            </div> <!-- end container -->
        </div><!--end columns -->
    </div>
    <!--end warp-->
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
                            "                                "+products[i]["quantity"]+
                            "                        </td>" +
                            "                        <td class=\"cart_total text-right\">" +
                            "                            <span id=\"totalAmount"+products[i]["product_id"]+""+products[i]["size_id"]+"\" class=\"amount\">Rp "+(Number(products[i]["price"])*Number(products[i]["quantity"])).toLocaleString()+"</span>" +
                            "                        </td>" +
                            "                    </tr>";
                        total += (Number(products[i]["price"])*Number(products[i]["quantity"]));
                    }

                    $("#shopping-cart").html(productString);
                    $(".subtotalPrice").html("Rp "+total.toLocaleString());
                    $(".totalPrice").html("Rp "+total.toLocaleString());

                    console.log(products);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            });
        }



    </script>
@endsection
