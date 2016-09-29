@extends('layouts.main')
@section('title', 'Members Contributions')
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="portlet light ">
                <div class="portlet-title">
                    <a href="{{url('asset/create')}}" class="btn btn-circle btn-outline red">
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
                            <th>Asset Name</th>
                            <th>Asset Description</th>
                            <th>Asset Amount</th>
                            <th>Asset Category</th>
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
                "sAjaxSource": "<?php echo url('getAssets') ?>",
                "aoColumns": [
                    {mData: 'name'},
                    {mData: 'description'},
                    {mData: 'amount'},
                    {mData: 'gname'},
                    {mData: 'created_at'},
                    {mData: 'actions'}
                ]
            });
        });

    </script>
@endsection