@extends("admin.layouts.app")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <a href="/admin/order-details/{{$orderId}}"  style="text-decoration:none"><span class="ti-arrow-left" style="font-size: 25px"></span></a>&nbsp;
                <span style="font-size: 30px">Proceed Order</span>

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
                                    <form method="post" action="/admin/order-proceed">
                                        @csrf
                                        <input type="text" name="order_id" value="{{$orderId}}" hidden>
                                        <div class="form-group">
                                            <label>Finish Date <span class="link">*</span></label>
                                            <div class="row">
                                                <div class="col-xs-2">
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
                                                <div class="col-xs-2">
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
                                                <div class="col-xs-3">
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

                                        <div class="form-group form-submit">
                                            <button type="submit" class="btn btn-primary" style="width: 100px;">CONFIRM</button>
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
