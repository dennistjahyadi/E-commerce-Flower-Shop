@extends("admin.layouts.app")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Products</h1>

        </div>
        <div class="col-sm-12">
            <ol class="text-right">
                <a href="/admin/product-create"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Create</button></a>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <table width="100%"  class="table table-striped table-bordered table-hover" id="dataTablesOrder">
                <thead>
                <tr>
                    <!-- <th>Image</th> -->
                    <th>Name</th>
                    <th>New</th>
                    <th>Active</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(isset($products) &&count($products) > 0)
                    @foreach($products as $product)
                        <tr class="odd gradeX">
                        <!--  <td class="align-middle" width="73">
                                <img width="73" height="100" class="img-responsive" src="/storage/products/{{$product->image_name}}">
                            </td> -->

                            <td class="align-middle">{{$product->name}}</td>
                            <td class="align-middle">
                                @if($product->new==1)
                                    <span class="label label-success">yes</span>

                                @else
                                    <span class="label label-danger">no</span>

                                @endif

                            </td>

                            <td class="align-middle">
                                @if($product->active==1)
                                    <span class="label label-success">active</span>

                                @else
                                    <span class="label label-danger">inactive</span>
                                @endif
                            </td>

                            <td class="align-middle" style="text-align:center;" width="150">
                                @if($product->new==1)
                                    <button href="" class="btn btn-xs btn-primary btnSetOld" id="{{$product->id}}">old</button>
                                @else
                                    <button href="" class="btn btn-xs btn-primary btnSetNew" id="{{$product->id}}">new</button>
                                @endif
                                <a href="/admin/product-details/{{$product->id}}/1" class="btn btn-xs btn-default"><i class="fa fa-eye"></i></a>
                                <a href="/admin/product-update/{{$product->id}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                <button href="" class="btn btn-xs btn-danger btnDelete" id="{{$product->id}}" data-toggle="modal" data-target="#deleteProductModal"><i class="fa fa-trash"></i></button>

                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            <!-- /.table-responsive -->

        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- Delete Product Modal Start-->
    <div id="deleteProductModal" class="modal fade modal-approve-verification" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="modal-body">
                    <h4>Are you sure to delete ?</h4>
                    <form id="formDelete" action="/admin/product-delete" method="POST" hidden>
                        @csrf
                        <input id="product_id_delete" name="product_id" value="" hidden="true">
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="btnCancel" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="btnSubmitDelete" type="button" class="btn btn-primary">Ok</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Delete Product  Modal Ends-->

    <form id="formNewOld" action="/admin/product-setnewold" method="POST" hidden>
        @csrf
        <input id="product_id_setnewold" name="product_id" value="" hidden="true">
        <input id="new" name="new" value="" hidden="true">
    </form>
@section("script")
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#dataTablesOrder').DataTable({
                responsive: true,
                order: false
            });
        });
        $(".btnDelete").click(function(){
            var id = $(this).attr("id");
            $("#product_id_delete").val(id);

        });

        $("#btnSubmitDelete").click(function(){

            $("#formDelete").submit();

        });
        $(".btnSetOld").click(function(){
            var id = $(this).attr("id");
            $("#product_id_setnewold").val(id);
            $("#new").val(0);
            $("#formNewOld").submit();

        });
        $(".btnSetNew").click(function(){
            var id = $(this).attr("id");
            $("#product_id_setnewold").val(id);
            $("#new").val(1);
            $("#formNewOld").submit();

        });
    </script>
@endsection
@endsection
