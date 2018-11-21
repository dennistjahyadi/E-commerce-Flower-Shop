@extends("admin.layouts.app")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <a href="/admin/order-details/{{$orderId}}"  style="text-decoration:none"><span class="ti-arrow-left" style="font-size: 25px"></span></a>&nbsp;
                <span style="font-size: 30px">Complete Order</span>
            </div>
        </div>
        <div class="col-sm-12">
            <ol class="text-right">
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

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body card-block">
                                    <form method="post" action="/admin/order-complete">
                                        @csrf
                                        <input type="text" name="order_id" value="{{$orderId}}" hidden>
                                        <div class="form-group col-xs-4">
                                            <label>Courir</label>
                                            <input class="form-control" type="text" name="courir">
                                        </div>
                                        <div class="col-xs-12">
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label>No Resi</label>
                                            <input class="form-control" type="text" name="no_resi">

                                        </div>

                                        <div class="form-group col-xs-12 form-submit">
                                            <button type="submit" class="btn btn-success" style="width: 100px;">CONFIRM</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
