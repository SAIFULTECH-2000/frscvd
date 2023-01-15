@extends('layouts.app')

@section('title','Dashboard | FRSCVD')
@section('subtitle',"Edit your profile here")
<style scoped> .pagination { justify-content: center!important; } </style>
@section('content2')
<div class="content container content-wrapper2">
    <div class="col-custom2 boxShadow-top form-group">
        <p style="color:#BE1E2D;font-weight: bold;font-size: 17px;text-align: center;">Summary of Patients (Within Last 5 Years)</p>
        <div class="table-responsive">
            <table>
            <?php
                $curYear = date('Y');
            ?>
                <tr style="text-align:center;">
                    <th colspan="2"><p style="color:#BE1E2D;font-size: 17px;"><?php echo $curYear; ?></p></th>
                    <th colspan="2"><p style="color:#BE1E2D;font-size: 17px;"><?php echo $curYear - 1; ?></p></th>
                    <th colspan="2"><p style="color:#BE1E2D;font-size: 17px;"><?php echo $curYear - 2; ?></p></th>
                    <th colspan="2"><p style="color:#BE1E2D;font-size: 17px;"><?php echo $curYear - 3; ?></p></th>
                    <th colspan="2"><p style="color:#BE1E2D;font-size: 17px;"><?php echo $curYear - 4; ?></p></th>
                </tr>
                <tr>

                    @php 
            $row=  DB::table('formtbl')->select(DB::raw("COUNT(*) AS Total, CONCAT(ROUND(((COUNT(*) / (SELECT COUNT(*) FROM formtbl)) * 100),0),'%') AS Percentage, year(submitdate) AS Year"))->whereRaw("(year(submitdate) >= 2023 - 4 AND year(submitdate) <= 2023) AND CRFResult = 'Low'")->groupBy('Year')->first()


                    @endphp
                
                    <?php
                        
                        for($i = 0; $i < 5; $i++){
                            if($curYear - 0 == $row->Year){
                                $total = $row->Total;
                                $percentage = $row->Percentage;
                                ?>
                                    <td>
                                        <p style="color:green;font-weight: normal;">Low:</p>
                                    </td>
                                    <td>
                                        <p style="color:black;min-width:150px;">&nbsp;&nbsp;<?php echo $total; ?> Patients (<?php echo $percentage; ?>)</strong></p>
                                    </td>
                                <?php
                               
                            }else{
                                ?>
                                    <td>
                                        <p style="color:green;font-weight: normal;">Low:</p>
                                    </td>
                                    <td>
                                        <p style="color:black;min-width:150px;">&nbsp;&nbsp;0 Patients </strong></p>
                                    </td>
                                <?php
                            }
                        }
                    ?>
                </tr>
                <tr>
                    @php 
                    $row=  DB::table('formtbl')->select(DB::raw("COUNT(*) AS Total, CONCAT(ROUND(((COUNT(*) / (SELECT COUNT(*) FROM formtbl)) * 100),0),'%') AS Percentage, YEAR(submitdate) AS Year"))->whereRaw("(YEAR(submitdate) >= $curYear - 4 AND YEAR(submitdate) <= $curYear) AND CRFResult = 'Moderate'")->groupBy('Year')->first()
        
        
                         @endphp
                    <?php
                       
                       
                      
                        for($i = 0; $i < 5; $i++){
                            // if($curYear - 0 == $row->Year){
                            //     $total = $row->Total;
                            //     $percentage = $row->Percentage;
                                ?>
                                    <td>
                                        <p style="color:brown;font-weight: normal;">Moderate:</p>
                                    </td>
                                    <td>
                                        <p style="color:black;min-width:150px;">&nbsp;&nbsp;0 Patients (30%)</strong></p>
                                    </td>
                                <?php
                                
                            // }else{
                                ?>
                                    <td>
                                        <p style="color:brown;font-weight: normal;">Moderate:</p>
                                    </td>
                                    <td>
                                        <p style="color:black;min-width:150px;">&nbsp;&nbsp;0 Patients </strong></p>
                                    </td>
                                <?php
                            // }
                        }
                    ?>
                </tr>
                <tr>
                    <?php
                        // $sql = "SELECT COUNT(*) AS Total, CONCAT(ROUND(((COUNT(*) / (SELECT COUNT(*) FROM formtbl)) * 100),0),'%') AS Percentage, YEAR(submitdate) AS Year FROM formtbl
                        // WHERE (YEAR(submitdate) >= $curYear - 4 AND YEAR(submitdate) <= $curYear) AND CRFResult = 'High'
                        // GROUP BY Year ORDER BY Year DESC";
                        
                        // ($stmt = $conn->prepare($sql)) or trigger_error($conn->error, E_USER_ERROR);
                        // $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
                        // ($stmt_result = $stmt->get_result()) or trigger_error($stmt->error, E_USER_ERROR);
                        // $stmt->close();
                        
                        // if ($stmt_result->num_rows > 0) {
                        //     $row = $stmt_result->fetch_assoc();
                        // }
                        for($i = 0; $i < 5; $i++){
                            // if($curYear - 0 == $row['Year']){
                            //     $total = $row['Total'];
                            //     $percentage = $row['Percentage'];
                                ?>
                                    <td>
                                        <p style="color:orange;font-weight: normal;">High:</p>
                                    </td>
                                    <td>
                                        <p style="color:black;min-width:150px;">&nbsp;&nbsp;0 Patients (30%)</strong></p>
                                    </td>
                                <?php
                                // $row = $stmt_result->fetch_assoc();
                            // }else{
                                ?>
                                    <td>
                                        <p style="color:orange;font-weight: normal;">High:</p>
                                    </td>
                                    <td>
                                        <p style="color:black;min-width:150px;">&nbsp;&nbsp;0 Patients </strong></p>
                                    </td>
                                <?php
                            // }
                        }
                    ?>
                </tr>
                <tr>
                    <?php
                        // $sql = "SELECT COUNT(*) AS Total, CONCAT(ROUND(((COUNT(*) / (SELECT COUNT(*) FROM formtbl)) * 100),0),'%') AS Percentage, YEAR(submitdate) AS Year FROM formtbl
                        // WHERE (YEAR(submitdate) >= $curYear - 4 AND YEAR(submitdate) <= $curYear) AND CRFResult = 'Very High'
                        // GROUP BY Year ORDER BY Year DESC";
                        
                        // ($stmt = $conn->prepare($sql)) or trigger_error($conn->error, E_USER_ERROR);
                        // $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
                        // ($stmt_result = $stmt->get_result()) or trigger_error($stmt->error, E_USER_ERROR);
                        // $stmt->close();
                        
                        // if ($stmt_result->num_rows > 0) {
                        //     $row = $stmt_result->fetch_assoc();
                        // }
                        for($i = 0; $i < 5; $i++){
                            // if($curYear - 0 == $row['Year']){
                            //     $total = $row['Total'];
                            //     $percentage = $row['Percentage'];
                                ?>
                                    <td>
                                        <p style="color:red;font-weight: normal;">Very High:</p>
                                    </td>
                                    <td>
                                        <p style="color:black;min-width:150px;">&nbsp;&nbsp;0 Patients (30%)</strong></p>
                                    </td>
                                <?php
                            //     $row = $stmt_result->fetch_assoc();
                            // }else{
                                ?>
                                    <td>
                                        <p style="color:red;font-weight: normal;">Very High:</p>
                                    </td>
                                    <td>
                                        <p style="color:black;min-width:150px;">&nbsp;&nbsp;0 Patients </strong></p>
                                    </td>
                                <?php
                           // }
                        }
                    ?>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="col-custom2 boxShadow-top form-group">
    <form action="export_csv.php" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                From <input type="date" name="fromdate" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                To <input type="date" name="todate" class="form-control">
            </div>
        </div>
        <input type="submit" class="btn btn-primary btn-large btn-block" value="Download CSV">
    </form>
    <hr class="mb-3">
    <?php
       

        
    
       
    $count=1;
      
            foreach ($formtbl as $keys=> $row) {
                $patientname = $row->patientname;
                $submitdate = $row->submitdate;
                $patientgender = $row->patientgender;
                $patientrace = $row->patientrace;
                $patientnric  = $row->patientnric;
            
               
                ?>
                <div class="row">
                    <div class="user-picture col-sm-2 col-md-1 d-none d-sm-block">
                        <img src="img/user-picture.png">
                    </div>
                    <div class="col-sm-10 col-md-11">
                        <div class="row">
                            <div class="user-details col-md-10 col-9">
                                <div class="col">
                                    <small class="text-muted"><?php echo $submitdate; ?></small>
                                    <small class="text-muted"> | </small>
                                    <small class="text-muted"><?php if($patientgender == 1) echo 'Male'; else echo 'Female'; ?></small>
                                </div>
                                <div class="col">
                                    <label>{{$formtbl->firstItem()+$keys}}. <?php echo $patientname; ?></label>
                                </div>
                                <div class="col">
                                    <small class="text-muted"><?php echo $patientrace; ?></small>
                                    <small class="text-muted"> | </small>
                                    <small class="text-muted"><?php echo $patientnric; ?></small>
                                </div>
                            </div>
                            <div class="col-md-2 col-3">
                                <button type="button"  onclick="location.href='chdriskform.php?nric=<?php echo $patientnric; ?>'" class="btn-info btn-block but-color-none">View</button>
                                <button type="button"  onclick="location.href='chdriskform.php?nric=<?php echo $patientnric; ?>'" class="btn-warning btn-block but-color-none">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mb-3">				
                <?php
                
            }
        
    ?>

   
    <div class="row">
        <div class="col-md-1 col-2">
            <button type="button" onclick="location.href='{{URL::to('dashboard')}}'" class="btn-outline-info but-custom2"><i class="fa fa-long-arrow-left fa-lg"></i></button>
        </div>
        <div class="col-md-10 col-9" style="text-align: center;">
            {{$formtbl->links()}}
    
        </div>
    </div>
</div>
@endsection