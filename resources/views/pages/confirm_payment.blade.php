@extends("layouts.app")
@section("content")
    <div id="breadcrumb" class="clearfix">
        <div class="container">
            <div class="breadcrumb clearfix">
                <h2 class="bread-title text-center">Confirm Payment</h2>
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
                                @if(isset($successMessage) && $successMessage != "")
                                    <div class="alert alert-success" role="alert">
                                        {{$successMessage}}
                                    </div>
                                @elseif(isset($errorMessage) && $errorMessage != "")
                                    <div class="alert alert-danger" role="alert">
                                        {{$errorMessage}}
                                    </div>
                                @endif
                                <form action="/confirm-payment" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>ORDER ID <span class="link">*</span></label>
                                        <input type="text" class="form-control" name="order_id" value="{{ old('order_id') }}">
                                        <div class="form-error">
                                            {!! $errors->first('order_id', '<p class="help-block" style="color: red;">The order id field is required.
</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>PAYMENT TO <span class="link">*</span></label>
                                        <div class="custom-select placeholder">
                                            <div data-text="Select Payment">Select Payment</div>
                                            <select name="transfered_to" class="form-control">
                                                <option value=""></option>
                                                <option value="(BCA) Momo 2548545852" {{ old("transfered_to") == "(BCA) Momo 2548545852" ? "selected":"" }}>(BCA) Momo 2548545852</option>
                                                <option value="(Mandiri) Momo 485525854" {{ old("transfered_to") == "(Mandiri) Momo 485525854" ? "selected":"" }}>(Mandiri) Momo 485525854</option>

                                            </select>
                                        </div>
                                        <div class="form-error">
                                            {!! $errors->first('transfered_to', '<p class="help-block" style="color: red;">Please select payment to</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>PAYMENT ACCOUNT NUMBER <span class="link">*</span></label>
                                        <input type="text" class="form-control" name="payment_account_number" value="{{ old('payment_account_number') }}">
                                        <div class="form-error">
                                            {!! $errors->first('payment_account_number', '<p class="help-block" style="color: red;">Please input your payment bank account number</p>') !!}
                                        </div>                                    </div>
                                    <div class="form-group">
                                        <label>PAYMENT ACCOUNT NAME <span class="link">*</span></label>
                                        <input type="text" class="form-control" name="payment_account_name" value="{{ old('payment_account_name') }}">
                                        <div class="form-error">
                                            {!! $errors->first('payment_account_name', '<p class="help-block" style="color: red;">Please input your bank payment account name</p>') !!}
                                        </div>                                    </div>
                                    <div class="form-group">
                                        <label>TOTAL AMOUNT <span class="link">*</span></label>
                                        <input type="text" class="form-control" name="payment_amount" value="{{ old('payment_amount') }}" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 8'>
                                        <div class="form-error">
                                            {!! $errors->first('payment_amount', '<p class="help-block" style="color: red;">Input your total amount</p>') !!}
                                        </div>                                    </div>
                                    <div class="form-group">
                                        <label>PAYMENT DATE <span class="link">*</span></label>
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <div class="placeholder" >
                                                    <div class="replacement" data-text="DD">DD</div>
                                                    <select name="pay_day" class="form-control">
                                                        <option value=""></option>

                                                        @for ($i = 1; $i <= 31; $i++)

                                                            <option value="{{ $i }}" {{ old("pay_day") == $i ? "selected":"" }}>{{ $i }}</option>

                                                        @endfor

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div class="placeholder" >
                                                    <div class="replacement" data-text="MM">MM</div>
                                                    <select name="pay_month" class="form-control">
                                                        <option value=""></option>
                                                        @for ($i = 1; $i <= 12; $i++)

                                                            <option value="{{ $i }}" {{ old("pay_month") == $i ? "selected":"" }}>{{ $i }}</option>

                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div class="placeholder">
                                                    <div class="replacement" data-text="YYYY">YYYY</div>
                                                    <select name="pay_year" class="form-control">
                                                        <option value=""></option>
                                                        @for ($i = 2017; $i <= 2018; $i++)

                                                            <option value="{{ $i }}" {{ old("pay_year") == $i ? "selected":"" }}>{{ $i }}</option>

                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-error">
                                            {!! $errors->first('pay_day', '<p class="help-block" style="color: red;">:message</p>') !!}
                                            {!! $errors->first('pay_month', '<p class="help-block" style="color: red;">:message</p>') !!}
                                            {!! $errors->first('pay_year', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>UPLOAD A PAYMENT PROOF</label>
                                        <p><input type="file" name="proof_image" accept="image/*"></p>
                                        <div style="line-height:1;margin-top:10px;"><i class="product-detail-info">
                                                This will help us to check your payment and procees your order faster.</i></div>
                                        <div class="form-error"></div>
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
