@extends('layouts.app')

@section('title','Dashboard | FRSCVD')
@section('subtitle',"Cardiovascular Risk Assessment")
@section('content')
@section('formjs')
<script>
    $(document).ready(function(){
        $("input[name='patientage']").on('change', function(){
            if($(this).val() == 0) {
                $(this).val("");
            }
        });
        
        $("input[name='curSmoking']").on('change', function(){
            if($(this).val() == 'yes') {
                $("#noSmoking").hide();
                $("input[name='exSmoker']").prop("required",false);
                $("#yesSmoking").show();
                $("input[name='exSmoker']").prop("checked",false);
                $("#avgSticks").val("");
                $("#avgSticks").prop("required",true);
                $("#smokeMonth").val("");
                $("#smokeMonth").prop("required",true);
                $("#smokeYear").val("");
                $("#smokeYear").prop("required",true);
            }else if($(this).val() == 'no'){
                $("#noSmoking").show();
                $("input[name='exSmoker']").prop("required",true);
                $("#yesSmoking").hide();
                $("input[name='exSmoker']").prop("checked",false);
                $("#avgSticks").val("");
                $("#avgSticks").prop("required",false);
                $("#smokeMonth").val("");
                $("#smokeMonth").prop("required",false);
                $("#smokeYear").val("");
                $("#smokeYear").prop("required",false);
            }
        });
                
        $("input[name='exSmoker']").on('change', function(){
            if($(this).val() == 'yes') {
                $("#yesSmoking").show();
                $("#avgSticks").val("");
                $("#avgSticks").prop("required",true);
                $("#smokeMonth").val("");
                $("#smokeMonth").prop("required",true);
                $("#smokeYear").val("");
                $("#smokeYear").prop("required",true);
            }else if($(this).val() == 'no'){
                $("#yesSmoking").hide();
                $("#avgSticks").val("");
                $("#avgSticks").prop("required",false);
                $("#smokeMonth").val("");
                $("#smokeMonth").prop("required",false);
                $("#smokeYear").val("");
                $("#smokeYear").prop("required",false);
            }
        });
        
        $("input[name='smokeMonth']").on('change', function(){
            if($("#smokeYear").val() == '' || $("#smokeYear").val() == '0'){
                $("#smokeYear").val("0");
                if($("#smokeMonth").val() == '0' || $("#smokeMonth").val() == '')
                    $("#smokeMonth").val("1");
            }
        });
        
        $("input[name='smokeYear']").on('change', function(){
            if($("#smokeYear").val() == '0' || $("#smokeYear").val() == ''){
                $("#smokeMonth").val("1");
                $("#smokeYear").val("0");
            }else if($("#smokeMonth").val() == '0' || $("#smokeMonth").val() == '')
                $("#smokeMonth").val("0");
        });
                
        $("input[name='diabetes']").on('change', function(){
            if($(this).val() == 'yes') {
                $("#yesDiabetes").show();
                $("#proteinura").prop("checked",false);
                $("#tod").prop("checked",false);
            }else if($(this).val() == 'no'){
                $("#yesDiabetes").hide();
                $("#proteinura").prop("checked",false);
                $("#tod").prop("checked",false);
            }
        });
        
        $("input[name='diabeticMed']").on('change', function(){
            if($(this).val() == 'yes') {
                $("input[name='diabetes']").filter('[value=yes]').prop("checked", true);
                $("#yesDiabetes").show();
                $("#proteinura").prop("checked",false);
                $("#tod").prop("checked",false);
                $("input[name='diabetes']").prop( "readonly", true);
            }else if($(this).val() == 'no'){
                $("input[name='diabetes']").prop( "readonly", false);
            }
        });
        
        $("input[name='fastPlasma']").on('change', function(){
            if($(this).val() > 0.0) {
                $("#randomPlasma").val("0.0");
                $("#randomPlasma").prop( "readonly", true);
            }else if($(this).val() == 0){
                $(this).val("0.0");
                $("#randomPlasma").prop( "readonly", false);
            }
        });
        
        $("input[name='randomPlasma']").on('change', function(){
            if($(this).val() > 0.0) {
                $("#fastPlasma").val("0.0");
                $("#fastPlasma").prop("readonly", true);
            }else if($(this).val() == 0){
                $(this).val("0.0");
                $("#fastPlasma").prop("readonly", false);
            }
        });
        
        $("input[name='lpa']").on('change', function(){
            if($(this).val() == 'yes') {
                $("#yeslpa").show();
                $("#lpav").prop("required",true);
                $("#lpav").val("0.0");
                $("#lpav").prop("disabled", false);
            }else if($(this).val() == 'no'){
                $("#yeslpa").hide();
                $("#lpav").prop("required",false);
                $("#lpav").val("0.0");
                $("#lpav").prop("disabled", true);
            }
        });
        
        $("#lpav").on('change', function(){
            if(($(this).val() == 90) || ($(this).val() == 0)) {
                $(this).val("90.0");
            }
        });
        
        $("#systol").on('change', function(){
            if($(this).val() == 0) {
                $(this).val("0.0");
            }
        });
        
        $("#dystol").on('change', function(){
            if($(this).val() == 0) {
                $(this).val("0.0");
            }
        });
        
        $("input[name='chdRela']").on('change', function(){
            if($(this).val() == 'yes') {
                $("#yesRela").show();
                $("#ageRela").val("");
                $("input[name='genderRela']").prop("checked",false);
                $("input[name='ageRela']").prop("required",true);
                $("input[name='genderRela']").prop("required",true);
                $("input[name='genderRela']").prop("disabled", false);
                $("input[name='ageRela']").prop("disabled", false);
            }else if($(this).val() == 'no'){
                $("#yesRela").hide();
                $("#ageRela").val("");
                $("input[name='genderRela']").prop("checked",false);
                $("input[name='ageRela']").prop("required",false);
                $("input[name='genderRela']").prop("required",false);
                $("input[name='genderRela']").prop("disabled", true);
                $("input[name='ageRela']").prop("disabled", true);
            }
        });
        
        $("input[name='ageRela']").on('change', function(){
            if($(this).val() == 0) {
                $(this).val("");
            }
        });
    });
</script>
@endsection
<style>
    .col-custom2{
    
       width: auto;
        padding: 30px 20px 20px 20px;
    border-radius: 30px;
    margin: 30px auto;
    background-color: #ffffff;
    }
</style>

<form id="chdr-form" name="chdr-form" autocomplete="off" method="post" action="{{URL::to('patientregister')}}">
    @csrf
        <div class="col-custom2 boxShadow-top form-group">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <p class="txt-title2">1. Personal Information</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" value="" class="form-control" name="patientname" id="patientname" placeholder="Name *"  required>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="row">
                        <div class="col-md-3 col-3 col-form-label">
                            <label>Gender*:</label>
                        </div>
                        <label class="but-radio"><input type="radio" value="1" name="patientgender" id="patientgender" required >Male<span class="checkmark"></span></label>
                        <label class="but-radio"><input type="radio" value="2" name="patientgender" id="patientgender"  >Female<span class="checkmark"></span></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="row">
                        <div class="col-4 mb-3">
                            <input type="text" value="" class="form-control" name="patientnric1" id="patientnric1" pattern="[0-9]{6}" title="First 6 digits" maxlength="6" placeholder="000000"  required>
                        </div>
                        <div class="col-4 mb-3 ">
                            <input type="text" value="" class="form-control" name="patientnric2" id="patientnric2" pattern="[0-9]{2}" title="2 Digits" maxlength="2" placeholder="00"  required>
                        </div>
                        <div class="col-4 mb-3 ">
                            <input type="text" value="" class="form-control" name="patientnric3" id="patientnric3" pattern="[0-9]{4}" title="4 Last Digits" maxlength="4" placeholder="0000" required>
                        </div>
                    </div>
                    <small class="text-muted"><strong>Note:</strong> If you don’t know the NRIC, at least put the first two digits of NRIC (year) and types zeros for others. E.g: (930000-00-0000).</small>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" name="patientcontact" id="patientcontact" placeholder="Mobile Number (01X-XXXXXXXX)" pattern="[0-9]{3}-[0-9]{7,}" value="" title="Enter digits mobile number" maxlength="12">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <select name="patientrace" id="patientrace" class="form-control" required>
                        <option selected disabled hidden>Race</option>
                    <?php 
                        $array_race = ["MALAY","CHINESE","INDIAN","ORANG ASLI","BIDAYUH","IBAN","OTHERS","DUSUN","BAJAU","KADAZAN","SULUK","BANJAR","BUGIS","NON-MALAYSIAN"];
                        for ($i = 0; $i < sizeof($array_race); $i++) { ?>
                            <option value="<?php echo $array_race[$i]; ?>"  ><?php echo $array_race[$i]; ?></option>
                            <?php
                        }
                    ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="number" step="1" class="form-control" name="patientage" id="patientage" placeholder="Age *" min="0" value="" required>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <input type="text" value="" class="form-control" name="patientaddress" id="patientaddress"  placeholder="Current Address *"  title="Current address" required>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">					
                    <input type="number" step="0.1" class="form-control" name="patientheight" id="patientheight"  placeholder="Height (cm)" min="0" value="">
                </div>
                <div class="col-md-4 mb-3">	
                    <input type="number" step="0.1" class="form-control" name="patientweight" id="patientweight"  placeholder="Weight (kg)" min="0" value="">
                </div>
                <div class="col-md-4 mb-3">
                    <input type="number" step="0.1" class="form-control" name="patientwaist" id="patientwaist"  placeholder="Waist circumference (cm)" min="0" value="">
                </div>
            </div>
                         <!-- finish first question -->
            <hr class="mb-3">
            <div class="row">
                <div class="col-md-5 mb-3">
                  <p class="txt-title2">2. Coronary Risk Factors</p>
                </div>
            </div>			 
            <div class="row">
                <div class="col-md-12 mb-3 ">
                    <div class="but-radio-group mb-3">
                        <label class="col col-form-label">Current Smoker * <i class="fa fa-info-circle" aria-hidden="true" title="Active smoker in pass a month"></i></label> 				
                        <div class="col form-group mb-3 row">
                            <div class="col-4 mb-3">
                                <label class="but-radio">Yes<input type="radio" value="yes" name="curSmoking" id="curSmoking" required  ><span class="checkmark"></span></label>
                            </div>
                            <div class="col-4 mb-3">
                                <label class="but-radio">No<input type="radio" value="no" name="curSmoking" id="curSmoking" ><span class="checkmark"></span></label>
                            </div>
                        </div>		
                        <div class="col form-group mb-3 row" id="noSmoking" style="display:none;" > 
                            <div class="col-4 mb-3">
                                <label class="but-radio"> Ex Smoker <input type="radio" value="yes" name="exSmoker" id="exSmoker"  ><span class="checkmark"></span></label>
                            </div>
                            <div class="col-4 mb-3">
                                <label class="but-radio"> Never Smoked <input type="radio" value="no" name="exSmoker" id="exSmoker" ><span class="checkmark"></span></label>
                            </div>
                        </div>
                        <div id="yesSmoking" style="display:none;" >
                            <div class="col form-group mb-3 row">
                                <label class="col-4 mb-3">Average sticks per day *</label>
                                <div class="col mb-3">
                                    <input type="number" step="1" value="" class="form-control" name="avgSticks" id="avgSticks"  placeholder="Number of sticks per day" min="1">
                                </div>
                            </div>
                            <div class="col form-group mb-3 row">
                                <label class="col mb-3">Duration of active smoking*</label>
                                <div class="col mb-3">
                                    <input type="number" step="1" value="" class="form-control" name="smokeMonth" id="smokeMonth" min="0" placeholder="Month(s)">
                                </div>
                                <div class="col mb-3">
                                    <input type="number" step="1" value="" class="form-control" name="smokeYear" id="smokeYear" min="0" placeholder="Year(s)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="but-radio-group mb-3">
                        <label class="col col-form-label">Diabetes * <i class="fa fa-info-circle" aria-hidden="true" title="Previously confirmed by doctor"></i></label>
                        <div class="col form-group mb-3 row">
                            <div class="col-4 mb-3">
                                <label class="but-radio">Yes<input type="radio" value="yes" name="diabetes" required ><span class="checkmark"></span></label>
                            </div>
                            <div class="col-4 mb-3">
                                <label class="but-radio">No<input type="radio" value="no" name="diabetes"  ><span class="checkmark"></span></label>
                            </div>
                        </div>
                        <div class="col form-group mb-3 row">
                            <div class="col-md-6 mb-3">                            
                                Fasting plasma glucose (mmol/L)
                                <input class="col-md-6" type="number" step="0.1" value="" class="form-control" name="fastPlasma" id="fastPlasma" min="0.0">
                            </div>
                            <div class="col-md-6 mb-3">
                                Random plasma glucose (mmol/L)
                                <input class="col-md-6" type="number" step="0.1" value="" class="form-control" name="randomPlasma" id="randomPlasma" min="0.0">
                            </div>
                        </div>
                        <div class="but-radio-group mb-3">
                            <label class="col col-form-label">Are you on antidiabetic medication? *</label>
                            <div class="col form-group mb-3 row">
                                <div class="col-4 mb-3">
                                    <label class="but-radio">Yes<input type="radio" value="yes" name="diabeticMed" required  ><span class="checkmark"></span></label>
                                </div>
                                <div class="col-4 mb-3">
                                    <label class="but-radio">No<input type="radio" value="no" name="diabeticMed"  ><span class="checkmark"></span></label>
                                </div>
                            </div>
                        </div>
                        <div id="yesDiabetes"  style="display:none;">
                            <div class="col form-group mb-3 row">
                                <div class="col-4 mb-3">
                                    <input type="checkbox" value="yes" name="proteinura" id="proteinura" > Proteinura
                                </div>						   
                                <div class="col-4 mb-3">
                                    <input type="checkbox" value="yes" name="tod" id="tod"  > Target organ damage
                                </div>
                            </div>
                        </div>
                    </div>							
                    <div class="but-radio-group mb-3">
                        <label class="col col-form-label">Lp(a) *</label>
                        <div class="col form-group mb-3 row">
                            <div class="col-4 mb-3">
                                <label class="but-radio">Yes<input type="radio" value="yes" name="lpa" id="lpa" required ><span class="checkmark"></span></label>
                            </div>
                            <div class="col-4 mb-3">
                                <label class="but-radio">No<input type="radio" value="no" name="lpa" id="lpa" ><span class="checkmark"></span></label>
                            </div>
                        </div>
                        <div id="yeslpa" class="col form-group mb-3 row"  style="display:none;">
                            <div class="col-4 mb-3">
                                <label>Lp(a) nmol/L <i class="fa fa-info-circle" aria-hidden="true" title="Value must be between 90-200"></i></label>
                                <input type="number" step="0.1" class="form-control" value="" name="lpav" id="lpav">
                            </div>
                        </div>		
                    </div>												
                    <div class="but-radio-group mb-3">
                        <label class="col col-form-label">On Antihypertensive Medication? *</label>
                        <div class="col form-group mb-3 row">
                            <div class="col-4 mb-3">
                                <label class="but-radio">Yes<input type="radio" value="yes" name="treat" required><span class="checkmark"></span></label>
                            </div>
                            <div class="col-4 mb-3">
                                <label class="but-radio">No<input type="radio" value="no" name="treat" ><span class="checkmark"></span></label>
                            </div>					   
                        </div>
                        <div class="col form-group mb-3 row">
                            <div class="col-md-6 mb-3">                            
                                Systolic Blood Pressure (mm Hg) *
                                <input class="col-md-6" type="number" step="0.1" value="" class="form-control" name="systol" id="systol" min="0.0" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                Dystolic Blood Pressure (mm Hg) *
                                <input class="col-md-6" type="number" step="0.1" value="" class="form-control" name="dystol" id="dystol" min="0.0" required>
                            </div>
                        </div>
                    </div>
                    <div class="but-radio-group mb-3">
                        <label class="col col-form-label">History of Atherosclerotic Cardiovascular Disease (ASCVD) *</label>
                        <div class="col form-group mb-3 row">
                            <div class="col-4 mb-3">
                                <label class="but-radio">Yes<input type="radio" value="yes" name="ascvd" required  ><span class="checkmark"></span></label>
                            </div>
                            <div class="col-4 mb-3">
                                <label class="but-radio">No<input type="radio" value="no" name="ascvd" ><span class="checkmark"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="but-radio-group mb-3">
                        <label class="col col-form-label">Chronic Kidney Disease (CKD) *</label>
                        <div class="col form-group mb-3 row">
                            <div class="col-md-6 mb-3">
                                <label class="but-radio">Moderate<br>(GFR 30-59 mL/min/1.73 m&sup2;) <input type="radio" value="moderate" name="ckd"  ><span class="checkmark"></span></label>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="but-radio">No <input type="radio" value="no" name="ckd" required  ><span class="checkmark"></span></label>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="but-radio">Severe (GFR &lt;30 mL/min/1.73 m&sup2;) <input type="radio" value="severe" name="ckd" ><span class="checkmark"></span></label>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="but-radio">Unknown <input type="radio" value="unknown" name="ckd" ><span class="checkmark"></span></label>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-3">
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <p class="txt-title2">3. Lipid Profile (Baseline)</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="but-radio-group mb-3">
                                <div class="col form-group mb-3 row">
                                    <div class="col-md-6 mb-3">                            
                                        <label class="col col-form-label">TC levels (mmol/L)</label>
                                        <input class="col-md-6" type="number" step="0.1" value="" class="form-control" name="tclevel" id="tclevel" min="0.0">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="col col-form-label">LDL-C levels (mmol/L)</label>
                                        <input class="col-md-6" type="number" step="0.1" value="" class="form-control" name="ldlclevel" id="ldlclevel" min="0.0">
                                    </div>
                                </div>	
                                <div class="col form-group mb-3 row">
                                    <div class="col-md-6 mb-3">                            
                                        <label class="col col-form-label">TG levels (mmol/L)</label>
                                        <input class="col-md-6" type="number" step="0.1" value="" class="form-control" name="tglevel" id="tglevel" min="0.0">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="col col-form-label">HDL-C levels (mmol/L)</label>
                                        <input class="col-md-6" type="number" step="0.1" value="" class="form-control" name="hdlclevel" id="hdlclevel" min="0.0">
                                    </div>
                                </div>	
                            </div>
                        </div>
                    </div>
                    <hr class="mb-3">
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <p class="txt-title2">4. Family History</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="but-radio-group mb-3">
                                <label class="col col-form-label">Premature CHD in First Degree Relative? * <i class="fa fa-info-circle" aria-hidden="true" title="Parent, Sibling, and Child"></i></label>
                                <div class="col form-group mb-3 row">
                                    <div class="col-4 mb-3">
                                        <label class="but-radio">Yes<input type="radio" value="yes" name="chdRela" required><span class="checkmark"></span></label>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label class="but-radio">No<input type="radio" value="no" name="chdRela" ><span class="checkmark"></span></label>
                                    </div>
                                </div>
                                <div id="yesRela" style="display:none;">
                                    <label class="col col-form-label">Gender *</label>
                                    <div class="col form-group mb-3 row">
                                        <div class="col-4 mb-3">
                                            <label class="but-radio">Male<input type="radio" value="1" name="genderRela" ><span class="checkmark"></span></label>
                                        </div>
                                        <div class="col-4 mb-3">
                                            <label class="but-radio">Female<input type="radio" value="2" name="genderRela"  ><span class="checkmark"></span></label>
                                        </div>
                                    </div>
                                    <div class="col form-group mb-3 row">
                                        <div class="col-6 mb-3">
                                            <input type="number" step="1" class="form-control" name="ageRela" id="ageRela"  placeholder="Age *" min="1" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted"><strong>Note:</strong> * indicates required field.</small>
                        </div>
                    </div>
                    <hr class="mb-3">						
                    <div class="row">
                        <div class="col-md-1 col-2">
                            <button type="button" onClick="window.location.href='dashboard.php'" class="btn-outline-info but-custom2"><i class="fa fa-long-arrow-left fa-lg"></i></button>
                        </div>
                        <div class="col-md-5 col-10">
                            <button type="submit" class="btn-info btn-block but-color-none">Submit<i class="fa fa-paper-plane fa-lg" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
</form>
<script>
     var age = 0;		
		   var nic = document.getElementById('patientnric1');
		   nic.addEventListener('change', function(e) {
   var dob = nic.value;
    var nricyear = dob.substr(0, 2);  // 85
   
     var dt = new Date();
    //var year = document.getElementById("patientyearoffirstseen");
    var year = dt.getFullYear();
 if (nricyear > 19) {    
   
var        nricage = parseInt(dt.getYear()) - nricyear;
    }
    else {
  
      var  nricage = 1900 + parseInt(dt.getYear()) - 2000 - parseInt(nricyear);
    }
    document.getElementById("patientage").value = nricage; 
</script>

@endsection


