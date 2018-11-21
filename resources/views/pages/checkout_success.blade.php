@extends("layouts.app")
@section("content")
    <div id="breadcrumb" class="clearfix">
        <div class="container">
            <div class="breadcrumb clearfix">
                <h2 class="bread-title text-center">Checkout Success</h2>
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
                            <h5 class="headingTop text-center" style="margin-bottom: 0px;">Jumlah Tagihan</h5>
                            <h1 class="headingTop text-center">Rp {{number_format( $total_bill , 0 , '.' , ',' )}}</h1>
                            <p class="text-center" style="margin-bottom: 0px;"> Order ID:</p>
                            <h3 class="headingTop text-center">{{$order_id}}</h3>
                            <br/> <br/>
                            <h3 class="headingTop text-center"></h3>
                            <p class="text-center" style="margin-bottom: 0px; font-size: 20px"> Pembayaran dapat dilakukan ke salah satu rekening berikut:</p>


                        </div>
                        <br/><br/>
                        <div class="paymentWrap">
                            <div id="subcategories">
                                <div class="row col-xs-offset-2">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-sp-12">
                                        <img class="img-responsive" src="/storage/logo/logo-bca.gif" alt="">
                                        <p style="margin-bottom: 0px; font-size: 16px"> hello S </p>
                                        <p> <b>548 845 4852</b></p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-sp-12">
                                        <img class="img-responsive" src="/storage/logo/logo-mandiri.gif" alt="">
                                        <p style="margin-bottom: 0px; font-size: 16px"> hello S </p>
                                        <p> <b>548 845 4852</b></p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-sp-12">
                                        <img class="img-responsive" src="/storage/logo/logo-bni.gif" alt="">
                                        <p style="margin-bottom: 0px; font-size: 16px"> hello S </p>
                                        <p> <b>548 845 4852</b></p>
                                    </div>
                                </div>
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
