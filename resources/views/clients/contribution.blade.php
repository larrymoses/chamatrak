@extends('layouts.clients')
@section('title', 'Monthly Contribution')
@section('content')
    <ul class="breadcrumb">
        <li>You are here</li>
        <li><a href="index.html?lang=en&amp;layout_type=fixed&amp;style=style-default-menus-light&amp;sidebar=false" class="glyphicons dashboard"><i></i> Dashboard</a></li>
        <li class="divider"><i class="icon-caret-right"></i></li>
        <li>Film Exhibition License Application</li>

    </ul>
    <div id="pdfTarget">
        <div class="innerAll shop-client-products cart invoice">

            <h2 class="separator bottom">Monthly Chama Contribution</h2>
            <table class="table table-invoice">
                <tbody>
                <tr>
                    <td style="width: 58%;">
                        <div class="media">
                            <img class="media-object pull-left thumb" src="images/logo.png" alt="Logo" />
                            <div class="media-body hidden-print">

                                <div class="separator bottom"></div>
                            </div>
                        </div>
                    </td>
                    <td class="right">
                        <div class="innerL">
                            <h4 class="separator bottom">#12345678 / {{date('M')}}</h4>
                            <button type="button" data-toggle="print" class="btn btn-default btn-icon glyphicons print hidden-print"><i></i> Print invoice</button>
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
                            <p class="lead">Licensee information</p>
                            <h3>Client Name Here</h3>
                            <address class="margin-none">
                                <strong>Business Street if exists</strong><br/>
                                P.O.Box 12345<br/>
                                Nairobi, Kenya<br/>
                                <abbr title="Work email">e-mail:</abbr> <a href="mailto:#">info@client.com</a><br />
                                <abbr title="Work Phone">phone:</abbr> (+254) 722-123-456<br/>
                            </address>
                        </td>
                        <td class="right">
                            <p class="lead">Pay To</p>
                            <h3>Kenya Film Classification Board</h3>
                            <address class="margin-none">
                                <strong>15th Floor Uchumi House</strong><br/>
                                P.O.Box 44226 - 00100<br/>
                                Nairobi, Kenya<br/>
                                <abbr title="Work email">e-mail:</abbr> <a href="mailto:#">info@kfcb.co.ke</a><br />
                                <abbr title="Work Phone">phone:</abbr> (+254) 0711-222-204<br/>
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
                            <p class="margin-none"><strong>You Can Also Use PayPal:</strong>
                            <div class="pricing-footer">
                                <button class="btn btn-block btn-primary">Check Out with PayPal</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
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
