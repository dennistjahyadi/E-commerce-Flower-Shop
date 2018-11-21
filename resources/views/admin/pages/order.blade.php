@extends("admin.layouts.app")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Orders</h1>

        </div>
        <div class="col-sm-12">
            <ol class="text-right">
                <!-- <a href="#"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Create</button></a> -->
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
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Transfer From</th>
                    <th>Transfered to</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(isset($userOrders) &&count($userOrders) > 0)
                    @foreach($userOrders as $userOrder)
                        <tr class="odd gradeX">
                            <td class="align-middle">{{$userOrder->id}}</td>
                            <td class="align-middle">{{$userOrder->fullname}}</td>
                            <td class="align-middle">
                                @if($userOrder->customer_bank_account_number != "")
                                    {{"(".$userOrder->customer_bank_account_number.") ".$userOrder->customer_bank_account_name}}
                                @endif
                            </td>
                            <td class="align-middle">{{$userOrder->transfered_to}}</td>
                            <td class="align-middle" style="text-align: center;">
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
                            </td>
                            <td class="align-middle" style="text-align:center;">
                                <a href="/admin/order-details/{{$userOrder->id}}" class="btn btn-xs btn-default"><i class="fa fa-eye"></i></a>
                               <!-- <a href="" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>-->
                               <!-- <a href="" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>-->

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
@section("script")
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#dataTablesOrder').DataTable({
                responsive: true
            });
        });
    </script>
@endsection
@endsection
