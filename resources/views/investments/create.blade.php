@extends('layouts.main')
@section('title', 'Chama Members')
@section('content')
        <!-- BEGIN SAMPLE FORM PORTLET-->
<div class="row">
    <div class="col-md-12 ">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Default Form</span>
                </div>
                <div class="actions">
                    <div class="btn-group">
                        <a class="btn btn-sm green dropdown-toggle" href="javascript:;" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-pencil"></i> Edit </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-trash-o"></i> Delete </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-ban"></i> Ban </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;"> Make admin </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="portlet-body form">
                <form role="form" action="{{url('contributions')}}" method="post">
                    <div class="form-body">
                        <div class="form-group">
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>
                        {{ csrf_field() }}

                        {{--<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">--}}
                        {{--<label>Deposite Date</label>--}}
                        {{--<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">--}}
                        {{--<span class="input-group-addon">--}}
                        {{--<i class="fa fa-calendar"></i>--}}
                        {{--</span>--}}
                        {{--<input type="text" class="form-control " placeholder="Select Date" name="date"> </div>--}}

                        {{--@if ($errors->has('date'))--}}
                        {{--<span class="help-block">--}}
                        {{--<strong>{{ $errors->first('date') }}</strong>--}}
                        {{--</span>--}}
                        {{--@endif--}}
                        {{--</div>--}}
                        <div class="form-group{{ $errors->has('member') ? ' has-error' : '' }}">
                            <label>Member</label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                {!! Form::select('member',[''=>'Select Member']+  $member, null, ['class' => 'form-control chosen-select'],['id'=>'e1'],['required'],'') !!}
                            </div>
                            @if ($errors->has('member'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('member') }}</strong>
                                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('mode') ? ' has-error' : '' }}">
                            <label>Payment Mode</label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-users"></i>
                                                    </span>
                                <select class="form-control" name="mode">

                                    <option>Cash</option>
                                    <option>MPESA</option>
                                    <option>Fund Transfer</option>
                                </select></div>
                            @if ($errors->has('mode'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('mode') }}</strong>
                                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label>Amount Paid</label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-money"></i>
                                                    </span>
                                <input type="number" class="form-control" placeholder="Amount" name="amount"> </div>
                            @if ($errors->has('amount'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('amount') }}</strong>
                                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn blue">Submit</button>
                        <button type="button" class="btn default">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
@endsection