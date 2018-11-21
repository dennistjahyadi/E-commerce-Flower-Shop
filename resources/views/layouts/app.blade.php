<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <!--<![endif]-->
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>byHands Responsive HTML Template</title>

    <meta name="keywords" content="Responsive HTML Template">
    <meta name="description" content="Scara Responsive HTML Template">
    <meta name="author" content="tivatheme">

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <!-- Mobile Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700' rel='stylesheet' type='text/css'>

    <!-- css/vendor CSS -->
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap-theme.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/font-material/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/owl.carousel/assets/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/magnific-popup/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('vendor/nivo-slider/css/nivo-slider.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/nivo-slider/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/nivo-slider/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('vendor/slider-range/css/jslider.css')}}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('css/theme-global.css')}}">
    <link rel="stylesheet" href="{{asset('css/theme-animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/theme-product.css')}}">
    <link rel="stylesheet" href="{{asset('css/theme-product-list.css')}}">
    <link rel="stylesheet" href="{{asset('css/theme-blog.css')}}">
    <link rel="stylesheet" href="{{asset('css/theme-responsive.css')}}">

    <!-- Template Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <style>
        #top-header {
            position: fixed;
            top: 0;
            width: 100%;
            transition: top 0.5s;
            z-index:10;
        }
    </style>
</head>
<body class="index home-2">
<div id="all">
    @include("header.header");
    <div id="main-content">
    @yield("content");
    </div>
    @include("footer.footer");
</div> <!-- end all -->



<!-- css/vendor JS -->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/owl.carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('vendor/magnific-popup/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>

<script src="{{asset('vendor/nivo-slider/js/jquery.nivo.slider.js')}}"></script>

<script src="{{asset('vendor/slider-range/js/tmpl.js')}}"></script>
<script src="{{asset('vendor/slider-range/js/jquery.dependClass-0.1.js')}}"></script>
<script src="{{asset('vendor/slider-range/js/draggable-0.1.js')}}"></script>
<script src="{{asset('vendor/slider-range/js/jquery.slider.js')}}"></script>


<script src="{{asset('vendor/jquery.elevatezoom/jquery.elevatezoom.js')}}"></script>


<!-- Template Base, Components and Settings -->
<script src="{{asset('js/theme.js')}}"></script>

<!-- Template Custom -->
<script src="{{asset('js/custom.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // set padding main-content depends from top-header height
    document.getElementById("main-content").setAttribute("style","padding-top: "+(document.getElementById('top-header').scrollHeight)+"px");

    // scroll
    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (120 > currentScrollPos) {
            document.getElementById("top-header").style.top = "0";
        } else {
            document.getElementById("top-header").style.top = ((document.getElementById('header-topbar').scrollHeight+2)*-1)+"px"
        }
    }

    //fetch item cart
    fetchItemCart();
    function fetchItemCart(){

        $.ajax({
            url: "/fetch-item-cart",
            type: "post",
            success: function (response) {
                var products = response;
                var quantity = 0;
                var productString = "";
                for (i=0;i<products.length;i++){
                    quantity += Number(products[i]["quantity"]);
                    productString += " <tr>" +
                        "<td class=\"product-thumbnail\">" +
                        "<a href=\"page-detail.html\">" +
                        "<img width=\"80\" height=\"107\" alt=\"\" class=\"img-responsive\" src=\"/storage/products/"+products[i]["image_name"]+"\">" +
                        "</a>" +
                        "</td>" +
                        "<td class=\"product-name\">" +
                        "<a href=\"page-detail.html\">"+products[i]["product_name"]+"</a>" +
                        "<br><span class=\"amount\">"+products[i]["size_name"]+" x "+products[i]["quantity"]+"</span>" +
                        "<br><span class=\"amount\"><strong>Rp "+(Number(products[i]["price"])).toLocaleString()+"</strong></span>" +
                        "</td>" +
                        "<td class=\"product-actions\">" +
                        "<a title=\"Remove this item\" product-id=\""+products[i]["product_id"]+"\" size-id=\""+products[i]["size_id"]+"\" class=\"remove-cart-item\">" +
                        "<i class=\"fa fa-times\"></i>" +
                        "</a>" +
                        "</td>" +
                        "</tr>";

                }
                $("#cart-container").html(productString);
                $(".ajax_cart_quantity").html(quantity);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }


        });


    }


    // remove item in cart
    $('#cart-container').on('click', '.remove-cart-item', function(){
        var context = $(this);
        var productId = $(this).attr("product-id");
        var sizeId = $(this).attr("size-id");
        var quantity = Number($(this).attr("quantity"));
        var data = {product_id:productId,size_id:sizeId};
        $.ajax({
            url: "/remove-item-cart",
            type: "post",
            data:  data,
            success: function (response) {
                // you will get response from your php page (what you echo or print)
                //   var products = response;
                context.parent().parent().remove();
                var products = response;
                var quantity = 0;

                for (i=0;i<products.length;i++) {
                    quantity += Number(products[i]["quantity"]);
                }
                $(".ajax_cart_quantity").html(quantity);


            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }


        });
    });

    $(".checkoutBtn").click(function(){

        $.ajax({
            url: "/fetch-item-cart",
            type: "post",
            success: function (response) {
                var products = response;
                if (products.length>0){
                    window.location = "/checkout";
                }
                $("#cart-container").html(productString);
                $(".ajax_cart_quantity").html(quantity);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }


        });
    });


</script>

@yield("script");


</body>

<!-- Mirrored from tivatheme.com/html/byhands/page-home-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 May 2018 08:37:56 GMT -->
</html>
