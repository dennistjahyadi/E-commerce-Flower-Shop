@extends('layouts.app')

@section('content')
    <div id="breadcrumb" class="clearfix">
        <div class="container">
            <div class="breadcrumb clearfix">
                <ul class="ul-breadcrumb">
                    <li><a href="/" title="Home">Home</a></li>
                    <li><span>my account</span></li>
                </ul>
                <h2 class="bread-title">My Account</h2>
            </div>
        </div>
    </div><!-- end breadcrumb -->

    <div id="columns" class="columns-container">
        <!-- container -->
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="acc-menu">
                        <h4>Hi, a</h4>
                        <hr>
                        <ul class="nav">
                            <li><a href="#">ACCOUNT</a></li>
                            <li><a href="#">ORDERS</a></li>
                            <li><a href="#">ADDRESSES</a></li>
                            <li><a href="/logout">SIGN OUT</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-9 col-sm-offset-1 acc-content">
                    <h4>Order History</h4>
                    <div class="table-order">
                        no order yet.					</div>
                </div>
            </div>
        </div> <!-- end container -->
    </div><!--end columns -->
@endsection

