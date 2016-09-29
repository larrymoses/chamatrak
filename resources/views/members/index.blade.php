@extends('layouts.main')
@section('title', 'Chama Members')
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="portlet light ">
                <div class="portlet-title">
                    <a href="{{url('members/create')}}" class="btn btn-circle btn-outline red">
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
                        <div class="tabbable tabbable-tabdrop">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab1" data-toggle="tab">Active Members</a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle="tab">Blocked Groups</a>
                                </li>
                                <li>
                                    <a href="#tab3" data-toggle="tab">Pending Deletion</a>
                                </li>


                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <p> I'm in Section 1. </p>
                                    <table id="usersActive" class="display table table-striped table-bordered responsive dataTable no-footer dtr-inline" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Member Number</th>
                                            <th>Users Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Created On</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <p> Howdy, I'm in Section 3. </p>
                                    <table id="BlockedActive" class="display table table-striped table-bordered responsive dataTable no-footer dtr-inline" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Member Number</th>
                                            <th>Users Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
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
            </div>
        </div>
    </div>
    {{--Edit Company Modal Windows--}}
    <div class="modal fade bs-example-modal-edit" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                    <h4 class="modal-title">Edit User Details</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <div class="alert alert-danger" id="editNotification" style="display: none;">
                            <ul id="ul" class="editNotification">    </ul>
                        </div>
                        <form class="form-horizontal" id="frmEdit">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-md-3 control-label">First Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control input" id="editFirstname" placeholder="First Name" name="first_name">
                                </div>
                            </div>
                            <input type="hidden" id="enditUserID" name="id">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Last Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control input" id="editLastname" placeholder="Last Name" name="lastname">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">User Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control input" id="editUsername" placeholder="User Name" name="username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Phone</label>
                                <div class="col-md-9">
                                    <input type="tel" class="form-control input" id="editPhone" placeholder="Phone number" name="phone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control input" id="editEmail" placeholder="example@domain.com" name="email">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSaveEdit" class="btn btn-success">Save changes</button>
                    <button type="button" id="closeEdit" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{--End of Edit Company Modal Window--}}
    {{--Group Deactivate Windows--}}
    <div class="modal fade bs-example-modal-deactivate" id="" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                    <h4 class="modal-title">Deactivate Member</h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-success">
                        <div class="panel-body">
                            <div class="alert" id="deactivateNotification" style="display: none;">
                                <ul id="ul" class="ul">    </ul>
                            </div>

                            <form id="frmDeactivate" class="form-horizontal form-bordered">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="deactivateID" />
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <p> Are you sure you want to deactivate <code><span id="memberName"></span></code> from chama?</p>
                                        <input type="hidden" id="deactivateId">
                                    </div>
                                </div><!-- panel -->
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"  id="btnDeactivate" class="btn btn-danger">Deactivate</button>
                    <a  type="button"  class="btn btn-default btnClose" >Close</a>
                </div>
            </div>
        </div>
    </div>
    {{--End of Group Deactivate Modal Window--}}
    <div class="modal fade bs-example-modal-activate" id="" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                    <h4 class="modal-title">Re Activate Member</h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-success">
                        <div class="panel-body">
                            <div class="alert" id="activateNotification" style="display: none;">
                                <ul id="ul" class="ul">    </ul>
                            </div>

                            <form id="frmActivate" class="form-horizontal form-bordered">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="activateID" />
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <p> Are you sure you want to Re Activate <code><span id="membersName"></span></code> to chama?</p>
                                        <input type="hidden" id="activateId">
                                    </div>
                                </div><!-- panel -->
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"  id="btnActivate" class="btn btn-success">Reactivate</button>
                    <a  type="button"  class="btn btn-default btnClose" >Close</a>
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
                "sAjaxSource": "<?php echo url('/members/getall/0') ?>",
                "aoColumns": [
                    {mData: 'member_no'},
                    {mData: 'name'},
                    {mData: 'email'},
                    {mData: 'phone'},
                    {mData: 'created_at'},
                    {mData: 'actions'}
                ]
            });
            oTable = $('#BlockedActive').DataTable({
                responsive: true,
                stateSave: true,
                "sAjaxSource": "<?php echo url('/members/getall/1') ?>",
                "aoColumns": [
                    {mData: 'member_no'},
                    {mData: 'name'},
                    {mData: 'email'},
                    {mData: 'phone'},
                    {mData: 'created_at'},
                    {mData: 'actions'}
                ]
            });
        });
      //  function to retrieve data to br edited
        $(document).on("click", ".edit", function () {
            var notification = $("#editNotification");
            var frm = $("#frmEdit");
            var btnSaveEdit = $("#btnSaveEdit");
            var id = $(this).data('id');
            var name = $(this).data('username');
            var first_name = $(this).data('first_name');
            var last_name = $(this).data('last_name');
            var phone = $(this).data('phone');
            var GroupID = $(this).data('GroupID');
            var username = $(this).data('username');
            $.ajax({
                type: "GET",
                url: "/getmemberbyid/"+id,
                data: {id: id},
                success: function (data, status) {
                    switch (status) {
                        case "success":

                            var res = jQuery.parseJSON(data);
                            document.getElementById("enditUserID").value = res.id;
                            document.getElementById("editFirstname").value = res.first_name;
                            document.getElementById("editLastname").value = res.last_name;
                            document.getElementById("editUsername").value = res.username;
                            document.getElementById("editEmail").value = res.email;
                            document.getElementById("editPhone").value = res.phone;
                            $('#editModal').modal('show');
                            console.log(data)
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
            var firstname = $("#editFirstname").val();
            var lastname = $("#editLastname").val();
            var username = $("#editUsername").val();
            var phone = $("#editPhone").val();
            var email = $("#editEmail").val();
            var password = $("#password").val();
            var id = $("#enditUserID").val();
            $.ajax({
                type: "PUT",
                url: "members/"+id,
                data: {id: id, firstname: firstname, lastname: lastname, password: password, email:email,phone:phone,"_token": "{{ csrf_token() }}" },
                success: function (data, status) {
                    switch (status) {
                        case "success":
                            if (data.status === '00') {
                                frm.hide();
                                editNotification.html('<div class="alert alert-success" >' + data.message + '</div>');
                                editNotification.show();
                                $("#btnSaveEdit").hide();
                            } else if (data.status === '01') {
                                editNotification.hide().find('#ul').empty();
                                $.each(data.errors,function(index,error){
//                                        editNotification.find('#ul').append('<li>'+ data.error +'</li>');
                                    editNotification.html('<div class="alert alert-danger">'+'<li>'+data.error+'</li>' +'</div>');
                                })
                                createNotification.show();
                            }
                            break;
                        default :
                            alert("do nothing");
                    }
                }
            });
        });

       // Deactivate User Group
        $(document).on('click', '.deactivate', function () {
            var id = $(this).data('id'); // get the ID
            var name = $(this).data('member'); // get the Name
            var notification = $("#deactivateNotification");
            var frm = $("#frmDeactivate");
            var btnDeactivate = $("#btnDeactivate");
            document.getElementById("deactivateId").value = id;
            document.getElementById("memberName").innerHTML = name;
        });
        $("#btnDeactivate").click(function () {
            var editNotification = $("#deactivateNotification");
            editNotification.hide();
            var frm = $("#frmDeactivate");
            var id = $("#deactivateId").val();
            var status = 1; //Status code fro blocked groups

            $.ajax({
                method: "PUT",
                url: "updatemember/",
                data: {id: id, status: status,"_token": "{{ csrf_token() }}"},
                success: function (data, status) {
                    switch (status) {
                        case "success":
                            if (data.status === '00') {
                                frm.hide();
                                editNotification.html('<div class="alert alert-success" >' + 'Member Successfully Deactivated' + '</div>');
                                editNotification.show();
                                $("#btnDeactivate").hide();
                            } else if (data.status === '01') {
                                editNotification.hide().find('#ul').empty();
                                $.each(data.errors,function(index,error){
//                                        editNotification.find('#ul').append('<li>'+ data.error +'</li>');
                                    editNotification.html('<div class="alert alert-danger">'+'<li>'+data.error+'</li>' +'</div>');
                                })
                                createNotification.show();
                            }
                            break;
                        case "failed":
                            editNotification.html('<div class="alert alert-danger">' + data.message + ' </div>');
                            editNotification.show();
                            frm.hide();
                            break;
                        default :
                            alert("do nothing");
                    }
                }
            });
        });
        // Activate User Group
        $(document).on('click', '.activate', function () {
            var id = $(this).data('id'); // get the ID
            var name = $(this).data('member'); // get the Name
            var notification = $("#activateNotification");
            var frm = $("#frmActivate");
            document.getElementById("activateId").value = id;
            document.getElementById("membersName").innerHTML = name;
        });
        $("#btnActivate").click(function () {
            var editNotification = $("#activateNotification");
            editNotification.hide();
            var frm = $("#frmActivate");
            var id = $("#activateId").val();
            var status = 0;

            $.ajax({
                method: "PUT",
                url: "updatemember/",
                data: {id: id, status: status,"_token": "{{ csrf_token() }}"},
                success: function (data, status) {
                    switch (status) {
                        case "success":
                            if (data.status === '00') {
                                frm.hide();
                                editNotification.html('<div class="alert alert-danger" >' + data.message + '</div>');
                                editNotification.show();
                                $("#btnActivate").hide();
                            } else if (data.status === '01') {
                                editNotification.hide().find('#ul').empty();
                                $.each(data.errors,function(index,error){
//                                        editNotification.find('#ul').append('<li>'+ data.error +'</li>');
                                    editNotification.html('<div class="alert alert-danger">'+'<li>'+data.error+'</li>' +'</div>');
                                })
                                createNotification.show();
                            }
                            break;
                        case "failed":
                            editNotification.html('<div class="alert alert-danger">' + data.message + ' </div>');
                            editNotification.show();
                            frm.hide();
                            break;
                        default :
                            alert("do nothing");
                    }
                }
            });
        });

        $("#newClose").click(function (){
            pageReload();
        });
        $(".btnClose").click(function (){
            pageReload();
        });
        $("#closeEdit").click(function (){
            pageReload();
        }); $("#closeNew").click(function (){
            pageReload();
        });

        function pageReload(){
            document.location.reload();
        }
    </script>
@endsection