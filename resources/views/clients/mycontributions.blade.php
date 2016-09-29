@extends('layouts.main')
@section('title', 'Members Contributions')
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="portlet light ">
                <div class="portlet-title">
                    <a href="{{url('contributions/create')}}" class="btn btn-circle btn-outline red">
                        <i class="fa fa-plus"></i>&nbsp;
                        <span class="hidden-sm hidden-xs">New&nbsp;</span>&nbsp;
                        <i class="fa fa-angle-down"></i>
                    </a>

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
                                <th>Member No</th>
                                <th>Member Name</th>
                                <th>Deposit Date</th>
                                <th>Amount</th>
                                <th>Balance</th>
                                <th>Balance</th>
                                <th>Created On</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Edit Company Modal Windows--}}
    <div class="modal fade bs-example-modal-edit" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <a href="#" aria-hidden="true" data-dismiss="modal" class="btnClose pull-right">x</a>
                    <h4 class="modal-title">Edit Member Contribution</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <form role="form" id="frmEdit" method="post">
                            <div class="form-body">
                                <div class="form-group">
                                    @if (session('message'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="alert" id="editNotification" style="display: none;">
                                    <ul id="ul" class="ul">    </ul>
                                </div>
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('member') ? ' has-error' : '' }}">
                                    <label>Member</label>
                                    <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                        {{--{!! Form::select('member',[''=>'Select Member']+  $member, null,['id' => 'editMember', 'class' => 'form-control chosen-select'],['required'],'') !!}--}}
                                    </div>
                                    @if ($errors->has('member'))
                                        <span class="help-block">
                                                        <strong>{{ $errors->first('member') }}</strong>
                                                    </span>
                                    @endif
                                </div>
                                <input type="hidden" id="endityID" name="id">
                                <div class="form-group">
                                    <label>Payment Mode</label>
                                    <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-users"></i>
                                                    </span>
                                        <select class="form-control" name="mode" id="editMode">

                                            <option>Cash</option>
                                            <option>MPESA</option>
                                            <option>Fund Transfer</option>
                                        </select></div>

                                </div>
                                <div class="form-group">
                                    <label>Month Contributing For </label>
                                    <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                        <input type="text" class="form-control"  name="month" id="editMonth"> </div>

                                </div>
                                <div class="form-group">
                                    <label>Amount Paid</label>
                                    <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-money"></i>
                                                    </span>
                                        <input type="number" class="form-control" placeholder="Amount" name="amount" id="editAmount"> </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-actions">
                        <button type="button" id="btnSaveEdit" class="btn btn-success">Save changes</button>
                        <button type="button" id="closeEdit" class="btn btn-danger btnClose" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End of Edit Company Modal Window--}}
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
                "sAjaxSource": "<?php echo url('getMyContributions') ?>",
                "aoColumns": [
                    {mData: 'member_no'},
                    {mData: 'name'},
                    {mData: 'month'},
                    {mData: 'total'},
                    {mData: 'balance', "sClass": "center"},
                    { mRender: function(data, type, row){
                        return row.max - row.amount;
                    }
                    },
                    {mData: 'created_at'},
                    {mData: 'actions'}
                ]
            });
            $(document).on("click", ".edit", function () {
                var notification = $("#editNotification");
                var frm = $("#frmEdit");
                var btnSaveEdit = $("#btnSaveEdit");
                var id = $(this).data('id');
                var month = $(this).data('month');
                var mode = $(this).data('mode');
                var amount = $(this).data('amount');
                var member = $(this).data('member');
                $.ajax({
                    type: "GET",
                    url: "/getmembercont/"+id,
                    data: {id: id},
                    success: function (data, status) {
                        switch (status) {
                            case "success":

                                var res = jQuery.parseJSON(data);
                                document.getElementById("endityID").value = res.id;
                                document.getElementById("editMember").value = res.member;
                                document.getElementById("editAmount").value = res.amount;
                                document.getElementById("editMonth").value = res.month;
                                document.getElementById("editMode").value = res.mode;
                                $('#editModal').modal('show');
//                                console(data);
                                break;

                            case "failed":
                                notification.html('<div class="alert alert-danger">' + data.message + ' </div>');
                                notification.show();
                                frm.hide();
                                break;
                            default :
                                alert("do nothing");
                        }
                    }

                });
            });
            $("#btnSaveEdit").click(function () {
                var editNotification = $("#editNotification");
                editNotification.hide();
                var frm = $("#frmEdit");
                var mode = $("#editMode").val();
                var month = $("#editMonth").val();
                var member = $("#editMember").val();
                var amount = $("#editAmount").val();
                var data = frm.serialize();
                var id = $("#endityID").val();
                $.ajax({
                    method: "POST",
                    url: "contributions/"+id,
                    data: data,
                    success: function (data, status) {
                        switch (status) {
                            case "success":
                                if (data.status === '00') {
                                    frm.hide();
                                    editNotification.html('<div class="alert alert-success" >' + 'Data Updated Successfully '+'</div>');
                                    editNotification.show();
                                    $("#btnSaveEdit").hide();
                                } else if (data.status === '01') {
                                    editNotification.hide().find('#ul').empty();
                                    $.each(data.errors,function(index,error){
                                        editNotification.html('<div class="alert alert-danger">'+'<li>'+data.error+'</li>' +'</div>');
                                    })
                                    createNotification.show();
                                }
                                break;
                            case "failed":
                                editNotification.html('<div class="alert alert-danger">' + 'Data Updated Successfully' + ' </div>');
                                editNotification.show();
                                frm.hide();
                                break;
                            default :
                                alert("do nothing");
                        }
                    }
                });
            });
        });
        $("#newClose").click(function (){
            pageReload();
        });
        $(".btnClose").click(function (){
            pageReload();
        });

        function pageReload(){
            document.location.reload();
        }
    </script>


@endsection@extends('layouts.main')
