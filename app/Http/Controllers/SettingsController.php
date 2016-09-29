<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Psy\Util\Json;
use Validator;
use Illuminate\Support\Facades\Input;
use App\Contribution;
use DB;
use Datatables;
class SettingsController extends Controller
{
    public function setContributions()
    {
        return view('settings.contributions');
    }
    public function postSetContributions(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:cont_setting',
            'amount' => 'required',
        ]);
        if(DB::table('cont_setting')->insert(
            [
                'name' => $request->input('name'),
                'amount' => $request->input('amount'),
                'type' => $request->input('type')
            ]
        )){
            return response()->json([
                'success'=>false,
                'status'=>'00',
                'message' =>'<code>'. Input::get('name').'</code>'.' Created Successfully'
            ]);
        }
    }
    public function getContributionSettings()
    {
        $action='<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="'.url('loans/').'/{{ $id }}" data-id=" {{ $id }}" class="edit">View/Edit</a></li>
                            </ul>
                        </div>';


        $members=DB::table('cont_setting');
        return Datatables::of($members)
            ->editColumn('id',"{{ \$id }}")
            ->addColumn('actions',$action)
            ->make(true);
    }
}
