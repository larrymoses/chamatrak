@extends('layouts.main')
@section('title', 'Members Contributions')
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-plus font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase">  </span>
                    </div>

                </div>
                <div class="portlet-body form">
                    <table id="usersActive" class="display table table-striped table-bordered responsive dataTable no-footer dtr-inline" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Member</th>
                            <th>Deposit Date</th>
                            <th>Amount</th>
                            <th>Mode</th>
                            <th>Created On</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>Member</th>
                            <th>Deposit Date</th>
                            <th>Amount</th>
                            <th>Mode</th>
                            <th>Created On</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                    </table>
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
                "sAjaxSource": "<?php echo url('getMembersContributions') ?>",
                "aoColumns": [
                    {mData: 'name'},
                    {mData: 'date'},
                    {mData: 'amount'},
                    {mData: 'mode'},
                    {mData: 'created_at'},
                    {mData: 'actions'}
                ]
            });
        });

    </script>


@endsection@extends('layouts.main')
@section('title', 'Chama Members')
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-plus font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase">  </span>
                    </div>

                </div>
                <div class="portlet-body form">
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

                        <tfoot>
                        <tr>
                            <th>Member Number</th>
                            <th>Users Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Created On</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('pagelevel')
            <!-- <script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script> -->
    <script type="text/javascript" src="{{asset('assets/js/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/datatables/media/assets/js/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('asset')}}"></script>
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
        });

    </script>


@endsection