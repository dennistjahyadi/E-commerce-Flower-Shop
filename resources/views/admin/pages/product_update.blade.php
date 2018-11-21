@extends("admin.layouts.app")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <a href="/admin/products" style="text-decoration:none"><span class="ti-arrow-left" style="font-size: 25px"></span></a>&nbsp;
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body card-block">
                                    <form method="post" action="/admin/product-update" enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" name="product_id" value="{{ $product->id}}" hidden>
                                        <div class="form-group col-xs-6">
                                            <div class="form-group col-xs-6">
                                                <label>Name <span class="link">*</span></label>
                                                <input class="form-control" type="text" name="name" value="{{ $product->name}}">
                                                <div class="form-error">
                                                    {!! $errors->first('name', '<p class="help-block" style="color: red;">:message</p>') !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label>Category <span class="link">*</span></label>
                                                <select name="category" class="form-control">
                                                    <option value=""></option>
                                                    @if(isset($categories) &&count($categories) > 0)
                                                        @foreach($categories as $obj)
                                                            <option value="{{ $obj->id }}" {{ $product->category_id == $obj->id  ? "selected":"" }}>{{ $obj->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="form-error">
                                                    {!! $errors->first('category', '<p class="help-block" style="color: red;">:message</p>') !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                            </div>
                                            <div class="form-group col-xs-8">
                                                <label>Description </label>
                                                <textarea class="form-control" name="description">{{$product->description}}</textarea>

                                            </div>
                                            <div class="col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <div class="form-group col-xs-8">
                                                <label>Default Cover Image</label>
                                                <p><input type="file" name="image" accept="image/*"></p>
                                                <div style="line-height:1;margin-top:10px;"><i class="product-detail-info">
                                                        It will be the default picture of this product.</i></div>
                                                <div class="form-error">
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                            </div>
                                        </div>

                                        <div class="form-group form-submit col-xs-12 text-center">
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
