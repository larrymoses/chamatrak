@extends('layouts.main')
@section('title', 'Chama Members')
@section('content')
        <!-- BEGIN SAMPLE FORM PORTLET-->
<div class="row">
    <div class="col-md-12 ">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="fa fa-plus font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Member Contribution Form</span>
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
                        <input type="hidden" name="member" value="{{$member}}">
                        <div class="form-group{{ $errors->has('mode') ? ' has-error' : '' }}">
                            <label>Payment Mode</label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-users"></i>
                                                    </span>
                                <select id="leave" onchange="leaveChange()" class="form-control" name="mode">

                                    <option>Cash</option>
                                    <option>MPESA</option>
                                    <option>PESAPAL</option>
                                    <option>Fund Transfer</option>
                                </select></div>
                            @if ($errors->has('mode'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('mode') }}</strong>
                                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('month') ? ' has-error' : '' }}">
                            <label>Month Contributing For </label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                <input type="text" class="form-control" value="{{date('F')}}" name="month"> </div>
                            @if ($errors->has('month'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('month') }}</strong>
                                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label>Amount Paid</label>
                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-money"></i>
                                                    </span>
                                <input type="number" class="form-control" placeholder="Amount" name="amount" value="3000"> </div>
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
    <script type='text/javascript' charset="utf-8">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function leaveChange() {
                if (document.getElementById("leave").value == "PESAPAL"){
                    alert('Pesa Pal');
//                    document.getElementById("message").innerHTML = "Common message";
                }
                else{
                    alert('Other');
//                    document.getElementById("message").innerHTML = "Having a Baby!!";
                }
            }
        });
    </script>
</div>

@endsection