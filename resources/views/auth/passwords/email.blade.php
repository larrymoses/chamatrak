@extends('layouts.auth')

<!-- Main Content -->
@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
        {{ csrf_field() }}
        <h3 class="form-title font-green">Reset Password</h3>
        <div class="form-group">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
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
        <div class="form-group">
            <div class="col-md-2 col-md-offset-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                </button>
            </div>
        </div>
    </form>
@endsection
