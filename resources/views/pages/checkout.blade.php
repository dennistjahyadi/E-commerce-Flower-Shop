@extends("layouts.app")
@section("content")
<div id="breadcrumb" class="clearfix">
    <div class="container">
        <div class="breadcrumb clearfix">
            <ul class="ul-breadcrumb">
                <li><a href="/" title="Home">Home</a></li>
                <li><span>Checkout</span></li>
            </ul>
            <h2 class="bread-title">Checkout</h2>
        </div>
    </div>
</div><!-- end breadcrumb -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div id="columns" class="columns-container">
    <!-- container -->
    <div class="container">
        <div class="page-checkout">
            <div class="row">
                <div class="checkoutleft col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <p>Returning customer? <a href="page-login.html">Click here to login</a>.</p>
                    <div class="panel-group" id="accordion">
                        <form action="/confirm-order" id="formConfirmOrder" method="post" class="form-horizontal" enctype="multipart/form-data">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            Shipping
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="accordion-body collapse in">
                                    <div class="panel-body">
                                        @csrf
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Country</label>
                                                <select class="form-control" name="country">
                                                    <option value="Indonesia">Indonesia</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Fullname</label>
                                                <input type="text"  name="fullname" value="{{ old('fullname') }}" class="form-control">
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-5">
                                                <label>Phone</label>
                                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label>Province </label>
                                                <select id="province-list" name="province" value="" class="form-control">
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label>City </label>
                                                <input type="text" value="{{ old('city') }}" name="city" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Address </label>
                                                <input type="text" value="{{ old('address') }}" name="address" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label>Postal Code </label>
                                                <input type="text" value="{{ old('poscode') }}" name="poscode" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <!-- <input type="submit" value="Save" class="btn btn-primary pull-right" data-loading-text="Loading..."> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            Payment
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="accordion-body collapse in">
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
                                            <tbody id="shopping-cart">

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
                                                    <strong><span class="amount subtotalPrice">Rp 0</span></strong>
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
                                                    <strong><span class="amount totalPrice">Rp 0</span></strong>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <hr class="tall">

                                        <h4 class="heading-primary">Payment</h4>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="remember-box checkbox">
                                                    <label>
                                                        <input type="checkbox" name="payment_method1"> Payment Method 1
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="remember-box checkbox">
                                                    <label>
                                                        <input type="checkbox" name="payment_method2"> Payment Method 2
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                    <div class="actions-continue pull-right">
                        <input type="submit" value="I confirm my order" id="confirmOrder" name="proceed" class="btn btn-primary">
                    </div>
                </div>
                <div class="checkoutright col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <h4 class="title_block">Cart Totals</h4>
                    <table class="table cart-totals">
                        <tbody>
                            <tr class="cart-subtotal">
                                <th>
                                    <strong>Cart Subtotal</strong>
                                </th>
                                <td>
                                    <strong><span class="amount subtotalPrice">Rp 0</span></strong>
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
                                    <strong><span class="amount totalPrice">Rp 0</span></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end container -->
</div><!--end columns -->
@endsection

@section("script")
    <script>
        var province_states = 'Aceh|Bali|Banten|Bengkulu|Gorontalo|Jakarta Raya|Jambi|Jawa Barat|Jawa Tengah|Jawa Timur|Kalimantan Barat|Kalimantan Selatan|Kalimantan Tengah|Kalimantan Timur|Kepulauan Bangka Belitung|Lampung|Maluku|Maluku Utara|Nusa Tenggara Barat|Nusa Tenggara Timur|Papua|Riau|Sulawesi Selatan|Sulawesi Tengah|Sulawesi Tenggara|Sulawesi Utara|Sumatera Barat|Sumatera Selatan|Sumatera Utara|Yogyakarta';
        var provinceArray = province_states.split("|");
        var provinceString = "";
        var selectedProvince = '{{ old('province') }}';
        for(i=0;i<provinceArray.length;i++){
            if(selectedProvince==provinceArray[i]){
                provinceString += "<option value=\""+provinceArray[i]+"\" selected>"+provinceArray[i]+"</option>";
            }else{
                provinceString += "<option value=\""+provinceArray[i]+"\">"+provinceArray[i]+"</option>";
            }

        }
        $("#province-list").html(provinceString);


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

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            });
        }

        $("#confirmOrder").click(function(){
            $("#formConfirmOrder").submit();
        });

    </script>
@endsection
