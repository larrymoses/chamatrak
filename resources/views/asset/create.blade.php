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
                                    <form role="form" action="{{url('asset')}}" method="post">
                                        <div class="form-body">
                                        <div class="form-group">
                                            @if (session('message'))
                                                <div class="alert alert-success">
                                                    {{ session('message') }}
                                                </div>
                                            @endif
                                        </div>
                                        {{ csrf_field() }}
                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label>Asset Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-th-list"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="Asset Name" name="name"> </div>
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
                                                <label>Asset Group</label>
                                                 <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                     {!! Form::select('category',[''=>'Select Category']+  $group, null, ['class' => 'form-control chosen-select'],['id'=>'e1'],['required'],'') !!}
                                                 </div>
                                                @if ($errors->has('group'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('group') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                           <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                                <label>Asset Amount</label>
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
                                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                                <label>Asset Description</label>
                                                    <textarea name="description" class="form-control" rows="3" placeholder="Amount"></textarea>
                                                @if ($errors->has('description'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('description') }}</strong>
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