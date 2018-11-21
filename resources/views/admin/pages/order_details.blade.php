@extends("admin.layouts.app")
@section("content")
    <div class="row">
        <div class="col-lg-12">

            <div class="page-header">
                <a href="/admin/order"  style="text-decoration:none"><span class="ti-arrow-left" style="font-size: 25px"></span></a>&nbsp;
                <span style="font-size: 30px">Order Details</span>
            </div>


        </div>
        <div class="col-sm-12">
            <ol class="text-right">
                @if($userOrder->status_id == 2 || $userOrder->status_id == 1)
                    <a href="/admin/order-proceed/{{$userOrder->id}}"><button type="button" class="btn btn-primary">Proceed</button></a>
                @elseif($userOrder->status_id == 3)
                    <a href="/admin/order-complete/{{$userOrder->id}}"><button type="button" class="btn btn-success">Complete</button></a>
                @endif
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                    $padding = 4;
                    ?>
                    <div>
                        <h3 style="margin-top: 0px;">Common Details</h3>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Status</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">
                                    @if($userOrder->status_id == 1)
                                        <span class="label label-default">{{$userOrder->status_name}}</span>
                                    @elseif($userOrder->status_id == 2)
                                        <span class="label label-warning">{{$userOrder->status_name}}</span>
                                    @elseif($userOrder->status_id == 3)
                                        <span class="label label-primary">{{$userOrder->status_name}}</span>
                                    @elseif($userOrder->status_id == 4)
                                        <span class="label label-success">{{$userOrder->status_name}}</span>
                                    @elseif($userOrder->status_id == 11)
                                        <span class="label label-danger">{{$userOrder->status_name}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Order ID</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->id}}</div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Email</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->email}}</div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Fullname</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->fullname}}</div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Phone No</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->phone_number}}</div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Finish Date</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">

                                    <?php

                                    if($userOrder->finished_at!=null){
                                        $myDateTime = DateTime::createFromFormat('Y-m-d h:i:s', $userOrder->finished_at);
                                        $newDateString = $myDateTime->format('d F Y');
                                        echo $newDateString;
                                    }

                                    ?>
                                </div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">No Resi</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->no_resi}}</div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Courir </div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->courir}}</div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-12">
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Proof</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">
                                    @if($userOrder->proof_image!=null)
                                        <button type="button" class="btn btn-xs btn-secondary mb-1" data-toggle="modal" data-target="#smallmodal">
                                            <i class="fa fa-picture-o"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Transfer Date</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">
                                    <?php
                                    if($userOrder->customer_transfer_date!=null){

                                        $myDateTime = DateTime::createFromFormat('Y-m-d h:i:s', $userOrder->customer_transfer_date);
                                        $newDateString = $myDateTime->format('d F Y');
                                        echo $newDateString;
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Transfered to</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->transfered_to}}</div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Transfered amount</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->customer_payment_amount}}</div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Customer Bank Account Number</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->customer_bank_account_number}}</div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Customer Bank Account Name</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->customer_bank_account_name}}</div>
                            </div>

                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">No Resi</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->no_resi}}</div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Courir</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->courir}}</div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Payment Method</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->method_id}}</div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                    $padding = 4;
                    ?>
                    <div>
                        <h3 style="margin-top: 0px;">Shipping Details</h3>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Country</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->country}}</div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Province</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->province}}</div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">City</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->city}}</div>
                            </div>

                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Address</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->address}}</div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Postal Code</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$userOrder->postal_code}}</div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-12">

                        </div>

                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div>
                        <h3 style="margin-top: 0px;">Order Summary</h3>
                    </div>
                    <br/>
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
                                        <img width="80" height="107" class="img-responsive" src="/storage/products/{{$obj->image_name}}">
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
    <div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Payment Proof</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="/storage/proof/{{$userOrder->proof_image}}" class="img-responsive image-effect" width="480" height="640">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

@endsection
