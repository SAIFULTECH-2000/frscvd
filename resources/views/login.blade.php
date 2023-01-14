@extends('layouts.app')
@section('title','LOGIN | FRSCVD')
@section('subtitle','Coronary Heart Disease Risk System')
@section('content')
<div class="col-custom1 boxShadow form-group">
    <div class="txt-title"><p>Login</p></div>
        <form action="{{URL::to('auth')}}" id="login-form" method="POST">
            @csrf
            <input type="text" value="" class="form-control" name="useremail" id="useremail" title="Please enter your email" placeholder="email" required>
            <br>
            <div class="mb-3">
                <input type="password" value="" class="form-control" name="userpassword" id="userpassword" title="Enter Password"  placeholder="Password" required>
                <a href="{{URL::to('forgetpassword')}}"><small class="text-muted"><strong>Forgot your password?</strong></small></a>
            </div>
            <div class="row">
                <div class="col mb-3"><button type="button" class="btn-info btn-block but-color-none" onClick="window.location.href='register.php'">Register <i class="fa fa-address-card-o"></i></button></a></div>
                <div class="col mb-3"><button type="submit" class="btn-outline-info btn-block but-color-navy-blue" id ="submit">Login <i class="fa fa-sign-in"></i></button></div>
            </div>
        </form>
    </div>
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
     @if(Session::has('logout'))
     $flashdata = "{{Session::get('logout')}}"; 
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