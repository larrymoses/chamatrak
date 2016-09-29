@extends('layouts.main')
@section('title', 'Chama Members')
@section('content')
        <!-- BEGIN SAMPLE FORM PORTLET-->
<div class="row">
    <div class="col-md-3 "></div>
    <div class="col-md-6 ">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="fa fa-plus font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Create New</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form role="form" action="{{url('members')}}" method="post">
                    <div class="form-body">
                        <div class="form-group">
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Member Number <i>(System Gen)</i></label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-th-list"></i>
                                                    </span>
                                <input type="text" class="form-control"  value="MBR{{$max+1}}" disabled> </div>
                        </div>
                        <input type="hidden" name="member_no" value="MBR{{$max+1}}">
                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label>First Name</label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                <input type="text" class="form-control" placeholder="First Name" name="firstname" value="{{ old('firstname') }}"> </div>
                            @if ($errors->has('firstname'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('firstname') }}</strong>
                                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label>Last Name</label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                <input type="text" class="form-control" placeholder="Last Name" name="lastname" value="{{ old('lastname') }}"> </div>
                            @if ($errors->has('lastname'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('lastname') }}</strong>
                                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>Email Address</label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </span>
                                <input type="text" class="form-control" placeholder="Email Address" name="email" value="{{ old('email') }}"> </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label>Phone Number</label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-phone"></i>
                                                    </span>
                                <input type="text" class="form-control" placeholder="Phone Number" name="phone" value="{{ old('phone') }}"> </div>
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label>User Role</label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-users"></i>
                                                    </span>
                                <select class="form-control" name="role" value="{{ old('role') }}">

                                    <option>Member</option>
                                    <option>Chair Person</option>
                                    <option>Treasurer</option>
                                    <option>Secretary</option>
                                </select></div>
                            @if ($errors->has('role'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('role') }}</strong>
                                                    </span>
                            @endif
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn blue">Submit</button>
                            <button type="button" class="btn default">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
@endsection