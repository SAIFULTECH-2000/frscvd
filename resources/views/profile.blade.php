@extends('layouts.app')

@section('title','Dashboard | FRSCVD')
@section('subtitle',"Edit your profile here")
@section('content')

@php

$nric1 = substr($users->usernric, 0, 6);
$nric2 = substr($users->usernric, 6, 2);
$nric3= substr($users->usernric,8,4);

@endphp
<div class="col-custom2 boxShadow-top form-group">
    <form name="edit-form" id="edit-form" method="post" action="{{URL::to('changeprofile')}}">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Username</label>
                <input type="text" value="<?php echo $users->username; ?>" class="form-control" name="username" id="username" pattern="[a-zA-Z ']{1,}" title="All must be characters" placeholder="Name" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" value="<?php echo $users->useremail; ?>" class="form-control" name="useremail" id="useremail" placeholder="Email" required>         
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="row">
                    <div class="col-4 mb-3">
                        <input type="text" value="<?php echo $nric1; ?>" class="form-control" name="usernric1" id="usernric1" pattern="[0-9]{6}" title="First 6 digits" autocomplete="off" maxlength="6" placeholder="000000" required>
                    </div>
                    <div class="col-4 mb-3 ">
                        <input type="text" value="<?php echo $nric2; ?>" class="form-control" name="usernric2" id="usernric2" pattern="[0-9]{2}" title="2 Digits" autocomplete="off" maxlength="2" placeholder="00" required>
                    </div>
                    <div class="col-4 mb-3 ">
                        <input type="text" value="<?php echo $nric3; ?>" class="form-control" name="usernric3" id="usernric3" pattern="[0-9]{4}" title="4 Last Digits" autocomplete="off" maxlength="4" placeholder="0000" required>
                    </div>
                </div>
                <small class="text-muted"><strong>Note:</strong> If you don’t know the NRIC, at least put the first two digits of NRIC (year) and types zeros for others. E.g: (930000-00-0000).</small>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label>Address</label>
                <input type="text" value="<?php echo $users->useraddress; ?>" class="form-control" name="useraddress" id="useraddress" placeholder="Current Address" required>
            </div>
        </div>
{{-- 
        <div class="row">
            <div class="col-md-6 mb-3">
                <small class="text-muted"><br></small>
                <input type="password" value="" class="form-control" name="userpassword" id="userpassword" placeholder="New Password">
            </div>
            <div class="col-md-6 mb-3">
                <small class="text-muted">Confirm password<br></small>
                <input type="password" value="" class="form-control" name="userrepassword" id="userrepassword" placeholder="New Password"><span id='messagepass'></span>
            </div>
        </div> --}}
        <hr class="mb-4">
        <div class="row">
            <div class="col-md-1 col-2">
                <button type="button" onclick="location.href='{{URL::to('/dashboard')}}'" class="btn-outline-info but-custom2"><i class="fa fa-long-arrow-left fa-lg"></i></button>
            </div>
            <div class="col-md-5 col-10">
                <button type="submit" id="submit" class="btn-info btn-block but-color-none">Update<i class="fa fa-user-circle fa-lg" aria-hidden="true"></i></button>
            </div>
        </div>
    </form>
</div>
@endsection


@section('message')
<script>
     @if(Session::has('message'))
     $users->flashdata = "{{Session::get('message')}}"; 
     if($users->flashdata){
         Swal.fire({
         title: 'Success!',
         text: $users->flashdata,
         icon: 'success',
         confirmButtonText: 'Close'
     })
     }
     @endif
 </script>
@endsection