<?php

namespace App\Http\Controllers;

use App\Asset;
use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use DB;
use Validator;
use Auth;
use Datatables;
use Illuminate\Support\Facades\Input;
class AssetsController extends Controller
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
        return view('asset.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group=DB::table('asset_group')->lists('name');
        return view('asset.create',compact('group'));
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
            'name' => 'required',
            'amount' => 'required',
            'category' => 'required',
        ]);
        if ($validator->fails()) {
            //Record Audit Logs
            // $logs=new AuditLog;
            // $logs->username =Auth::User()->username;
            // $logs->activity ="Create User: Validation error ";
            // $logs->status ="0";
            // $logs->userID =Auth::User()->id;
            // $logs->save();
            return redirect('asset/create')
                ->withErrors($validator)
                ->withInput();

        }
        $add=1;
        $rand = substr(md5(microtime()),rand(0,26),5);
        $member= new Asset;
        $member->name = $request->input('name');
        $member->description = $request->input('description');
        $member->amount = $request->input('amount');
        $member->category = $request->input('category');
        $member->createdby = Auth::User()->id;
        if( $member->save()) {
            //send username and password
            $data = array('email'=>"lkiprop@flag42.com",'password'=>'jfbgsidfg');
            Mail::queue('emails.send', ['data'=>$data], function($message) {
                $message->to('lkiprop@flag42.com','Larry Moses')->subject('Success Chama Creation');
                $message->from('noreply@chamatrak.com','Chama System');
            });

            return redirect('asset')->with('message','Asset '.$request->input('name').' Posted Successfully');

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
        $data = $id->only('name', 'email', 'phone');


        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->subject('Blog Contact Form: ')
                ->to('lkiprop@flag42.com')
                ->replyTo('lkiprop@flag42.com');
        });

        return back()
            ->withSuccess("Thank you for your message. It has been sent.");

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
    public function getAssets()
    {
        $action='<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-edit" data-id=" {{ $id }}" class="edit">Edit</a></li>
                                <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-remove" data-id=" {{ $id }}" data-member="{{$name }}">Decline Member</a></li>
                                <li><a href="#" class="approveNew"  data-toggle="modal" data-target=".bs-example-modal-approve" data-id=" {{ $id }}" data-member="{{$name  }}">Approve Member</a></li>
                            </ul>
                        </div>';


        $members=DB::table('assets')
            ->join('asset_group', 'assets.category', '=', 'asset_group.id')
            ->select('assets.*', 'asset_group.name as gname');
        return Datatables::of($members)
            ->editColumn('id',"{{ \$id }}")
            ->addColumn('actions',$action)
            ->make(true);
    }
}
