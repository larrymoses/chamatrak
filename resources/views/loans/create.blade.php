@extends('layouts.main')
@section('title', 'Chama Loan Application')
@section('content')
        <!-- BEGIN SAMPLE FORM PORTLET-->
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 ">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Loans Application Form</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form role="form" action="{{url('loans')}}" method="post">
                    <div class="form-body">
                        <div class="form-group">
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('member') ? ' has-error' : '' }}">
                            <label>Member Name</label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                {!! Form::select('member',[''=>'Select Member']+ $members,['id'=>'e1'], ['class' => 'form-control select2'],['required'],'' ) !!}
                            </div>
                            @if ($errors->has('member'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('member') }}</strong>
                                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label>Loan Disbursement Date*</label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                <input type="text" class="form-control"  name="date" value="{{ date("d-m-Y") }}"> </div>
                            @if ($errors->has('date'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('date') }}</strong>
                                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label>Loan Amount</label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-money"></i>
                                                    </span>
                                <input type="text" class="form-control"  name="amount" value="{{ old('amount') }}"> </div>
                            @if ($errors->has('amount'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('amount') }}</strong>
                                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('period') ? ' has-error' : '' }}">
                            <label>Loan Repayment Period (In Months)*</label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-times"></i>
                                                    </span>
                                <input type="text" class="form-control"  name="period" value="{{ old('period') }}"> </div>
                            @if ($errors->has('period'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('period') }}</strong>
                                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('grace_period') ? ' has-error' : '' }}">
                            <label>Loan Grace Period*</label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-times-circle"></i>
                                                    </span>
                                <input type="text" class="form-control"  name="grace_period" value="{{ old('grace_period') }}"> </div>
                            @if ($errors->has('grace_period'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('grace_period') }}</strong>
                                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('interest_type') ? ' has-error' : '' }}">
                            <label>Interest Type*</label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-times-circle-o"></i>
                                                    </span>
                                <select class="form-control" name="interest_type" value="{{ old('interest_type') }}">

                                    <option>Reducing Balance</option>
                                    <option>Chair Person</option>
                                    <option>Treasurer</option>
                                    <option>Secretary</option>
                                </select></div>
                            @if ($errors->has('interest_type'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('interest_type') }}</strong>
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