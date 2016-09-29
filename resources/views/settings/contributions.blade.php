@extends('layouts.main')
@section('title', 'Settings')
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="portlet light ">
                <div class="portlet-title">

                    <a class="btn green btn-outline sbold uppercase" id="create" href="#" data-toggle="modal" data-target="#createModal" data-backdrop="static" data-keyboard="false">
                        <i class="fa fa-plus "></i> Create New</a>

                </div>
                <div class="portlet-body form">
                    <div class="form-group">
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <table id="usersActive" class="display table table-striped table-bordered responsive dataTable no-footer dtr-inline" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Contribution Name</th>
                                <th>Contribution Amount</th>
                                <th>Contribution Type</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="modalTitleLabel">Add New Contribution Category</h4>
                </div>
                <div class="modal-body">

                    <div id="createNotification"></div>
                    <!-- Create form-->
                    <form role="form" id="frmCreate">
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
                                <label>Contribution Name</label>
                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-bank"></i>
                                                    </span>
                                    <input type="text" class="form-control" placeholder="Contribution Name" name="name" value="{{ old('name') }}"> </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                <label>Contribution Amount</label>
                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-money"></i>
                                                    </span>
                                    <input type="text" class="form-control" placeholder="Contribution Amount" name="amount" value="{{ old('amount') }}"> </div>
                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                                        <strong>{{ $errors->first('amount') }}</strong>
                                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label>Contribution Type*</label>
                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-phone"></i>
                                                    </span>
                                    <select name="type" class="form-control">
                                        <option>Regular</option>
                                        <option>One Time</option>
                                        <option>Non Mandatory</option>
                                    </select>
                                </div>
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                                        <strong>{{ $errors->first('type') }}</strong>
                                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="btnCreate" class="btn btn-primary">Save</button>
                    <button type="button" id="newClose" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    @endsection
    @section('pagelevel')
            <!-- <script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script> -->
    <script type="text/javascript" src="{{asset('assets/js/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/datatables/media/assets/js/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/datatables/extras/TableTools/media/js/TableTools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/datatables/extras/TableTools/media/js/ZeroClipboard.min.js')}}"></script>
    <script type='text/javascript' charset="utf-8">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            oTable = $('#usersActive').DataTable({
                responsive: true,
                stateSave: true,
                "sAjaxSource": "<?php echo url('getContributionSettings') ?>",
                "aoColumns": [
                    {mData: 'name'},
                    {mData: 'amount'},
                    {mData: 'type'},
                    {mData: 'actions'}
                ]
            });
            $("#btnCreate").click(function () {
                var notification = $("#createNotification");
                notification.hide();
                var frm = $('#frmCreate');
                var data = frm.serialize();
                $.ajax({
                    method: "POST",
                    url: "post_set_contribution",
                    data: data,
                    success: function(data){
                        frm.hide();
                        notification.html('<div class="alert alert-success" Data added successful </div>');
                    },
                    error: function(data){
                        // Error...
                        var errors = data.responseJSON;

                        console.log(errors);

                        $.each(errors, function(index, value) {
                            notification.show();
                            notification.html('<div class="alert alert-danger">'+'<li>'+value+'</li>' +'</div>');
                        });
                    }
                });
            });

        });

    </script>
@endsection