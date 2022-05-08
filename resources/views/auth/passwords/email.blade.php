@extends('layouts.auth')

@section('contenido')
<body class="hold-transition login-page">
    <div class="login-box">
    <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/login" class="h1"><b>Secodisa</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">{{ __('Reset Password') }}</p>

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                 @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="{{ __('Email Address') }}" autocomplete="email" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Send Password Reset Link') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <br>
                <p class="mb-1">
                    <a class="btn btn-default" href="{{ route('login') }}">
                        {{ __('Login') }}
                    </a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
<!-- /.login-box -->
@endsection