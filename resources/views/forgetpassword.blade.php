@extends('layouts.app')
@section('title','FORGET PASSWORD | FRSCVD')
@section('subtitle','FORGET PASSWORD')
@section('content')
<div class="col-custom1 boxShadow form-group">
    <div class="txt-title"><p>Find Your Account</p></div>
    <form name="email-form" id="email-form">
        <input type="text" value="" class="form-control" name="useremail" id="useremail" title="Please enter your email address" placeholder="Email address" required>
        <hr class="mb-4">
        <div class="row">
            <div class="col-4 mb-3">
                <button type="button" onclick="location.href='index.php'" class="btn-outline-info but-custom2"><i class="fa fa-long-arrow-left fa-lg"></i></button>
            </div>
            <div class="col mb-3">
                <button type="submit" id="submit" class="btn-info btn-block but-color-none">Search <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i></button>
            </div>
        </div>
    </form>
</div>
@endsection