@extends('layouts.invoice')
@section('title', 'Chama Members')
@section('content')
    <div id="content">
        <!-- Top navbar -->
        <div class="navbar main">
            <!-- Menu Toggle Button -->
            <button type="button" class="btn btn-navbar pull-left visible-phone">
                <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
            </button>
            <ul class="topnav pull-left">
                <li><a href="{{url('/')}}" class="glyphicons dashboard"><i></i> Dashboard</a></li>
                <li><a href="{{url('loans')}}" class="glyphicons list"><i></i> Loans</a></li>
                <li class="active"><a href="#" class="glyphicons file"><i></i> My Invoices</a></li>
            </ul>
            <!-- // Not Blank Page END -->
            <!-- Top Menu Right -->
            <ul class="topnav pull-right hidden-phone">
                <!-- Profile / Logout menu -->
                <li class="account dropdown dd-1">
                    <a data-toggle="dropdown" href="{{url('logout')}}" class="glyphicons logout lock"><span class="hidden-tablet hidden-phone hidden-desktop-1">User Logout</span><i></i></a>

                </li>
                <!-- // Profile / Logout menu END -->

            </ul>
            <!-- // Top Menu Right END -->

            <div class="clearfix"></div>

        </div>
        <div id="pdfTarget">
            <div class="innerAll shop-client-products cart invoice">

                <h2 class="separator bottom">CHAMATRAK INVOICE</h2>
                <table class="table table-invoice">
                    <tbody>
                    <tr>
                        <td style="width: 58%;">
                            <div class="media">
                                <img class="media-object pull-left thumb" src="{{asset('assets/layouts/layout2/img/download.jpg')}}" alt="Logo" />
                                <div class="media-body hidden-print">

                                    <div class="separator bottom"></div>
                                </div>
                            </div>
                        </td>
                        <td class="right">
                            <div class="innerL">
                                <h4 class="separator bottom">#12345678 / 22 Jul 2016</h4>
                                <a type="button" data-toggle="print" class="btn btn-default btn-icon glyphicons print hidden-print" onclick="javascript:window.print();"><i></i> Print invoice</a>
                                <button type="button" data-toggle="button-loading pdf" data-target="#pdfTarget" class="btn btn-primary btn-icon glyphicons download_alt hidden-print"><i></i> Save as PDF</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="separator bottom hidden-print"></div>

                <div class="well">
                    <table class="table table-invoice">
                        <tbody>
                        <tr>
                            <td style="width: 50%;">
                                <p class="lead">Loan information</p>
                                <h3>Loan Amount: KES {{$loan->amount}}</h3>
                                <address class="margin-none">
                                    <strong>Loan Date: {{$loan->date}}</strong><br/>
                                    Loan Interest Rate:{{$loan->rate}}% on {{$loan->interest_type}}<br/>
                                    Loan Duration: {{$loan->period}} Months<br/>
                                    <abbr title="Work email">Loan Status:</abbr> <a href="mailto:#">unpaid</a><br />
                                    <abbr title="Work Phone">Loan Fine Deferment: </abbr> INACTIVE<br/>
                                </address>
                            </td>
                            <td class="right">
                                <p class="lead">Member Details</p>
                                <h3>{{$member->first_name}} {{$member->last_name}} ({{$member->username}})</h3>
                                <address class="margin-none">
                                    <strong>{{$member->member_no}}</strong><br/>
                                    P.O.Box 44226 - 00100<br/>
                                    Nairobi, Kenya<br/>
                                    <abbr title="Work email">e-mail:</abbr> <a href="mailto:#">{{$member->email}}</a><br />
                                    <abbr title="Work Phone">phone:</abbr> {{$member->phone}}<br/>
                                    <div class="separator line"></div>
                                </address>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <table class="table table-bordered table-primary table-striped table-vertical-center">
                    <thead>
                    <tr>
                        <th style="width: 1%;" class="center">No.</th>
                        <th></th>
                        <th style="width: 50px;">QTY</th>
                        <th style="width: 80px;">PRICE</th>
                        <th style="width: 80px;">VAT(16%)</th>
                        <th style="width: 80px;">TAX incl.</th>
                    </tr>
                    </thead>
                    <tbody>

                    <!-- Cart item -->
                    <tr>
                        <td class="center">1</td>
                        <td>
                            <h5>Monthly Contribution</h5>
                            <span class="label">The Month of: {{date('M')}}</span>
                        </td>
                        <td class="center">1</td>
                        <td class="center">3,000</td>
                        <td class="center">1.60</td>
                        <td class="center">11.60</td>
                    </tr>
                    <!-- // Cart item END -->
                    <!-- Cart item -->
                    <tr>
                        <td class="center">2</td>
                        <td>
                            <h5>Late Payment Fine(if any)</h5>
                            <span class="label">Accrued fines</span>
                        </td>
                        <td class="center">1</td>
                        <td class="center">0</td>
                        <td class="center">0</td>
                        <td class="center">0</td>
                    </tr>



                    </tbody>
                </table>
                <div class="separator bottom hidden-print"></div>

                <!-- Row -->
                <div class="row-fluid">

                    <!-- Column -->
                    <div class="span5">

                    </div>
                    <!-- Column END -->

                    <!-- Column -->
                    <div class="span4 offset3">
                        <table class="table table-borderless table-condensed cart_total">
                            <tbody>
                            <tr>
                                <td class="right">Subtotal:</td>
                                <td class="right strong">1,000.00</td>
                            </tr>
                            <tr>
                                <td class="right">Processing Fee:</td>
                                <td class="right strong"> 5.00</td>
                            </tr>

                            <tr>
                                <td class="right">Total:</td>
                                <td class="right strong">KES 1,195.95</td>
                            </tr>
                            <tr class="hidden-print">
                                <td colspan="2"><button type="submit" id="proceedPay" class="btn btn-block btn-primary btn-icon glyphicons right_arrow"><span>Proceed to Payment</span></button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- // Column END -->

                </div>
                <!-- // Row END -->
                <div class="row-fluid" id="lipaNaMpesa">

                    <div class="box-generic span6">
                        <p class="margin-none"><strong>Paybill:</strong><br/>Our Paybill No is 12345.</p><br/>
                        <p class="margin-none"><strong>Note:</strong><br/>Payments must be recieved by KFCB prior to processing you license application.</p>

                    </div>

                    <div class="box-generic span6">
                        <div class="db-wrapper">
                            {!! Form::open(array('route' => 'getCheckout')) !!}
                            {!! Form::hidden('type','small') !!}
                            {!! Form::hidden('pay',0.01) !!}
                            <div class="db-pricing-eleven db-bk-color-one">
                                <div class="price">
                                    <sup>KES</sup>30
                                    <small>per Month</small>
                                </div>
                                <div class="type">
                                    SMALL PLAN
                                </div>
                                <div class="pricing-footer">
                                    <button class="btn db-button-color-square btn-lg">Check Out with PayPal</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script type='text/javascript' charset="utf-8">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#lipaNaMpesa').hide();

            $("#proceedPay").click(function () {
                var createNotification = $("#createNotification");
                createNotification.hide();
                var btnProceed=$('#proceedPay');
                var frm = $('#frmCreate');
                var lipa = $('#lipaNaMpesa');
                var data = frm.serialize();

                lipa.show();
                btnProceed.hide();
            });
        });
    </script>
@endsection
