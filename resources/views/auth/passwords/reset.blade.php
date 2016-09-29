@extends('layouts.auth')
@section('content')
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                    <h3 class="form-title font-green">Reset Password</h3>
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label visible-ie8 visible-ie9">E-Mail Address</label>        
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
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
                                    <i class="fa fa-btn fa-refresh"></i> Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
              
@endsection
