<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\users;
use App\Models\patient;
use Illuminate\Support\Facades\DB;

class dashboardcontroller extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
    public function profile()
    {
        $userid = Session::get('userid');
        $users = users::where('userid', $userid)
            ->get()
            ->first();
        return view('profile', ['users' => $users]);
    }
    public function changeprofile(Request $request)
    {
        $data = [
            'username' => $request->username,
            'useremail' => $request->useremail,
            'usernric' => $request->usernric1 . $request->usernric2 . $request->usernric3,
            'useraddress' => $request->useraddress,
        ];
        $userid = Session::get('userid');
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
        return view('listpatient', ['formtbl' => $formtbl]);
    }
    public function change()
    {
        return view('changepassword');
    }
    public function changepassword(Request $request)
    {
        $rules = [
            'useroldpassword' => 'required',
            'userpassword' => 'required',
            'userrepassword' => 'required',
        ];
        $messages = [
            'required' => 'diperlukan',
        ];
        $validator = $request->validate($rules, $messages);
        $data = $request->input();
        $userid = Session::get('userid');
        $users = users::where('userid', $userid)
            ->get()
            ->first();
        if (password_verify($data['useroldpassword'], $users->userpassword)) {
            if (password_verify($data['userpassword'], $users->userpassword)) {
                return redirect()
                    ->back()
                    ->with('fails', 'Your new password cannot be same as you current password');
            } else {
                if ($data['userpassword'] == $data['userrepassword']) {
                    $data2 = [
                        'userpassword' => password_hash($request->userpassword, PASSWORD_DEFAULT),
                    ];
                    $userid = Session::get('userid');
                    $users = users::where('userid', $userid);
                    $users->update($data2);
                       return redirect('/dashboard')->with('message', 'You have successfully change password account.');
                } else {
                    return redirect()
                        ->back()
                        ->with('fails', 'Password did not match');
                }
            }
        } else {
            return redirect()
                ->back()
                ->with('fails', 'Try again,that is not your current password');
        }
    }
    public function patientregister(Request $request)
    {
    $patientname = $request->patientname;
	$patientnric = $request->patientnric1.$request->patientnric2.$request->patientnric3;
    $patientaddress = $request->patientaddress;
	$patientgender = $request->patientgender;
	if(isset($request->patientcontact))
		$patientcontact = $request->patientcontact;
	else
		$patientcontact = '';
	$patientrace = $request->patientrace;
	$patientage = $request->patientage;
	
	if(isset($request->patientweight))
		$patientweight = $request->patientweight;
	else
		$patientweight = '0.0';
	if(isset($request->patientheight))
		$patientheight = $request->patientheight;
	else
		$patientheight = '0.0';
	if(isset($request->patientwaist))
		$patientwaist = $request->patientwaist;
	else
		$patientwaist = '0.0';
	
	// Second Question
	$curSmoking = $request->curSmoking;
	if(isset($request->exSmoker))
		$exSmoker = $request->exSmoker;
	else
		$exSmoker = "";
	if(isset($request->avgSticks))
		$avgSticks = $request->avgSticks;
	else
		$avgSticks = '0';
	if(isset($request->smokeMonth))
		$smokeMonth = $request->smokeMonth;
	else
		$smokeMonth = '0';
	if(isset($request->smokeYear))
		$smokeYear = $request->smokeYear;
	else
		$smokeYear = '0';

	$diabetes = $request->diabetes;
	if(isset($request->proteinura))
		$proteinura = $request->proteinura;
	else
		$proteinura = '0';
	if(isset($request->tod))
		$tod = $request->tod;
	else
		$tod = '0';
	$diabeticMed = $request->diabeticMed;
	$fastPlasma = $request->fastPlasma;
	$randomPlasma = $request->randomPlasma;

	$lpa = $request->lpa;
	if($lpa == 'yes')
		$lpav = $request->lpav;
	else
		$lpav = '0.0';
	
	$systol = $request->systol;
	$dystol = $request->dystol;
	$treat = $request->treat;
	$ascvd = $request->ascvd;
	$ckd = $request->ckd;
	
	//Third Question
	$tclevel = $request->tclevel;
	$ldlclevel = $request->ldlclevel;
	$tglevel = $request->tglevel;
	$hdlclevel = $request->hdlclevel;

	//Third Question
	$chdRela = $request->chdRela;
	if($chdRela == 'yes'){
		$genderRela = $request->genderRela;
		$ageRela = $request->ageRela;
	}else{
		$genderRela = '0';
		$ageRela = '0';
	}
	
	$submitdate = date("Y-m-d");
	
	
	
	//Count Major Risks
	$totMRF = 0;
	if($curSmoking == 'yes') $totMRF++;
	if(($systol >= 140 || $dystol >= 90) || $treat == "yes") $totMRF++;
	if($chdRela == 'yes') 
		if(($genderRela == 1 && $ageRela < 55) || ($genderRela == 2 && $ageRela < 65)) $totMRF++;
	if(($patientgender==1 && $hdlclevel < 1.0) || ($patientgender==2 && $hdlclevel < 1.3)) $totMRF++;
	if(($patientgender==1 && $patientage >= 45) || ($patientgender==2 && $patientage >= 55)) $totMRF;
	
	$CRFResult = "";
	
	if($ascvd == 'yes'){
		$CRFResult = "Very High";
	}else{
		if(($diabetes == 'yes') || ($fastPlasma >= 7.0 || $randomPlasma >= 11.1)){
			if($tod == 'yes' || $totMRF == 1){
				$CRFResult = "Very High";
			}else{
				if($ckd == 'severe'){
					$CRFResult = "Very High";
				}else{
					$CRFResult = "High";
				}
			}
		}else{
			if($ckd == 'severe'){
				$CRFResult = "Very High";
			}elseif($ckd == 'moderate'){
				$CRFResult = "High";
			}else{
				if(($tclevel > 8 || $ldlclevel > 4.9) || ($systol >= 180 || $dystol >= 110)){
					$CRFResult = "High";
				}else{
					$risk = 0.0;
					if($totMRF <= 1){
						$CRFResult = "Low";
					}else{
						$FraminghamScore = 0;
						if($patientgender==1){
							//Framingham Assesment for men
							if($patientage >= 30 && $patientage <= 34) $FraminghamScore += 0;
							elseif($patientage >= 35 && $patientage <= 39) $FraminghamScore += 2;
							elseif($patientage >= 40 && $patientage <= 44) $FraminghamScore += 5;
							elseif($patientage >= 45 && $patientage <= 49) $FraminghamScore += 6;
							elseif($patientage >= 50 && $patientage <= 54) $FraminghamScore += 8;
							elseif($patientage >= 55 && $patientage <= 59) $FraminghamScore += 10;
							elseif($patientage >= 60 && $patientage <= 64) $FraminghamScore += 11;
							elseif($patientage >= 65 && $patientage <= 69) $FraminghamScore += 12;
							elseif($patientage >= 70 && $patientage <= 74) $FraminghamScore += 14;
							elseif($patientage >= 75) $FraminghamScore += 15;
							else $FraminghamScore += 0;
							
							if($hdlclevel >= 60) $FraminghamScore += -2;
							elseif($hdlclevel >= 50 && $hdlclevel <= 59) $FraminghamScore += -1;
							elseif($hdlclevel >= 45 && $hdlclevel <= 49) $FraminghamScore += 0;
							elseif($hdlclevel >= 35 && $hdlclevel <= 44) $FraminghamScore += 1;
							else $FraminghamScore += 2;
							
							if($tclevel < 160) $FraminghamScore += 0;
							if($tclevel >= 160 && $tclevel <= 199) $FraminghamScore += 1;
							if($tclevel >= 200 && $tclevel <= 239) $FraminghamScore += 2;
							if($tclevel >= 240 && $tclevel <= 279) $FraminghamScore += 3;
							else $FraminghamScore += 4;
							
							if($treat == 'yes'){
								if($systol < 120) $FraminghamScore += 0;
								elseif($systol >= 120 && $systol <= 129) $FraminghamScore += 2;
								elseif($systol >= 130 && $systol <= 139) $FraminghamScore += 3;
								elseif($systol >= 140 && $systol <= 159) $FraminghamScore += 4;
								else $FraminghamScore += 5;
							}elseif($treat == 'no'){
								if($systol < 120) $FraminghamScore += -2;
								elseif($systol >= 120 && $systol <= 129) $FraminghamScore += 0;
								elseif($systol >= 130 && $systol <= 139) $FraminghamScore += 1;
								elseif($systol >= 140 && $systol <= 159) $FraminghamScore += 2;
								else $FraminghamScore += 3;
							}
							
							if($curSmoking == 'yes') $FraminghamScore += 4;
							else{
								if($exSmoker == 'yes') $FraminghamScore += 4;
								else $FraminghamScore += 0;
							}
							
							if($FraminghamScore <= -3) $risk = 1.0;
							elseif($FraminghamScore == -2) $risk = 1.1;
							elseif($FraminghamScore == -1) $risk = 1.4;
							elseif($FraminghamScore == 0) $risk = 1.6;
							elseif($FraminghamScore == 1) $risk = 1.9;
							elseif($FraminghamScore == 2) $risk = 2.3;
							elseif($FraminghamScore == 3) $risk = 2.8;
							elseif($FraminghamScore == 4) $risk = 3.3;
							elseif($FraminghamScore == 5) $risk = 3.9;
							elseif($FraminghamScore == 6) $risk = 4.7;
							elseif($FraminghamScore == 7) $risk = 5.6;
							elseif($FraminghamScore == 8) $risk = 6.7;
							elseif($FraminghamScore == 9) $risk = 7.9;
							elseif($FraminghamScore == 10) $risk = 9.4;
							elseif($FraminghamScore == 11) $risk = 11.2;
							elseif($FraminghamScore == 12) $risk = 13.2;
							elseif($FraminghamScore == 13) $risk = 15.6;
							elseif($FraminghamScore == 14) $risk = 18.4;
							elseif($FraminghamScore == 15) $risk = 21.6;
							elseif($FraminghamScore == 16) $risk = 25.3;
							elseif($FraminghamScore == 17) $risk = 29.4;
							else $risk = 30.0;
						}else{
							//Framingham Assesment for women
							if($patientage >= 30 && $patientage <= 34) $FraminghamScore += 0;
							elseif($patientage >= 35 && $patientage <= 39) $FraminghamScore += 2;
							elseif($patientage >= 40 && $patientage <= 44) $FraminghamScore += 4;
							elseif($patientage >= 45 && $patientage <= 49) $FraminghamScore += 5;
							elseif($patientage >= 50 && $patientage <= 54) $FraminghamScore += 7;
							elseif($patientage >= 55 && $patientage <= 59) $FraminghamScore += 8;
							elseif($patientage >= 60 && $patientage <= 64) $FraminghamScore += 9;
							elseif($patientage >= 65 && $patientage <= 69) $FraminghamScore += 10;
							elseif($patientage >= 70 && $patientage <= 74) $FraminghamScore += 11;
							elseif($patientage >= 75) $FraminghamScore += 12;
							else $FraminghamScore += 0;
							
							if($hdlclevel >= 60) $FraminghamScore += -2;
							elseif($hdlclevel >= 50 && $hdlclevel <= 59) $FraminghamScore += -1;
							elseif($hdlclevel >= 45 && $hdlclevel <= 49) $FraminghamScore += 0;
							elseif($hdlclevel >= 35 && $hdlclevel <= 44) $FraminghamScore += 1;
							else $FraminghamScore += 2;
							
							if($tclevel < 160) $FraminghamScore += 0;
							if($tclevel >= 160 && $tclevel <= 199) $FraminghamScore += 1;
							if($tclevel >= 200 && $tclevel <= 239) $FraminghamScore += 3;
							if($tclevel >= 240 && $tclevel <= 279) $FraminghamScore += 4;
							else $FraminghamScore += 5;
							
							if($treat == 'yes'){
								if($systol < 120) $FraminghamScore += -1;
								elseif($systol >= 120 && $systol <= 129) $FraminghamScore += 2;
								elseif($systol >= 130 && $systol <= 139) $FraminghamScore += 3;
								elseif($systol >= 140 && $systol <= 149) $FraminghamScore += 5;
								elseif($systol >= 150 && $systol <= 159) $FraminghamScore += 6;
								else $FraminghamScore += 7;
							}elseif($treat == 'no'){
								if($systol < 120) $FraminghamScore += -3;
								elseif($systol >= 120 && $systol <= 129) $FraminghamScore += 0;
								elseif($systol >= 130 && $systol <= 139) $FraminghamScore += 1;
								elseif($systol >= 140 && $systol <= 149) $FraminghamScore += 2;
								elseif($systol >= 150 && $systol <= 159) $FraminghamScore += 4;
								else $FraminghamScore += 5;
							}
							
							if($curSmoking == 'yes') $FraminghamScore += 3;
							else{
								if($exSmoker == 'yes') $FraminghamScore += 3;
								else $FraminghamScore += 0;
							}
							
							if($FraminghamScore <= -1) $risk = 1.0;
							elseif($FraminghamScore == 0) $risk = 1.2;
							elseif($FraminghamScore == 1) $risk = 1.5;
							elseif($FraminghamScore == 2) $risk = 1.7;
							elseif($FraminghamScore == 3) $risk = 2.0;
							elseif($FraminghamScore == 4) $risk = 2.4;
							elseif($FraminghamScore == 5) $risk = 2.8;
							elseif($FraminghamScore == 6) $risk = 3.3;
							elseif($FraminghamScore == 7) $risk = 3.9;
							elseif($FraminghamScore == 8) $risk = 4.5;
							elseif($FraminghamScore == 9) $risk = 5.3;
							elseif($FraminghamScore == 10) $risk = 6.3;
							elseif($FraminghamScore == 11) $risk = 7.3;
							elseif($FraminghamScore == 12) $risk = 8.6;
							elseif($FraminghamScore == 13) $risk = 10.0;
							elseif($FraminghamScore == 14) $risk = 11.7;
							elseif($FraminghamScore == 15) $risk = 13.7;
							elseif($FraminghamScore == 16) $risk = 15.9;
							elseif($FraminghamScore == 17) $risk = 18.5;
							elseif($FraminghamScore == 18) $risk = 21.5;
							elseif($FraminghamScore == 19) $risk = 24.8;
							elseif($FraminghamScore == 20) $risk = 28.5;
							else $risk = 30.0;
						}
					}
					
					if($risk > 20.0 && $totMRF >= 2) $CRFResult = 'High';
					elseif(($risk >= 10.0 && $risk <= 20.0) && $totMRF >= 2) $CRFResult = 'Moderate';
					else $CRFResult = 'Low';
				}
			}
		}
	}
	$userid = Session::get('userid');
    $data = [
        "userid"=> $userid,
        "patientname"=> $patientname,
        "patientnric"=> $patientnric,
        "patientaddress"=>$patientaddress,
        "patientgender"=>$patientgender,
        "patientcontact"=>$patientcontact,
        "patientrace"=>$patientrace,
        "patientage"=>$patientage,
        "patientweight"=>$patientweight,
        "patientheight"=> $patientheight, 
        "patientwaist"=>$patientwaist,
        "curSmoking"=>$curSmoking, 
        "exSmoker"=> $exSmoker,
        "avgSticks"=> $avgSticks,
        "smokeMonth"=>$smokeMonth,
        "smokeYear"=>$smokeYear,
        "diabetes"=>$diabetes,
        "proteinura"=>$proteinura, 
        "tod"=>$tod, 
        "diabeticMed"=>$diabeticMed,
        "fastPlasma"=>$fastPlasma,
        "randomPlasma"=> $randomPlasma, 
        "lpa"=> $lpa,
        "lpav"=>$lpav,
        "systol"=>$systol,
        "dystol"=>$dystol,
        "treat"=>$treat,
        "ascvd"=>$ascvd,
        "ckd"=> $ckd,
        "tclevel"=>$tclevel,
        "ldlclevel"=> $ldlclevel,
        "tglevel"=>$tglevel, 
        "hdlclevel"=>$hdlclevel,
        "chdRela"=> $chdRela,
        "genderRela"=> $genderRela,
        "ageRela"=>$ageRela, 
        "submitdate"=>$submitdate,
        "CRFResult"=>$CRFResult,
    ];
   DB::table('formtbl')->insert($data);
      return redirect('/dashboard')->with('message', 'You have successfully register new patient.');
    }
}