@extends('layouts.app')

@section('content')
    <div id="breadcrumb" class="clearfix">
        <div class="container">
            <div class="breadcrumb clearfix">
                <ul class="ul-breadcrumb">
                    <li><a href="index.html" title="Home">Home</a></li>
                    <li><span>Login</span></li>
                </ul>
                <h2 class="bread-title">Page login</h2>
            </div>
        </div>
    </div><!-- end breadcrumb -->

    <div id="columns" class="columns-container">
        <!-- container -->
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <form action="#" id="create-account-form" class="form-horizontal box panel panel-default" >
                        <h3 class="panel-heading">Create an account</h3>
                        <div class="form_content panel-body clearfix">
                            <p>Registration is quick and easy. It allows you to be able to order from our shop. To start shopping click register.</p>
                            <a href="../register" class="btn button btn-default" title="Create an account" rel="nofollow"><i class="fa fa-user left"></i> Create an account</a>
                        </div>
                    </form><!--end form -->
                </div>
                <div class="col-lg-6">
                    <form id="form-login" class="form-horizontal box panel panel-default" method="POST" action="{{ route('login') }}">
                        <h3 class="panel-heading">Already registered?</h3>
                        <div class="form_content panel-body clearfix">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form><!--end form -->
                </div>
            </div>
        </div> <!-- end container -->
    </div><!--end columns -->
@endsection
