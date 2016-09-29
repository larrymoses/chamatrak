<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Datatables;
use Auth;
class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('clients.index');
    }
    public function applyloan()
    {
        return view('clients.apply');
    }  
    public function contribute()
    {
        $member=DB::table('members')->where('email',Auth::User()->email)->value('id');
//        return $member;
        return view('clients.create',compact('member'));
    }
    public function contributions()
    {
        return view('clients.mycontributions');
    }
    public function getMyContributions()
    {
        $action='<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-remove" data-id=" {{ $id }}" data-member="{{$first_name }}{{$last_name }}">Decline Member</a></li>
                                <li><a href="#" class="approveNew"  data-toggle="modal" data-target=".bs-example-modal-approve" data-id=" {{ $id }}" data-member="{{$username  }}">Approve Member</a></li>
                            </ul>
                        </div>';

//        $id=DB::raw('select members.id from members where members.email=?');
        $contributions=DB::table('contributions')

            ->join('members', 'contributions.member', '=', 'members.id')
            ->where('members.email',Auth::user()->email)
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
