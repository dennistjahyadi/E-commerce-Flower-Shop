<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Online Shopping Surabaya Indonesia, Toko bunga online, toko bunga online terlengkap di Indonesia,
    Toko buket online, buket online, bunga kelulusan, jual buket instagram,jual bunga instagram, bunga termurah,
    bunga terlengkap, buket termurah, buket terlengkap" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Fleurelline | Flower Bouquet</title>

    <meta name="author" content="Shielyn Angela, Dennis Tjahyadi Gotama Tjan">

    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('sbadmin2/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset('sbadmin2/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="{{asset('sbadmin2/vendor/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">

    <link href="{{asset('sbadmin2/assets/css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{asset('sbadmin2/assets/css/flag-icon.min.css')}}" rel="stylesheet">
    <link href="{{asset('sbadmin2/assets/css/cs-skin-elastic.css')}}" rel="stylesheet">



    <!-- DataTables Responsive CSS -->
    <link href="{{asset('sbadmin2/vendor/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('sbadmin2/dist/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('sbadmin2/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>


<div id="wrapper">
    <!-- Navigation -->
    @include("admin.header.header")
    <div id="page-wrapper">
        @yield("content")
    </div>
    @include("admin.footer.footer")
    </nav>
</div>

<!-- jQuery -->
<script src="{{asset('sbadmin2/vendor/jquery/jquery.min.js')}}"></script>



<!-- Bootstrap Core JavaScript -->
<script src="{{asset('sbadmin2/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{asset('sbadmin2/vendor/metisMenu/metisMenu.min.js')}}"></script>

<!-- DataTables JavaScript -->
<script src="{{asset('sbadmin2/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('sbadmin2/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('sbadmin2/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{asset('sbadmin2/dist/js/sb-admin-2.js')}}"></script>


@yield("script")

</body>

</html>

