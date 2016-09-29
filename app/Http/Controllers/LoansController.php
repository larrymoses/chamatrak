<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use DB;
use Excel;
use App\Users;
use App\Loan;
use Validator;
use Datatables;
use App\Member;
use Auth;
use Mail;
class LoansController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('loans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members=DB::table('members')->lists('username','id');
        return view('loans.create',compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(Input::All(), [
            'amount' => 'required',
            'date' => 'required',
            'period' => 'required',
            'member' => 'required',
            'interest_type' => 'required',
        ]);
        if ($validator->fails()) {
            //Record Audit Logs
            // $logs=new AuditLog;
            // $logs->username =Auth::User()->username;
            // $logs->activity ="Create User: Validation error ";
            // $logs->status ="0";
            // $logs->userID =Auth::User()->id;
            // $logs->save();
            return redirect('loans/create')
                ->withErrors($validator)
                ->withInput();

        }
        $rand = substr(md5(microtime()),rand(0,26),5);
        $member= new Loan();
        $member->member = $request->input('member');
        $member->amount = $request->input('amount');
        $member->period = $request->input('period');
        $member->interest_type = $request->input('interest_type');
        $member->grace_period = $request->input('grace_period');
        $member->createdby = Auth::User()->id;
        $member->randomid = $rand;
        if( $member->save()) {
            $randid=DB::table('loans')->where('randomid',$rand)->value('id');;
            return redirect('loans/'.$randid)->with('message','Member '.$request->input('firstname').' '.$request->input('lastname').' Created Successfully, An email with login details sent to '.$request->input('email'));
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loan = Loan::findOrFail($id);
        $member = Member::findOrFail($loan->member);
        return view('loans.invoice',compact('loan','member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getAppliedLoans()
    {
        $action='<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="'.url('loans/').'/{{ $id }}" data-id=" {{ $id }}" class="edit">View</a></li>
                                <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-remove" data-id=" {{ $id }}" data-member="{{$first_name }}{{$last_name }}">Decline Member</a></li>
                                <li><a href="#" class="approveNew"  data-toggle="modal" data-target=".bs-example-modal-approve" data-id=" {{ $id }}" data-member="{{$username  }}">Approve Member</a></li>
                            </ul>
                        </div>';


        $members=DB::table('loans')
            ->join('members', 'loans.member', '=', 'members.id')
            ->select('loans.*', 'members.first_name','members.last_name','members.username');
        return Datatables::of($members)
            ->editColumn('id',"{{ \$id }}")
            ->addColumn('name',"{{ \$first_name .' '. \$last_name }}")
            ->addColumn('actions',$action)
            ->make(true);
    }
}
