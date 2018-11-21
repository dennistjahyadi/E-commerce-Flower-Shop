@extends("admin.layouts.app")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <a href="/admin/product-details/{{$productId}}/1" style="text-decoration:none"><span class="ti-arrow-left" style="font-size: 25px"></span></a>&nbsp;
                <span style="font-size: 30px">Create Product</span>

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
                                    <form method="post" action="/admin/product-size-create">
                                        @csrf
                                        <input type="text" name="product_id" value="{{$productId}}" hidden>

                                        <div class="form-group col-xs-6">
                                            <label>Size <span class="link">*</span></label>
                                            <select name="size" class="form-control">
                                                <option value=""></option>
                                                @if(isset($size) &&count($size) > 0)
                                                    @foreach($size as $obj)
                                                        <option value="{{ $obj->id }}" {{ old("size") == $obj->id  ? "selected":"" }}>{{ $obj->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="form-error">
                                                {!! $errors->first('size', '<p class="help-block" style="color: red;">:message</p>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <label>Dimension <span class="link">*</span></label>
                                            <input class="form-control" type="text" name="dimension" placeholder="ex: 25 cm" value="{{ old("dimension")}}">
                                            <div class="form-error">
                                                {!! $errors->first('dimension', '<p class="help-block" style="color: red;">:message</p>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <label>Flower Amount <span class="link">*</span></label>
                                            <input class="form-control" type="text" name="flower_amount" placeholder="ex: 30 roses / 80 flowers" value="{{ old("flower_amount")}}">
                                            <div class="form-error">
                                                {!! $errors->first('flower_amount', '<p class="help-block" style="color: red;">:message</p>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <label>Price <span class="link">*</span></label>
                                            <input class="form-control" type="text" name="price" placeholder="ex: 300000" value="{{ old("price")}}" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 8'>
                                            <div class="form-error">
                                                {!! $errors->first('price', '<p class="help-block" style="color: red;">:message</p>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                        </div>
                                        <div class="form-group form-submit col-xs-12">
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
