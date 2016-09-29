@extends('layouts.auth')
@section('content')
        <!-- BEGIN LOGIN FORM -->
<form class="form-horizontal" method="POST" action="{{ url('/login') }}">
    <h3 class="form-title font-green">Sign In</h3>
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">E-Mail Address</label>
        <input id="email" type="email" class="form-control form-control-solid placeholder-no-fix" name="email" value="{{ old('email') }}" placeholder="E-Mail Address">

        @if ($errors->has('email'))
            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input id="password" type="password" class="form-control form-control-solid placeholder-no-fix" name="password" value="{{ old('password') }}" placeholder="Password">

        @if ($errors->has('password'))
            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
        @endif
    </div>
    <div class="form-actions">
        <button type="submit" class="btn green uppercase">Login</button>
        <label class="rememberme check">
            <input type="checkbox" name="remember" value="1" />Remember </label>
        <a href="{{ url('/password/reset') }}" id="forget-password" class="forget-password">Forgot Password?</a>
    </div>
</form>
<!-- END LOGIN FORM -->
@endsection
