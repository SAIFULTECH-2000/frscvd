<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\users;
use Illuminate\Support\Facades\DB;

class dashboardcontroller extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
    public function profile()
    {
        $userid =Session::get('userid');
        $users = users::where('userid', $userid)
        ->get()
        ->first();
        return view('profile',['users'=>$users]);
    }
    public function changeprofile(Request $request){
        $data = [
            'username'=>$request->username,
            'useremail'=>$request->useremail,
            'usernric'=>$request->usernric1.$request->usernric2.$request->usernric3,
            'useraddress'=>$request->useraddress
        ];
        $userid =Session::get('userid');
        $users = users::where('userid', $userid);
        $users->update($data);
        return redirect('/dashboard')->with('message', 'Successfully edited.');
    }
    public function chdriskform(Request $request)
    {
        return view('chdriskform');
    }
    public function listpatient()
    {
        $formtbl = DB::table('formtbl')->paginate(5);
        return view('listpatient',['formtbl'=>$formtbl]);
    }
}
