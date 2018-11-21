@extends("admin.layouts.app")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <a href="/admin/product-details/{{$productId}}/2" style="text-decoration:none"><span class="ti-arrow-left" style="font-size: 25px"></span></a>&nbsp;
                <span style="font-size: 30px">Add Product Image</span>

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
                                    <form method="post" action="/admin/product-image-create" enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" name="product_id" value="{{$productId}}" hidden>
                                        <div class="form-group col-xs-6">
                                            <div class="form-group col-xs-8">
                                                <label>Image <span class="link">*</span></label>
                                                <p><input type="file" name="image" accept="image/*"></p>

                                                <div class="form-error">
                                                    {!! $errors->first('image', '<p class="help-block" style="color: red;">Please upload an image</p>') !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                            </div>
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
