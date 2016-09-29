@extends('layouts.main')
@section('title', 'Chama Members')
@section('content')
        <!-- BEGIN SAMPLE FORM PORTLET-->
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 ">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Default Form</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form role="form" action="{{ URL::to('importExcel') }}" method="post" enctype="multipart/form-data">
                        <div class="form-body">
                            <div class="form-group">
                                @if (session('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                            </div>
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('csv') ? ' has-error' : '' }}">
                                <label>Select CSV</label>

                                    <input type="file" name="csv" accept=".csv">
                                @if ($errors->has('csv'))
                                    <span class="help-block">
                                                            <strong>{{ $errors->first('csv') }}</strong>
                                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-actions">
                            <a href="{{ URL::to('downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
                            <a href="{{ URL::to('downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
                            <button type="submit" class="btn blue">Submit</button>
                            <button type="reset" class="btn default">Cancel</button>
                        </div>
                    </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
@endsection