<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\users;

class authcontroller extends Controller
{
    public function login()
    {
       
        return view('login');                                       
          
    
    }
    public function forgetpassword()
    {
       return view('forgetpassword');
    }
    public function auth(Request $req)
    {
        $messages = [
            'required' => 'diperlukan',
        ];
        $rules = [
            'useremail' => 'required',
            'userpassword' => 'required',
        ];
        $validator = $req->validate($rules, $messages);
        $data = $req->input();
        $check = users::where('useremail', $req->useremail)->exists();

        if ($check) {
            $users = users::where('useremail', $req->useremail)
                ->get()
                ->first();

            $userid = $users->userid;
            $usernric = $users->usernric;
            $username = $users->username;
            $useremail = $users->useremail;
            $useraddress = $users->useraddress;
            $useradmin = $users->useradmin;
            $userpassword = $users->userpassword;
            $time =$_SERVER['REQUEST_TIME'];
            $lastactivity = $time;

            if ($userpassword == $data['userpassword']) {
               
                    Session::put('userid', $userid);
                    Session::put('usernric', $usernric);
                    Session::put('username', $username);
                    Session::put('useremail', $useremail);
                    Session::put('useraddress', $useraddress);
                    Session::put('useradmin', $useradmin);
                    Session::put('LastActivity', $lastactivity);
                    return redirect('/dashboard')->with('message', 'You have successfully signed into your account.');
                
            } else {
                return redirect()
                    ->back()
                    ->with('fails', 'Wrong password entered');
            }
        } else {
            return redirect()
                ->back()
                ->with('fails', 'Unregistered user email.');
        }
    }
    function logout()
    {
        Session::flush();
        return redirect('/')->with('logout', 'You have successfully logged out.');
    }
}
