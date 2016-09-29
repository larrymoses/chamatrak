@extends('layouts.clients')
@section('title', 'Chama Loan Application')
@section('content')
    <ul class="breadcrumb">
        <li>You are here</li>
        <li><a href="index.html?lang=en&amp;layout_type=fixed&amp;style=style-default-menus-light&amp;sidebar=false" class="glyphicons dashboard"><i></i> Dashboard</a></li>
        <li class="divider"><i class="icon-caret-right"></i></li>
        <li>Film Exhibition License Application</li>

    </ul>

    <h2>Chama Loan Application</h2>
    <div class="innerLR">
        <!-------------------------------------------->
        <!-- Form -->
        <form class="form-horizontal margin-none" id="validateSubmitForm" method="get" autocomplete="off">

            <!-- Widget -->
            <div class="widget widget-heading-simple widget-body-gray">
                <div class="widget-body">
                    <!-- Row -->
                    <div class="row-fluid">
                        <!-- Column -->
                        <div class="span12">
                            <!-- Group -->
                            <div class="control-group">
                                <h4>Loan Details</h4>
                                <label class="control-label" for="amount">Applicant Name </label>
                                <div class="controls"><input class="span12" id="amount" name="amount" type="text" value="{{Auth::user()->first_name}}  {{Auth::user()->last_name}}"/></div>
                            </div>
                            <!-- // Group END -->
                            <hr class="separator" />

                        </div>
                        <!-- <hr class="separator" />-->
                    </div>


                    <h5> Enter Loan Details</h5>
                    <!-- Row for director details-->
                    <div class="row-fluid">

                        <!-- Column for Dir1 and 2 -->
                        <div class="span6">

                            <!-- Group -->
                            <div class="control-group">
                                <label class="control-label" for="Director1">Amount </label>
                                <div class="controls"><input class="span12" id="amount" name="amount" type="text" /></div>
                            </div>
                            <!-- // Group END -->

                            <!-- Group -->
                            <div class="control-group">
                                <label class="control-label" for="Director2">Period</label>
                                <div class="controls"><input class="span12" id="period" name="period" type="text" /></div>
                            </div>
                            <!-- // Group END -->

                        </div>
                        <!-- end column -->

                        <!-- Column for Dir2 and 23-->
                        <div class="span6">
                            <!-- Group -->
                            <div class="control-group">
                                <label class="control-label" for="Director3">Loan Type</label>
                                <div class="controls">
                                    <select class="selectpicker span12" data-style="btn-primary">
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>

                                </div>
                            </div>
                            <!-- // Group END -->

                            <!-- Group -->
                            <div class="control-group">
                                <label class="control-label" for="Director4">Interest Rate</label>
                                <div class="controls"><input class="span12" id="rate" name="rate" type="text" /></div>
                            </div>
                            <!-- // Group END -->

                        </div>
                        <!-- end column -->

                    </div>
                    <!-- // Row END -->

                    <hr class="separator" />
                    <h5>Guaranter Details</h5>
                    <!-- Row for exhibition details -->

                    <div class="row-fluid">

                        <!-- Column for Dir1 and 2 -->
                        <div class="span6">

                            <!-- Group -->
                            <div class="control-group">
                                <label class="control-label" for="Director1">Guarantee 1 </label>
                                <div class="controls"><select class="selectpicker span12" data-style="btn-primary">
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select></div>
                            </div>
                            <!-- // Group END -->

                            <!-- Group -->
                            <div class="control-group">
                                <label class="control-label" for="Director2">Amount</label>
                                <div class="controls"><input class="span12" id="period" name="period" type="text" /></div>
                            </div>
                            <!-- // Group END -->

                        </div>
                        <!-- end column -->

                        <!-- Column for Dir2 and 23-->
                        <div class="span6">
                            <!-- Group -->
                            <div class="control-group">
                                <label class="control-label" for="Director3">Guarantee 1</label>
                                <div class="controls">
                                    <select class="selectpicker span12" data-style="btn-primary">
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>

                                </div>
                            </div>
                            <!-- // Group END -->

                            <!-- Group -->
                            <div class="control-group">
                                <label class="control-label" for="Director4">Amount</label>
                                <div class="controls"><input class="span12" id="rate" name="rate" type="text" /></div>
                            </div>
                            <!-- // Group END -->

                        </div>
                        <!-- end column -->

                    </div>
                    <!-- // Row END -->

                    <hr class="separator" />


                    <!-- Last Row with signature and Cap222 -->
                    <div class="row-fluid uniformjs">

                        <!-- Column -->
                        <div class="span4">
                            <h4 style="margin-bottom: 10px;">Terms &amp; Conditions</h4>
                            <label class="checkbox" for="agree">
                                <input type="checkbox" class="checkbox" id="agree" name="agree" />
                                Please agree to our Terms &amp; Conditions <br/>

                            </label>
                            <p>
                            <h4 style="margin-bottom: 10px;">Digital Signature</h4>
                            <label class="checkbox" for="sign">
                                <input type="checkbox" class="checkbox" id="sign" name="sign" />
                                Click this to digitally sign your application.
                            </label>
                            </p>
                        </div>
                        <!-- // Column END -->



                        <div class="span6">
                            <h4 style="margin-bottom: 10px;">Cap. 222</h4>
                            It is unlawful (Cap. 222) to display, sell or hire out movie content before it is examined and
                            classification labels affixed or operate without a valid film license. I hereby agree to abide by
                            the Cap 222 Laws of Kenya regulations and conform that the details given above are true to the
                            best of my knowledge.
                        </div>
                    </div>
                    <!-- // Row END -->

                    <hr class="separator" />

                    <!-- Form actions -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Submit &amp; Pay</button>
                    </div>
                    <!-- // Form actions END -->

                </div>
            </div>
            <!-- // Widget END -->

        </form>
        <!-- // Form END -->
    </div>
@endsection
