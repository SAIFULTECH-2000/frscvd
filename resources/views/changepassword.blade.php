@extends('layouts.app')

@section('title','Dashboard | FRSCVD')
@section('subtitle',"Edit your profile here")
@section('content')


<div class="col-custom2 boxShadow-top form-group">
    <form name="edit-form" id="edit-form" method="post" action="{{URL::to('changepassword')}}">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Old Password</label>
                <small class="text-muted"><br></small>
                <input type="password" value="" class="form-control" name="useroldpassword" id="useroldpassword" placeholder="New Password">
            </div>
            <div class="col-md-6 mb-3">
                <label>New Password</label>
                <small class="text-muted"><br></small>
                <input type="password" value="" class="form-control" name="userpassword" id="userpassword" placeholder="New Password">
            </div>
            <div class="col-md-6 mb-3">
                <label>Confirm Password</label>
                <small class="text-muted">Confirm password<br></small>
                <input type="password" value="" class="form-control" name="userrepassword" id="userrepassword" placeholder="New Password"><span id='messagepass'></span>
            </div>
        </div>
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
      @if(Session::has('fails'))
     $flashdata = "{{Session::get('fails')}}"; 
     if($flashdata){
         Swal.fire({
         title: 'Error!',
         text: $flashdata,
         icon: 'error',
         confirmButtonText: 'Close'
     })
     }
     @endif
</script>
@endsection