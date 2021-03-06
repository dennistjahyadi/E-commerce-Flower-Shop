@extends('layouts.app')

@section('content')
<div id="breadcrumb" class="clearfix">
    <div class="container">
        <div class="breadcrumb clearfix">
            <ul class="ul-breadcrumb">
                <li><a href="/" title="Home">Home</a></li>
                <li><span>Contact us</span></li>
            </ul>
            <h2 class="bread-title">Contact us</h2>
        </div>
    </div>
</div><!-- end breadcrumb -->

<div id="columns" class="columns-container">
    <div class="container">
        <div class="contact-us">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <h2 class="title_block">Contact info</h2>
                    <div class="contact-box">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut semper metus. Nullam a elit faucibus, tempor ex at, placerat ligula. Maecenas varius ex mi, elementum porttitor mauris gravida sit amet.<p>
                        <ul>
                            <li><i class="zmdi zmdi-pin"></i><span>123 canberra Street, New York, USA</span></li>
                            <li><i class="zmdi zmdi-phone"></i><span>+844 123 456 78 / +844 123 456 79</span></li>
                            <li><i class="zmdi zmdi-email"></i><a href="#" title="">contact@byhands.org</a></li>
                        </ul>
                    </div><!-- contact-box-->
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="contact-form clearfix">
                        <h2 class="title_block">Send us a message</h2>
                        <form method="post" action="http://tivatheme.com/html/byhands/php/contact.php" id="cform" autocomplete="on">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="name" name="name" placeholder="Name*"/>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" id="email" name="email" placeholder="Email*"/>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" id="subject" name="subject" placeholder="Subject*"/>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea id="message" name="message" placeholder="Enter your message*"></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" class="btn button btn-primary">Send message</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- end contac-form -->
                </div>
            </div>
            <div id="contact-map" class="clearfix">
                <div id="map"></div><!-- end map -->
                <div class="hidden-lg hidden-md hidden-sm hidden-xs contact-address">815 Sunset Boulevard Ca 70079</div>
            </div><!-- end contact-map -->
        </div><!-- end contact-us -->
    </div><!-- end container -->
</div><!--end columns-->
@endsection
