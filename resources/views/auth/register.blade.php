@extends('layouts.auth')
@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
        {{ csrf_field() }}
        <h3 class="form-title font-green">Register New Company</h3>
        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">User Name</label>


            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="User Name">

            @if ($errors->has('username'))
                <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
            @endif

        </div>
        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">First Name</label>
            <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="First Name">
            @if ($errors->has('firstname'))
                <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Last Name</label>
            <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="Last Name">
            @if ($errors->has('lastname'))
                <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">E-Mail Address</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address">
            @if ($errors->has('email'))
                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Phone Numbe</label>
            <input id="phone" type="tel" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="Phone Numbe">
            @if ($errors->has('phone'))
                <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Company</label>
            <input id="company" type="text" class="form-control" name="company" value="{{ old('company') }}" placeholder="Chama or Sacco Name">
            @if ($errors->has('company'))
                <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input id="password" type="password" class="form-control" name="password" placeholder="Password">
            @if ($errors->has('password'))
                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
            @endif
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-user"></i> Register
                </button>
            </div>
        </div>
    </form>
@endsection
