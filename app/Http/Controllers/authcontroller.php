<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\users;
 use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;  
use PHPMailer\PHPMailer\Exception;
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

            if (password_verify($data['userpassword'],$userpassword)){
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
    function checkemail(Request $request)
    {
        	$token = bin2hex(random_bytes(50)); //generates random token
		$expFormat = mktime(date("H"), date("i"), date("s"), date("m")+1 ,date("d"), date("Y"));
		$expDate = date("Y-m-d H:i:s",$expFormat);
	
    $domain ='http://127.0.0.1:8000/frscvd/';
    $link="<a href='".$domain."/change-password?token=".$token."' style=' background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;'>Click To Reset password</a>";
       
         $check = users::where('useremail', $request->useremail)->exists();
         if($check){
            $users = users::where('useremail', $request->useremail)->get()->first();
             require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions
 
        try {
 
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
                   //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = "fhcatscreen@gmail.com";
        // GMAIL password
        $mail->Password = "baqvxpccsktgpgmk";
        $mail->SMTPSecure = "ssl";  
        // sets GMAIL as the SMTP server
        $mail->Host = "smtp.gmail.com";          // encryption - ssl/tls
            $mail->Port = "465";                        // port - 587/465
 
$mail->From='fhcatscreen@gmail.com';
        $mail->FromName='FHcatscreen System';            
             $mail->AddAddress($request->useremail , '');
            $mail->AddAddress("marshima@tmsk.uitm.edu.my","marshima");
           $mail->AddAddress("saifultech.official@gmail.com","saifultech");
 
 
            $mail->isHTML(true);                // Set email content format to HTML
 
            $mail->Subject = 'Reset Password';
            $mail->Body = "
        <div style='background-color:#F11111'>
        <center>
        <img src='https://fskmtech.com/frscvd/icons/icon.png' >
        </center>
        <div id='m_3260540749847817210content' style='font-size:16px;padding:25px;background-color:#fff;border-radius:10px;border-color:#a3d0f8;border-width:4px 1px;border-style:solid'>

				<h1 style='font-size:22px;text-decoration:underline'><center>RESET ACCOUNT PASSWORD</center></h1>

				<p>Hello ".$users->username.",</p>
			    
				<p>
We've received a request to reset the password for the fhcatscreen<br>
account associated with ".$users->useremail.". No changes<br>
have been made to your account yet<br>
You can reset your password by clicking the link below: </p><br>
<center>
				".$link."</center>
			<br>  If you did not request a new password, please let us know<br>
immediately by replying to this email.<br>
You can find answers to most questions and get in touch With us at<br>
fhcatscreen@gmail.com. We're here to help you at any step along the<br>
way<br>
— The Fhcatscreen team
          </div>
        </div>
        ";
 
            // $mail->AltBody = plain text version of email body;
 
            if( !$mail->send() ) {
                return back()->with("fails", "Email not sent.")->withErrors($mail->ErrorInfo);
            }
            
            else {
                $data = [
            'useremail'=>$request->useremail,
            'changetoken'=>$token,
            'exptime'=>$expDate,
        ];
    DB::table('changetbl')->insert($data);
        
             return   redirect('/')->with('logout', 'Email has been sent.');
            }
 
        } catch (Exception $e) {
              return redirect()
                ->back()
                ->with('fails', 'Opss, please contact your developer to check this error');
        }
         }else{
             return redirect()
                ->back()
                ->with('fails', 'Unregistered user email.');
         }
    }
    function change_password(Request $request)
    {
       if($request->has('token'))
       {
        
       }else{
         return redirect('/')
                ->with('fails', 'Invalid token please try again');
       }
    }
}