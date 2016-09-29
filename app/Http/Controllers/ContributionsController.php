<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Contribution;
use Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use Datatables;
use Mail;
class ContributionsController extends Controller
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
        $member=DB::table('members')->lists('username','id');
        return view('contributions.index',compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $member=DB::table('members')->lists('username','id');
        return view('contributions.create',compact('member'));
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
            'member' => 'required',
            'amount' => 'required',
            'mode' => 'required',
        ]);
        if ($validator->fails()) {
            //Record Audit Logs
            // $logs=new AuditLog;
            // $logs->username =Auth::User()->username;
            // $logs->activity ="Create User: Validation error ";
            // $logs->status ="0";
            // $logs->userID =Auth::User()->id;
            // $logs->save();
            return redirect('contributions/create')
                ->withErrors($validator)
                ->withInput();

        }
        $add=1;
        $rand = substr(md5(microtime()),rand(0,26),5);
        $contribution= new Contribution();
        $contribution->member = $request->input('member');
        $contribution->date = date('d-m-Y');
        $contribution->amount = $request->input('amount');
        $contribution->mode = $request->input('mode');
        $contribution->month = $request->input('month');
        $contribution->transactionid = $rand;
        $contribution->createdby = Auth::User()->id;
        if( $contribution->save()) {
            $data=DB::table('members')->where('id',$request->input('member'))->first();
            Mail::send('emails.payment', ['request'=>$request], function($message)use ($data) {
                $message->to($data->email, $data->first_name.' '.$data->last_name)->subject('Monthly Contribution');
                $message->cc('lkiprop@flag42.com','Chama System');
                $message->from('noreply@chamatrak.com','Chama System');
            });

            if(Auth::User()->member==1) {
                return redirect('contributions')->with('message', 'Contribution Posted Successfully');
            }else{
                return redirect('client/contributions')->with('message', 'Contribution Posted Successfully');
            }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updates(Request $request, $id)
    {
        $validator = Validator::make(Input::All(), [
            'amount' => 'required',
        ]);
        if ($validator->fails()) {
            //Record Audit Logs
            return response()->json([
                'success'=>false,
                'status'=>'01',
                'errors'=>$validator->errors()->toArray()
            ]);
        }
        else{
            $film = Contribution::find($id);
                $film->amount = $request->input('amount');
                $film->mode = $request->input('mode');
                $film->month = $request->input('month');
                $film->save();
            }
            return response()->json([
                'success'=>false,
                'status'=>'00',
                'message' =>'Updated Successfully'
            ]);

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
    public function getMembersContributions()
    {
        $action='<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-edit" data-id=" {{ $id }}" class="edit">Edit</a></li>
                                <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-remove" data-id=" {{ $id }}" data-member="{{$first_name }}{{$last_name }}">Decline Member</a></li>
                                <li><a href="#" class="approveNew"  data-toggle="modal" data-target=".bs-example-modal-approve" data-id=" {{ $id }}" data-member="{{$username  }}">Approve Member</a></li>
                            </ul>
                        </div>';

//        $sum=DB::table('contributions')->groupBy('member')->sum('amount');
        $contributions=DB::table('contributions')
            ->join('members', 'contributions.member', '=', 'members.id')
            ->groupBy('contributions.member','contributions.month')
            ->select('contributions.*', DB::raw('sum(contributions.amount) as total'),'members.member_no', 'members.first_name','members.last_name','members.username');
        return Datatables::of($contributions)
            ->editColumn('id',"{{ \$id }}")
            ->addColumn('name',"{{ \$first_name .' '. \$last_name }}")
            ->editColumn('balance','@if(3000==$total)
                                <div class="badge badge-success">NIL</div>
                            @elseif(3000<$total)
                                <div class="badge badge-primary">LESS</div>
                            @elseif(3000>$total)
                            <div class="badge badge-danger">MORE</div>
                            @endif')
            ->addColumn('actions',$action)
            ->make(true);
    }
}
