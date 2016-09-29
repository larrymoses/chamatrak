<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use DB;
use Excel;
use App\Users;
use Validator;
use Datatables;
use App\Member;
use Auth;
use Mail;
use App\Contribution;
class MembersController extends Controller
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
        return view('members.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $max = DB::table('members')->max('no');
        return view('members.create', compact('max'));
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
            'phone' => 'required',
            'role' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|max:255|unique:members|unique:users',
        ]);
        if ($validator->fails()) {
              //Record Audit Logs
            // $logs=new AuditLog;
            // $logs->username =Auth::User()->username;
            // $logs->activity ="Create User: Validation error ";
            // $logs->status ="0";
            // $logs->userID =Auth::User()->id;
            // $logs->save();
            return redirect('members/create')
                        ->withErrors($validator)
                        ->withInput();
            
        }
        $max = DB::table('members')->max('no');
        $rand = substr(md5(microtime()),rand(0,26),5);
        $member= new Member();
        $member->first_name = $request->input('firstname');
        $member->last_name = $request->input('lastname');
        $member->username = $request->input('firstname').'_'.$request->input('lastname');
        $member->email = $request->input('email');
        $member->phone = $request->input('phone');
        $member->raw_password = $rand;
        $member->no = $max+1;
        $member->member_no = $request->input('member_no');
        $member->createdby = Auth::User()->id;
        if( $member->save()) {
            //create login details
            $user= new Users();
            $user->name = $request->input('firstname').' '.$request->input('lastname');
            $user->email = $request->input('email');
            $user->activated = "1";
            $user->password = bcrypt($rand);
            $user->save();
            //send username and password
            $data = array('email'=>$request->input('email'),'password'=>$rand);
            Mail::send('emails.signup', ['data'=>$data], function($message)use ($request) {
                $message->to($request->input('email'), $request->input('firstname').' '.$request->input('lastname'))->subject('Success Chama Registration');
                $message->cc('lkiprop@flag42.com','Chama System');
                $message->from('noreply@chamatrak.com','Chama System');
            });
            return redirect('members')->with('message','Member '.$request->input('firstname').' '.$request->input('lastname').' Created Successfully, An email with login details sent to '.$request->input('email'));
        };
    }
    public function getmemberbyid($id)
    {
        $user=Member::find($id);
        return json_encode($user);
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
    public function ApproveMembers(Request $request)
    {
        $id=$request->input('id');
        $member= Member::findOrFail($id);
        $member->status=$request->input('status');
        if($member->save()){
            return response()->json([
                'success'=>false,
                'status'=>'00',
                'message' =>'<code> Member </code> Approved Successfully'
            ]);
        }
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make(Input::All(), [
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success'=>false,
                'status'=>'01',
                'errors'=>$validator->errors()->toArray()
            ]);
        }
        else{
            $user = Member::findOrFail($id);
                $user->first_name = $request->input('firstname');
                $user->last_name = $request->input('lastname');
                $user->phone = $request->input('phone');
                $user->editedby = Auth::User()->id;
                $user->save();
            return response()->json([
                'success'=>false,
                'status'=>'00',
                'message' =>'Edit Successful'
            ]);
        }
    }
    public function downloadExcel($type)

    {

        $data = Item::get()->toArray();

        return Excel::create('itsolutionstuff_example', function($excel) use ($data) {

            $excel->sheet('mySheet', function($sheet) use ($data)

            {

                $sheet->fromArray($data);

            });

        })->download($type);

    }
    public function importExcel()

    {

        if(Input::hasFile('import_file')){

            $path = Input::file('import_file')->getRealPath();

            $data = Excel::load($path, function($reader) {

            })->get();

            if(!empty($data) && $data->count()){

                foreach ($data as $key => $value) {

                    $insert[] = ['title' => $value->title, 'description' => $value->description];

                }

                if(!empty($insert)){

                    DB::table('items')->insert($insert);

                    dd('Insert Record successfully.');

                }

            }

        }

        return back();

    }
    public function importExport()
    {
        return view('members.import');
    }

    public function sendEmailReminder($id)
    {
        $data = Member::findOrFail($id);

        Mail::queue('emails.reminder', ['data' => $data], function ($m) use ($data) {
            $m->from('hello@app.com', 'ChamaTrak System');
            $m->cc('lkiprop@flag42.com', 'Chama System Admin');
            $m->to($data->email, $data->name);
            $m->subject('Late Chama Contribution');
        });

        return redirect()->back()->with('message', 'Email send to: '.$data->email);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getmembercontbyid($id)
    {
        $user=Contribution::find($id);
        return json_encode($user);
    }
    public function getMembers($status)
    {
        if($status==1){
            $action='<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">

                                <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-edit" data-id=" {{ $id }}" class="edit">Edit</a></li>
                                <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-activate" data-id=" {{ $id }}" data-member="{{$first_name }} {{$last_name }}"  class="activate">Activate</a></li>
                            </ul>
                        </div>';
        } elseif($status==0){
            $action='<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-edit" data-id=" {{ $id }}" class="edit">Edit</a></li>
                                <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-deactivate" data-id=" {{ $id }}" data-member="{{$first_name }} {{$last_name }}" class="deactivate">Block Member</a></li>
                            </ul>
                        </div>';
        }elseif($status==3){
            $action='<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-edit">Edit</a></li>
                                <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-remove">Remove</a></li>
                                <li><a href="#"  data-toggle="modal" data-target=".bs-example-modal-activate">Activate</a></li>
                                </ul>
                        </div>';
        }elseif($status==4){
            $action='<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                               <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-deny">Deny</a></li>
                               <li><a href="#"  data-toggle="modal" data-target=".bs-example-modal-approve">Approve</a></li>
                               </ul>
                        </div>';
        }

        $members=DB::table('members')
            ->join('member_groups', 'members.membergroup', '=', 'member_groups.id')
            ->where('members.status', '=', $status)
            ->select('members.*', 'member_groups.groupname');
        return Datatables::of($members)
            ->editColumn('id',"{{ \$id }}")
            ->editColumn('email','<a href=\"mailto:{{ $email}}" target = "_top" >'."{{ \$email}}".'</a >')
            ->addColumn('name',"{{ \$first_name .' '. \$last_name }}")
            ->addColumn('actions',$action)
            ->make(true);
    }
    public function sendLateContEmailReminder(){
        $member=DB::table('members')->lists('username','id');
        return view('members.latecont',compact('member'));
    }
    public function getLateMembersContributions()
    {
        $action="<a href=\"{{url('test/').'/'.\$id}}\" class=\"btn btn-primary btn-xs\">Send Reminder</a>";
        $contributions=DB::table('contributions')
            ->join('members', 'contributions.member', '=', 'members.id')
            ->where('contributions.amount','<','3000')
            ->groupBy('contributions.member','contributions.month')
            ->select('contributions.*','members.member_no', 'members.first_name','members.last_name','members.username');
        return Datatables::of($contributions)
            ->editColumn('id',"{{ \$id }}")
            ->addColumn('name',"{{ \$first_name .' '. \$last_name }}")
            ->addColumn('actions',$action)
            ->make(true);
    }
}
