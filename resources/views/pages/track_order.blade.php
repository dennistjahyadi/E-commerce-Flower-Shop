@extends("layouts.app")
@section("content")
    <div id="breadcrumb" class="clearfix">
        <div class="container">
            <div class="breadcrumb clearfix">
                <h2 class="bread-title text-center">Track Order</h2>
            </div>
        </div>
    </div><!-- end breadcrumb -->

    <div id="columns" class="columns-container">
        <!-- container -->
        <div class="container">
            <div class="page-checkout">
                <div class="row">
                    <div class="paymentCont">
                        <div class="headingWrap">
                            <div class="" style="width: 380px;max-width: 100%;margin-left: auto;margin-right: auto;">
                                @if(isset($errorMessage) && $errorMessage != "")
                                    <div class="alert alert-danger" role="alert">
                                        {{$errorMessage}}
                                    </div>
                                @endif
                                <form action="/track-order" method="post" accept-charset="utf-8">
                                    @csrf
                                    <div class="form-group">
                                        <label>ORDER ID <span class="link">*</span></label>
                                        <input type="text" class="form-control" name="order_id" value="{{ old('order_id') }}">
                                        <div class="form-error">
                                            {!! $errors->first('order_id', '<p class="help-block" style="color: red;">The order id is required.
</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group form-submit">
                                        <button type="submit" class="btn btn-block">CONFIRM</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
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
