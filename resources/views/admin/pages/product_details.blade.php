@extends("admin.layouts.app")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <a href="/admin/products"  style="text-decoration:none"><span class="ti-arrow-left" style="font-size: 25px"></span></a>&nbsp;
                <span style="font-size: 30px">Product Details</span>
            </div>

        </div>
        <div class="col-sm-12">
            <ol class="text-right">
                <button type="button" id="btnActivateProduct" class="btn btn-success btn-sm"> Activate</button>
                <button type="button" id="btnDeactivateProduct" class="btn btn-danger btn-sm"> Deactivate</button>
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
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Name</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$product->name}}</div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Category</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$product->category_name}}</div>
                            </div>
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Description</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">{{$product->description}}</div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="col-xs-12" >
                                <div class="col-xs-4" style="padding: {{$padding}}px;">Status</div>
                                <div class="col-xs-8"  style="padding: {{$padding}}px;">
                                    @if($product->active==1)
                                        <span class="label label-success">active</span>

                                    @else
                                        <span class="label label-danger">inactive</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="{{  $tab==1 ? 'active' : '' }}"><a href="/admin/product-details/{{$product->id}}/1">Product Size</a></li>
                        <li class="{{  $tab==2 ? 'active' : '' }}"><a href="/admin/product-details/{{$product->id}}/2">Product Image</a></li>
                    </ul>
                    <br>
                    @if($tab==1)
                        <div id="productSizeContainer">
                            <div class="col-sm-12">
                                <ol class="text-right">
                                    <a href="/admin/product-size-create/{{$product->id}}"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Add</button></a>
                                </ol>
                            </div>
                            <div class="col-sm-12">
                                <table width="100%"  class="table table-striped table-bordered table-hover" id="dataTablesOrder">
                                    <thead>
                                    <tr>
                                        <th>Size</th>
                                        <th>Dimension</th>
                                        <th>Flower Amount</th>
                                        <th>Price</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($productSize) &&count($productSize) > 0)
                                        @foreach($productSize as $obj)
                                            <tr class="odd gradeX">
                                                <td class="align-middle">{{$obj->size_name}}</td>

                                                <td class="align-middle">{{$obj->dimension}}</td>
                                                <td class="align-middle">{{$obj->flower_amount}}</td>
                                                <td class="align-middle">{{$obj->price}}</td>

                                                <td class="align-middle" style="text-align:center;">
                                                  <!--  <a href="" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>-->
                                                    <button href="" class="btn btn-xs btn-danger btnDeleteSize" id="{{$obj->id}}" product data-toggle="modal" data-target="#deleteProductSizeModal"><i class="fa fa-trash"></i></button>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>


                            </div>
                        </div>
                    @elseif($tab==2)
                        <div id="productImageContainer">
                            <div class="col-sm-12">
                                <ol class="text-right">
                                    <a href="/admin/product-image-create/{{$product->id}}"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Add</button></a>
                                </ol>
                            </div>
                            <div class="col-sm-12">
                                <table width="100%"  class="table table-striped table-bordered table-hover" id="dataTablesOrder">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($productImage) &&count($productImage) > 0)
                                        @foreach($productImage as $obj)
                                            @if($obj->name != $product->image_name)
                                                <tr class="odd gradeX">
                                                    <td class="align-middle" width="73">
                                                        <img width="73" height="100" class="img-responsive" src="/storage/products/{{$obj->name}}">
                                                    </td>

                                                    <td class="align-middle" style="text-align:right;">
                                                        <button href="" class="btn btn-xs btn-danger btnDeleteImage" id="{{$obj->id}}" image-name="{{$obj->name}}" product data-toggle="modal" data-target="#deleteProductImageModal"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>


                            </div>
                        </div>
                    @endif

                </div>
            </div>



        </div>
    </div>

    <!-- Delete Product Size Modal Start-->
    <div id="deleteProductSizeModal" class="modal fade modal-approve-verification" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="modal-body">
                    <h4>Are you sure to delete ?</h4>
                    <form id="formDeleteSize" action="/admin/product-size-delete" method="POST" hidden>
                        @csrf
                        <input id="product_size_id" name="product_size_id" value="" hidden="true">
                        <input id="product_id" name="product_id" value="{{$product->id}}" hidden="true">
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="btnCancel" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="btnSubmitDeleteSize" type="button" class="btn btn-primary">Ok</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Delete Product Size  Modal Ends-->

    <!-- Delete Product Image Modal Start-->
    <div id="deleteProductImageModal" class="modal fade modal-approve-verification" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="modal-body">
                    <h4>Are you sure to delete ?</h4>
                    <form id="formDeleteImage" action="/admin/product-image-delete" method="POST" hidden>
                        @csrf
                        <input id="product_image_id" name="product_image_id" value="" hidden="true">
                        <input id="image_name" name="image_name" value="" hidden="true">
                        <input  name="product_id" value="{{$product->id}}" hidden="true">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="btnSubmitDeleteImage" type="button" class="btn btn-primary">Ok</button>
                </div>

            </div>
        </div>
    </div>
    <!-- DeleteUser Product Image Ends-->

    <form id="formActivateProduct" action="/admin/product-activate" method="post" hidden>
        @csrf
        <input type="text" name="product_id" value="{{$product->id}}" hidden>
    </form>
    <form id="formDeactivateProduct" action="/admin/product-deactivate" method="post" hidden>
        @csrf
        <input type="text" name="product_id" value="{{$product->id}}" hidden>
    </form>
@endsection
@section("script")

    <script>
        $(".btnDeleteSize").click(function(){
            var id = $(this).attr("id");
            $("#product_size_id").val(id);

        });

        $("#btnSubmitDeleteSize").click(function(){

            $("#formDeleteSize").submit();

        });
        $(".btnDeleteImage").click(function(){
            var id = $(this).attr("id");
            var imageName =  $(this).attr("image-name");
            $("#product_image_id").val(id);
            $("#image_name").val(imageName);

        });

        $("#btnSubmitDeleteImage").click(function(){
            $("#formDeleteImage").submit();
        });

        $("#btnActivateProduct").click(function(){
            $("#formActivateProduct").submit();
        });

        $("#btnDeactivateProduct").click(function(){
            $("#formDeactivateProduct").submit();
        });

    </script>

@endsection
