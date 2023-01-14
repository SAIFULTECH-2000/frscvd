@extends('layouts.app')
@php
    $username =Session::get('username')
@endphp
@section('title','Dashboard | FRSCVD')
@section('subtitle',"Hello,$username")
@section('content')


<div class="col-custom1 boxShadow-top form-group">
    <div class="row">
        <div class="col-12 mb-3">
            <button type="button" onclick="location.href='{{URL::to('/profile')}}'" class="btn-outline-info btn-block but-color-navy-blue">Edit Your Profile<i class="fa fa-user-circle fa-lg" aria-hidden="true"></i></button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-3">
            <button type="button" onclick="location.href='{{URL::to('/chdriskform')}}'" class="btn-outline-info btn-block but-color-navy-blue">Patient Registration<i class="fa fa-wpforms fa-lg" aria-hidden="true"></i></button>
        </div>
    </div>
    <?php
        if(Session::get('useradmin') == 'yes'){
    ?>
    <div class="row">
        <div class="col-12 mb-3">
            <button type="button" onclick="location.href='{{URL::to('/listpatient')}}'" class="btn-outline-info btn-block but-color-navy-blue">List of Patients<i class="fa fa-wpforms fa-lg" aria-hidden="true"></i></button>
        </div>
    </div>
    <?php
        }
    ?>
    <div class="row">
        <div class="col-12 mb-3">
            <button type="button" onclick="location.href='{{URL::to('/logout')}}'" class="btn-info btn-block but-color-none">Logout<i class="fa fa-sign-out fa-lg" aria-hidden="true"></i></button>
        </div>
    </div>
</div>
@endsection


@section('message')
<script>
     @if(Session::has('message'))
     $flashdata = "{{Session::get('message')}}"; 
     if($flashdata){
         Swal.fire({
         title: 'Success!',
         text: $flashdata,
         icon: 'success',
         confirmButtonText: 'Close'
     })
     }
     @endif
 </script>
@endsection